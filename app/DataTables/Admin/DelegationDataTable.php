<?php

namespace App\DataTables\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DelegationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($admin) {
                // if ($admin->id == 1) {
                //    return ''; 
                // }
                return view('components.actions', [
                    'id' => $admin->id,
                    'routeEdit' => '',
                    'routeDelete' => '',
                    'routeShow' => 'admin.delegations.show',
                    'table' => 'delegations_table',
                ]);
            })
            ->addColumn('iterator', function ($admin) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })
            ->addColumn('created_at', function ($admin) {
                return @$admin->created_at->format('Y-m-d');
            })


            ->addColumn('status', function ($admin) {
                return view('components.status', [
                    'id' => $admin->id,
                    'status' => $admin->status,
                    'tableId' => 'admins_table',
                    'routeStatus' => auth()->user()?->can('admins update') ? 'admin.admins.updateStatus' : null,
                ]);
            })


            ->rawColumns(['action', 'iterator']);
    }

    /**
     * Get query source of dataTable.
     */
    public function query(Admin $model): QueryBuilder
    {
        // return $model->newQuery();
         $admin = auth('admin')->user();

        return $admin->delegators()->getQuery();
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('delegations_table')
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

            Column::computed('name')
                ->title('الاسم')
                ->addClass('text-center pt-3'),

            Column::make('phone')
                ->title('رقم الهاتف')
                ->addClass('text-center pt-3'),

            Column::make('email')
                ->title('البريد الإلكتروني')
                ->addClass('text-center pt-3'),

            Column::computed('status')
                ->title('الحالة')
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
