<?php

namespace App\DataTables\Admin;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($customer) {
                return view('components.actions', [
                    'id' => $customer->id,
                    'routeEdit' => auth()->user()->can('customers update') ? 'admin.users.edit' : '',
                    'routeDelete' => auth()->user()->can('customers delete') ? 'admin.users.destroy' : '',
                    'routeShow' => '',
                    'table' => 'customers_table',
                ]);
            })
            ->addColumn('iterator', function ($customer) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })
            ->addColumn('created_at', function ($customer) {
                return @$customer->created_at->format('Y-m-d');
            })
            ->addColumn('count_order', function ($customer) {
                return @$customer->ordersCount();
            })

            ->addColumn('image', function ($customer) {
                return view('components.image', ['photo' => $customer->img_url]);
            })
            ->rawColumns(['action', 'iterator']);
    }

    /**
     * Get query source of dataTable.
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customers_table')
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

            Column::make('image')
                ->title('الصورة')
                ->addClass('text-center pt-3'),

            Column::computed('name')
                ->title('الاسم')
                ->addClass('text-center pt-3'),

            Column::make('phone')
                ->title('رقم الهاتف')
                ->addClass('text-center pt-3'),

            Column::make('email')
                ->title('البريد الإلكتروني')
                ->addClass('text-center pt-3'),

            Column::computed('count_order')
                ->title('عدد الطلبات')
                ->addClass('text-center pt-3'),

            Column::make('created_at')
                ->title('تاريخ التسجيل')
                ->addClass('text-center pt-3'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center pt-3')
                ->title('الإجراءات'),
        ];
    }
}
