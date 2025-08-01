<?php

namespace App\DataTables\Restaurant;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', function ($driver) {
            //     return view('components.actions', [
            //         'id' => $driver->id,
            //         'routeEdit' => 'restaurant.users.edit',
            //         'routeDelete' => 'restaurant.users.destroy',
            //         'routeShow' => '',
            //         'table' => 'users_table',
            //     ]);
            // })

            ->addColumn('image', function ($customer) {
                return view('components.image', ['photo' => $customer->img_url]);
            })
            ->addColumn('iterator', function () {
                static $loopCounter = 1;

                return $loopCounter++;
            })
            ->addColumn('created_at', function ($customer) {
                return @$customer->created_at->format('Y-m-d');
            })
            ->addColumn('count_order', function ($customer) {
                return @$customer->orders_restaurant_count;
            })
            ->rawColumns(['action', 'iterator']);
    }

    public function query(Customer $model)
    {
        $restaurantId = auth('restaurant')->user()->id;

        return $model
            ->whereHas('orders', function ($q) use ($restaurantId) {
                $q->where('restaurant_id', $restaurantId);
            })
            ->withCount([
              'orders as orders_restaurant_count' => function ($q) use ($restaurantId) {
                  $q->where('restaurant_id', $restaurantId);
              },
            ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customers_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
//            ->dom('Bfrtip')
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

    protected function getColumns()
    {
        return [

            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::computed('image')
                ->title('الصورة الشخصية')
                ->addClass('text-center pt-3'),

            Column::computed('name')
                ->title('الاسم')
                ->addClass('text-center pt-3'),

            Column::computed('phone')
                ->title('رقم الجوال')
                ->addClass('text-center pt-3'),

            Column::computed('email')
                ->title('البريد الالكتروني')
                ->addClass('text-center pt-3'),

            Column::computed('count_order')
                ->title('عدد الطلبات')
                ->addClass('text-center pt-3'),

            Column::computed('created_at')
                ->title('تاريخ الانشاء')
                ->addClass('text-center pt-3'),

            // Column::computed('action')
            //     ->title('الاجراءات')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->addClass('text-center pt-3')
            //     ->orderable(false)
            //     ->searchable(false),
        ];
    }
}
