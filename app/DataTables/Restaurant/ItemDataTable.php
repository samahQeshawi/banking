<?php

namespace App\DataTables\Restaurant;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItemDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                return view('components.actions', [
                    'id' => $item->id,
                    'routeEdit' => 'restaurant.items.edit',
                    'routeDelete' => 'restaurant.items.destroy',
                    'routeShow' => '',
                    'table' => 'items_table',
                ]);
            })
            ->addColumn('iterator', function ($item) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })
            ->addColumn('available', function ($item) {
                return view('components.available', ['id' => $item->id,
                    'available' => $item->is_available,
                    'tableId' => 'items_table',
                    'routeStatus' => 'restaurant.items.updateAvailable']);
            })
            ->addColumn('available', function ($item) {
                return view('components.available', ['id' => $item->id,
                    'available' => $item->is_available,
                    'tableId' => 'items_table',
                    'routeStatus' => 'restaurant.items.updateAvailable']);
            })
            ->addColumn('status', function ($item) {
                return view('components.status', ['id' => $item->id,
                    'status' => $item->status,
                    'tableId' => 'items_table',
                    'routeStatus' => 'restaurant.items.updateStatus']);
            })
            ->addColumn('menu', function ($item) {
                return $item->menu ? $item->menu->name : '-';
            })
            ->addColumn('created_at', function ($item) {
                return @$item->created_at->format('Y-m-d');
            })
            ->addColumn('image', function ($item) {
                return view('components.image', ['photo' => $item->img_url]);
            })
            ->addColumn('menu', function ($item) {
                return $item->menu ? $item->menu->name : '-';
            })

            ->addColumn('created_at', function ($item) {
                return @$item->created_at->format('Y-m-d');
            })
            ->rawColumns(['action', 'iterator', 'status']);
    }

    public function query(Item $model)
    {
        $restaurantId = auth('restaurant')->user()->id;

        return $model->where('restaurant_id', $restaurantId)->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('items_table')
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

            Column::make('image')
                ->title('صورة')
                ->addClass('text-center pt-3'),

            Column::make('name')
                ->title('اسم المنتج')
                ->addClass('text-center pt-3'),

            Column::computed('menu')
                ->title('التصنيف')
                ->addClass('text-center pt-3'),

            Column::make('price')
                ->title('السعر')
                ->addClass('text-center pt-3'),

            Column::computed('available')
                ->title('التوفر')
                ->addClass('text-center pt-3'),

            Column::computed('status')
                ->title('الحالة')
                ->addClass('text-center pt-3'),

            Column::computed('created_at')
                ->title('تاريخ الاضافة ')
                ->addClass('text-center pt-3'),

            Column::computed('action')
                ->title('الاجراءات')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center pt-3')
                ->orderable(false)
                ->searchable(false),
        ];
    }
}
