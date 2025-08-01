<?php

namespace App\DataTables\Admin;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($role) {
                return view('components.actions', [
                    'id' => $role->id,
                    'routeEdit' => auth()->user()->can('roles update') ? 'admin.roles.edit' : '',
                    'routeDelete' => (auth()->user()->can('roles delete') && ($role->name != 'Admin')) ? 'admin.roles.destroy' : '',
                    'routeShow' => '',
                    'name' => $role->name,
                    'table' => 'roles_table',
                ]);
            })
            ->addColumn('iterator', function () {
                static $loopCounter = 1;

                return $loopCounter++;
            })
            ->addColumn('created_at', function ($role) {
                return $role->created_at ? $role->created_at->format('Y-m-d H:i') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('created_at', 'like', '%'.$keyword.'%');
                });
            })
            ->orderColumn('created_at', function ($query, $order) {
                $query->orderBy('created_at', $order);
            })
            ->rawColumns(['action']);
    }

    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('roles_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip') // Uncomment if you need buttons
            ->orderBy(1)
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
        return [
            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::make('name')
                ->title('اسم الدور')
                ->addClass('text-center pt-3'),

            Column::make('created_at')
                ->title('تاريخ الإنشاء')
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

    protected function filename(): string
    {
        return 'Roles_'.date('YmdHis');
    }
}
