<?php

namespace App\DataTables\Restaurant;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('iterator', function ($order) {
                static $i = 1;
                return $i++;
            })

            ->addColumn('action', function ($order) {
                return view('components.actions', [
                    'id' => $order->id,
                    'routeShow' => 'restaurant.orders.show',
                    'routeEdit' => '',
                    'routeDelete' => '',
                    'table' => 'restaurant_orders_table',
                ]);
            })
                        ->addColumn('created_at', function ($order) {
                return @$order->created_at->format('Y-m-d');
            })
            ->addColumn('customer_name', function ($order) {
                return $order->customer->name ?? 'N/A';
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

                return view('dashboard.restaurant.orders.status', [
                    'order' => $order,
                    'btnClass' => $btnClass,
                    'icon' => $icon,
                ]);
            })

            ->rawColumns(['action', 'status']);
    }

    public function query(Order $model): QueryBuilder
    {
        $restaurantId = auth('restaurant')->user()->id;

        return $model->newQuery()
            ->where('restaurant_id', $restaurantId)
            ->with(['customer']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('restaurant_orders_table')
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
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::make('id')
                ->title('رقم الطلب')
                ->addClass('text-center pt-3'),

            Column::make('customer_name')
                ->title('اسم العميل')
                ->addClass('text-center pt-3'),

            Column::make('total')
                ->title('المبلغ الاجمالي')
                ->addClass('text-center pt-3'),
            
                Column::computed('status')
                ->title('الحالة')
                ->addClass('text-center pt-3'),

            Column::make('created_at')
                ->title('تاريخ الطلب')
                ->addClass('text-center pt-3'),

            Column::computed('action')
                ->title('الإجراءات')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center pt-3')
                ->orderable(false)
                ->searchable(false),
        ];
    }
}
