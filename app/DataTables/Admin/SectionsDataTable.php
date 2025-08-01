<?php

namespace App\DataTables\Admin;

use App\Models\Section;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SectionsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($section) {
                return view('dashboard.admin.sections.actions', [
                    'id' => $section->id,
                    'name' => $section->title,
                    'img' => $section->img_url]);
            })
            ->addColumn('iterator', function ($section) {
                static $loopCounter = 1; // Initialize counter

                return $loopCounter++; // Return and increment counter
            })
            ->addColumn('status', function ($item) {
                return view('components.status', [
                    'id' => $item->id,
                    'status' => $item->status,
                    'tableId' => 'sections_table',
                    'routeStatus' => auth()->user()?->can('sections update') ? 'admin.sections.updateStatus' : '',
                ]);
            })
            ->addColumn('created_at', function ($section) {
                return @$section->created_at->format('Y-m-d');
            })

            ->addColumn('status', function ($item) {
                return view('components.status', ['id' => $item->id,
                    'status' => $item->status,
                    'tableId' => 'sections_table',
                    'routeStatus' => 'admin.sections.updateStatus']);
            })

            ->addColumn('created_at', function ($section) {
                return @$section->created_at->format('Y-m-d');
            })

            ->addColumn('image', function ($section) {
                return view('components.image', ['photo' => $section->img_url]);
            })

            ->rawColumns(['action', 'iterator']);
    }

    public function query(Section $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('sections_table')
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
                ->title('الاسم')
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
