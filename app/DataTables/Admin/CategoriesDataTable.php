<?php

namespace App\DataTables\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($category) {
                return view('dashboard.admin.categories.actions', [
                    'id' => $category->id,
                    'name' => $category->title,
                    'img' => $category->img_url]);
            })
            ->addColumn('iterator', function ($category) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })
            ->addColumn('created_at', function ($category) {
                return @$category->created_at->format('Y-m-d');
            })
            ->addColumn('created_at', function ($category) {
                return @$category->created_at->format('Y-m-d');
            })
            ->addColumn('status', function ($category) {
                return view('components.status', [
                    'id' => $category->id,
                    'status' => $category->status,
                    'tableId' => 'categories_table',
                    'routeStatus' => auth()->user()?->can('categories update') ? 'admin.categories.updateStatus' : null,
                ]);
            })
            ->rawColumns(['action', 'iterator'])
            ->addColumn('image', function ($category) {
                return view('components.image', ['photo' => $category->img_url]);
            })

            ->addColumn('status', function ($category) {
                return view('components.status', ['id' => $category->id,
                    'status' => $category->status,
                    'tableId' => 'categories_table',
                    'routeStatus' => 'admin.categories.updateStatus']);
            })
            ->rawColumns(['action', 'iterator']);
    }

    public function query(Category $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categories_table')
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

            Column::make('title')
                ->title('التصنيف')
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
