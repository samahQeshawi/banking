<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Admin;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function transfer(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:admins,phone',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string'
        ]);
        $from_user = Auth::guard('admin')->user();
        $to_user =Admin::where('phone', $request->phone)->first();
        $fromWallet = Wallet::where('user_id', $from_user->id)->first();
        $toWallet = Wallet::where('user_id', $to_user->id)->first();
        if (!$toWallet) {
            $toWallet = new Wallet();
            $toWallet->balance = 0;
            $toWallet->user_id = $to_user->id;
            $toWallet->save();
        }
        if (!$fromWallet) {
            $fromWallet = new Wallet();
            $fromWallet->balance = 0;
            $fromWallet->user_id = $from_user->id;
            $fromWallet->save();
        }
        // تحقق من وجود المحفظة
        if (!$fromWallet || !$toWallet) {
            return redirect()->route('admin.accounts.index')->with('error', __('lang.wallet_not_found'));
        }

        // تحقق الرصيد
        if ($fromWallet->balance < $request->amount) {
            // return response()->json(['message' => 'Insufficient balance'], 422);
            return redirect()->route('admin.accounts.index')->with('warning', __('lang.account_transfer_insufficient_balance'));

        }

        // ====== التحقق من الاحتيال (AI) قبل التنفيذ ======
        $aiPayload = [
            'amount'   => $request->amount,
            'hour'     => now()->hour,
            'device'   => 'known', // يمكنك ربط منطق الجهاز حسب متطلباتك
            'tribe'    => optional($from_user)->tribe ?? 'unknown',
        ];
        $aiResponse = Http::post('http://34.207.89.197:5000/fraud-score', $aiPayload);

        if (!$aiResponse->ok()) {
            // return response()->json(['message' => 'AI check failed'], 500);
            return redirect()->route('admin.accounts.index')->with('error', __('lang.account_transfer_ai_error'));

        }
        $risk = $aiResponse->json();

        // تحقق مستوى الخطورة
        if ($risk['risk_level']['en'] === 'High') {
            return response()->json([
                'message' => 'Transaction flagged as HIGH RISK by AI fraud detection. Operation denied.',
                'fraud_score' => $risk['risk_score'],
                'ai_reasons' => $risk['reasons']
            ], 403);
        } elseif ($risk['risk_level']['en'] === 'Medium') {
            return response()->json([
                'message' => 'Transaction flagged as MEDIUM RISK by AI fraud detection. Further verification required.',
                'fraud_score' => $risk['risk_score'],
                'ai_reasons' => $risk['reasons']
            ], 401);
        }
        // ================================================

        // إذا اجتاز الفحص، نفذ التحويل
        return DB::transaction(function () use ($fromWallet, $toWallet, $request) {
            $amount = $request->amount;
            $from_balance_before = $fromWallet->balance;
            $to_balance_before = $toWallet->balance;

            // خصم من المرسل
            $fromWallet->balance -= $amount;
            $fromWallet->save();

            // إضافة للمستلم
            $toWallet->balance += $amount;
            $toWallet->save();

            // إنشاء عملية المرسل
            $fromTx = Transaction::create([
                'wallet_id' => $fromWallet->id,
                'type' => 'transfer',
                'amount' => $amount,
                'balance_before' => $from_balance_before,
                'balance_after' => $fromWallet->balance,
                'description' => $request->description,
                'related_wallet_id' => $toWallet->id
            ]);

            // إنشاء عملية المستلم
            $toTx = Transaction::create([
                'wallet_id' => $toWallet->id,
                'type' => 'deposit',
                'amount' => $amount,
                'balance_before' => $to_balance_before,
                'balance_after' => $toWallet->balance,
                'description' => "Transfer from User #" . Auth::id(),
                'related_wallet_id' => $fromWallet->id,
                'related_transaction_id' => $fromTx->id
            ]);

            // تحديث transaction المرسل برقم العملية المقابلة
            $fromTx->related_transaction_id = $toTx->id;
            $fromTx->save();

            // return response()->json([
            //     'from_transaction' => $fromTx,
            //     'to_transaction' => $toTx
            // ]);
            return redirect()->route('admin.accounts.index')->with('success', __('lang.account_transfer_success'));

        });
    }

}