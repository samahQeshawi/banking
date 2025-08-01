<?php

namespace App\DataTables\Restaurant;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RateDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('iterator', function ($rate) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })

            ->addColumn('created_at', function ($rate) {
                return @$rate->created_at->format('Y-m-d');
            })
            ->addColumn('rate', function ($rate) {
                return view('components.rate', ['rating' => $rate->rate])->render();
            })
            ->addColumn('order_id', function ($rate) {
                return '<a href="'.route('restaurant.orders.show', $rate->order_id).'">'.$rate->order_id.'</a>';
            })

            ->rawColumns(['order_id','rate', 'iterator']);
    }

    public function query(Rate $model)
    {
        $restaurant = auth('restaurant')->user();
        return $restaurant->ratings()->getQuery(); 
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('rates_table')
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

            Column::computed('rate')
                ->title('التقييم')
                ->addClass('text-center pt-3'),

            Column::computed('order_id')
                ->title('رقم الطلب')
                ->addClass('text-center pt-3'),

            Column::computed('created_at')
                ->title('تاريخ الاضافة ')
                ->addClass('text-center pt-3'),
        ];
    }
}
