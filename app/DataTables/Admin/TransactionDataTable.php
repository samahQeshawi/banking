<?php

namespace App\DataTables\Admin;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('iterator', function ($admin) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })
            ->addColumn('created_at', function ($transaction) {
                return @$transaction->created_at->format('Y-m-d');
            })

            ->addColumn('status', function ($transaction) {
                return view('components.status', [
                    'id' => $transaction->id,
                    'status' => $transaction->status,
                    'tableId' => 'transactions_table',
                    'routeStatus' => 'admin.transactions.updateStatus' ,
                    'transaction' => $transaction,
                ]);
            })
            ->addColumn('wallet', function ($transaction) {
                return $transaction->wallet ? $transaction->wallet->owner->name : 'غير محدد';
            })


            ->rawColumns(['action', 'iterator']);
    }

    /**
     * Get query source of dataTable.
     */
    // public function query(Transaction $model): QueryBuilder
    // {
    //     return $model->newQuery()
    //     ->with(['wallet.owner', 'relatedWallet.owner']) // تحميل العلاقات لتقليل عدد الاستعلامات
    //     ->select('transactions.*');
    // }
    public function query(Transaction $model): QueryBuilder
    {
    $walletId = auth('admin')->user()->wallet->id ?? null;

    return $model->newQuery()
        ->with(['wallet', 'relatedWallet'])
        ->where(function ($query) use ($walletId) {
            $query->where('wallet_id', $walletId)
                  ->orWhere('related_wallet_id', $walletId);
        });
    }   

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transactions_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->language([
                'paginate' => [
                    'next' => 'التالي',
                    'previous' => 'السابق',
                ],
            ])
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload')
            ]);
    }

    /**
     * Get columns.
     */
    protected function getColumns(): array
    {
        return [
            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::make('id')->title('رقم المعاملة'),
            Column::make('wallet')->title(' المحفظة'), // مثال على علاقة
            Column::make('type')->title('نوع المعاملة'),
            Column::make('amount')->title('المبلغ'),
           Column::make('balance_before')->title('الرصيد قبل'),
           Column::make('balance_after')->title('الرصيد بعد'),
        Column::make('created_at')->title('تاريخ العملية'),

            Column::computed('status')
                ->title('الحالة')
                ->addClass('text-center pt-3'),    

            
        ];
    }
}
