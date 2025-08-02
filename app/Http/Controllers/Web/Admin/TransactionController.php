<?php

namespace App\Http\Controllers\Web\Admin;

use App\DataTables\Admin\TransactionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AdminRequest;
use App\Models\Admin;
use App\Models\Transaction;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TransactionController extends Controller
{
    use ImageTrait;

    public function __construct()
    {

    }

    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.transactions.index');
    }



    public function updateStatus(Request $request, $id)
    {
        // try {
            $transaction = Transaction::findOrFail($id);
            $request->validate([
                'status' => 'required',
            ]);
          
            $transaction->update(['status' => $request->status]);

            return response()->json('success');

        // } catch (\Exception $ex) {
        //     return response()->json(__('messages.There was an error try again'), 400);
        // }
    }
}
