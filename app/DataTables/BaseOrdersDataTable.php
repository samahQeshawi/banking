<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

abstract class BaseOrdersDataTable extends DataTable
{
    protected string $tableId = 'orders_table';

    protected string $routeShow = '';

    protected string $statusViewPath = '';

    protected bool $showRestaurantColumn = false;

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($order) {
                return view('components.actions', [
                    'order' => $order,
                    'routeShow' => $this->getRouteShow(),
                    'routeEdit' => '',
                    'routeDelete' => '',
                    'id' => $order->id,
                    'table' => $this->tableId,
                ]);
            })
            ->addColumn('iterator', function () {
                static $loopCounter = 1;

                return $loopCounter++;
            })
            ->addColumn('created_at', function ($order) {
                return @$order->created_at->format('Y-m-d');
            })
            ->addColumn('customer_name', function ($order) {
                return $order->customer->name ?? 'N/A';
            })
            ->addColumn('restaurant_name', function ($order) {
                return $this->showRestaurantColumn ? ($order->restaurant->name ?? 'N/A') : null;
            })
            ->addColumn('status', function ($order) {
                $statusColors = [
                    'pending' => 'btn-warning',
                    'preparing' => 'btn-info',
                    'ready' => 'btn-primary',
                    'completed' => 'btn-success',
                    'canceled' => 'btn-danger',
                ];

                $statusIcons = [
                    'pending' => 'fa-clock',
                    'preparing' => 'fa-utensils',
                    'ready' => 'fa-bell',
                    'completed' => 'fa-check-circle',
                    'canceled' => 'fa-times-circle',
                ];

                $btnClass = $statusColors[$order->status] ?? 'btn-secondary';
                $icon = $statusIcons[$order->status] ?? 'fa-question-circle';

                return view($this->statusViewPath, [
                    'order' => $order,
                    'btnClass' => $btnClass,
                    'icon' => $icon,
                ]);
            })
            ->rawColumns(['action', 'iterator', 'status']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId($this->tableId)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->language([
                'paginate' => [
                    'next' => 'التالي',
                    'previous' => 'السابق',
                ],
            ]);
    }

    protected function getColumns(): array
    {
        $columns = [
            Column::computed('iterator')->title('#')->addClass('text-center pt-3'),
            Column::make('id')->title('رقم الطلب')->addClass('text-center pt-3'),
            Column::make('customer_name')->title('اسم العميل')->addClass('text-center pt-3'),
        ];

        if ($this->showRestaurantColumn) {
            $columns[] = Column::make('restaurant_name')->title('اسم المطعم')->addClass('text-center pt-3');
        }

        $columns[] = Column::make('total')->title('المبلغ الإجمالي')->addClass('text-center pt-3');

        if ($this->showRestaurantColumn) {
            if (auth()->user()?->can('orders update')) {
                $columns[] = Column::computed('status')
                    ->title('الحالة')
                    ->exportable(false)
                    ->printable(false)
                    ->width(130)
                    ->addClass('text-center pt-3');
            }
        } else {
            $columns[] = Column::computed('status')->title('الحالة')->exportable(false)->printable(false)->width(130)->addClass('text-center pt-3');
        }

        $columns[] = Column::make('created_at')->title('تاريخ الطلب')->addClass('text-center pt-3');
        $columns[] = Column::computed('action')->exportable(false)->printable(false)->width(120)->addClass('text-center pt-3')->title('الإجراءات');

        return $columns;
    }

    protected function filename(): string
    {
        return 'Orders_'.date('YmdHis');
    }
}
