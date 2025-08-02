<?php

namespace App\Http\Controllers\Web\Admin;

use App\DataTables\Admin\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AdminRequest;
use App\Models\Admin;
use App\Models\Wallet;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    use ImageTrait;

    public function __construct()
    {

    }

    public function index()
    {
        $recipients = Admin::where('id', '!=', auth('admin')->id())->get();
        $myWallet = Wallet::where('user_id', auth('admin')->id())->first();
        if (!$myWallet) {
            $myWallet = new Wallet();
            $myWallet->balance = 0;
            $myWallet->user_id = auth('admin')->id();
            $myWallet->save();
        }
        $balance = $myWallet->balance;
        return view('dashboard.admin.accounts.index', compact('recipients', 'balance'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|numeric|digits:11|exists:admins,phone',
            'amount' => 'required|numeric|min:1',
        ]);

        $data['from_account'] = auth('admin')->user()->id;
        $data['phone'] = $request->phone;
        $data['amount'] = $request->amount;


        // Store the account transfer data
        Admin::where('phone', $data['phone'])
            ->update([
                'balance' => \DB::raw('balance + ' . $data['amount'])
            ]);

        return redirect()->route('admin.accounts.index')->with('success', __('messages.account_transfer_success'));
    }


}
