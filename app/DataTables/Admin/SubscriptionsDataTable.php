<?php

namespace App\DataTables\Admin;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubscriptionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($subscription) {
                return view('components.actions', [
                    'id' => $subscription->id,
                    'routeEdit' => auth()->user()?->can('subscriptions update') ? 'admin.subscriptions.edit' : '',
                    'routeDelete' => auth()->user()?->can('subscriptions delete') ? 'admin.subscriptions.destroy' : '',
                    'routeShow' => '',
                    'table' => 'subscriptions_table',
                ]);
            })
            ->addColumn('iterator', function () {
                static $i = 1;

                return $i++;
            })
            ->addColumn('price', function ($subscription) {
                return number_format($subscription->price, 2).' $';
            })
            ->addColumn('duration', function ($subscription) {
                return $subscription->duration.' شهر';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subscription $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subscriptions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
                    // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->language([
                'paginate' => [
                    'next' => 'التالي',
                    'previous' => 'السابق',
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns(): array
    {
        return [
            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::make('name')
                ->title('اسم الباقه')
                ->addClass('text-center pt-3'),

            Column::make('description')
                ->title('الوصف')
                ->addClass('text-center pt-3'),

            Column::computed('price')
                ->title('السعر')
                ->addClass('text-center pt-3'),

            Column::computed('duration')
                ->title('المدة (أشهر)')
                ->addClass('text-center pt-3'),

            Column::computed('action')
                ->title('الإجراءات')
                ->addClass('text-center pt-3')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Subscriptions_'.date('YmdHis');
    }
}
