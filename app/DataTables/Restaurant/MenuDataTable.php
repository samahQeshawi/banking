<?php

namespace App\DataTables\Restaurant;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($menu) {
                return view('dashboard.restaurant.menus.actions',
                    [
                        'id' => $menu->id,
                        'name' => $menu->name,
                        'sort' => $menu->sort_order,
                        'img' => $menu->img_url,
                        'table' => 'menus_table',
                    ]);
            })
            ->addColumn('iterator', function ($menu) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })

            ->addColumn('image', function ($menu) {
                return view('components.image', ['photo' => $menu->img_url]);
            })

            ->addColumn('created_at', function ($menu) {
                return @$menu->created_at->format('Y-m-d');
            })

            ->rawColumns(['action', 'iterator']);
    }

    public function query(Menu $model)
    {
        $restaurantId = auth('restaurant')->user()->id;

        return $model->where('restaurant_id', $restaurantId)->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('menus_table')
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
                ->title('الصورة')
                ->addClass('text-center pt-3'),

            Column::make('name')
                ->title('الاسم')
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
