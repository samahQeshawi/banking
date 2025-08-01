<?php

namespace App\DataTables\Admin;

use App\Enums\VehicleType;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DriversDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function ($driver) {
                return view('components.actions', [
                    'id' => $driver->id,
                    'routeEdit' => auth()->user()->can('drivers update') ? 'admin.drivers.edit' : '',
                    'routeDelete' => auth()->user()->can('drivers delete') ? 'admin.drivers.destroy' : '',
                    'routeShow' => '',
                    'table' => 'drivers_table',
                ]);
            })
            ->addColumn('iterator', function ($driver) {
                static $loopCounter = 1;

                return $loopCounter++;
            })
            ->addColumn('is_available', function ($drive) {
                return view('components.available', [
                    'id' => $drive->id,
                    'available' => $drive->is_available,
                    'tableId' => 'drivers_table',
                    'routeStatus' => 'admin.drivers.updateAvailable',
                ]);
            })
            ->addColumn('image', function ($drive) {
                return view('components.image', ['photo' => $drive->img_url]);
            })
            ->addColumn('vehicle_type', function ($drive) {
                $value = (int) $drive->vehicle_type;
                $vehicleEnum = VehicleType::tryFrom($value);

                return $vehicleEnum?->label() ?? '-';
            })
            ->addColumn('status', function ($drive) {
                return view('dashboard.admin.drivers.status', [
                    'id' => $drive->id,
                    'status' => $drive->status,
                    'tableId' => 'drivers_table',
                    'routeStatus' => 'admin.drivers.updateStatus',
                ]);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action', 'status', 'available', 'image']);
    }

    public function query(Driver $model): QueryBuilder
    {
        $query = $model->newQuery();
        if (request()->has('filter_name') && request('filter_name') != '') {
            $query->where('name', 'like', '%'.request('filter_name').'%');
        }

        if (request()->has('filter_phone') && request('filter_phone') != '') {
            $query->where('phone', 'like', '%'.request('filter_phone').'%');
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('drivers_table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('admin.drivers.index'),
                'data' => 'function(d) {
                   d.filter_name = $("#filter-name").val();
                   d.filter_phone = $("#filter-phone").val();
                }',
            ])
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

            Column::computed('image')
                ->title('الصورة')
                ->addClass('text-center pt-3'),

            Column::computed('name')
                ->title('الاسم')
                ->addClass('text-center pt-3'),

            Column::make('phone')
                ->title('رقم الجوال')
                ->addClass('text-center pt-3'),

            Column::computed('vehicle_type')
                ->title('نوع المركبة')
                ->addClass('text-center pt-3'),

            Column::make('vehicle_license_plate')
                ->title('رقم لوحة المركبة')
                ->addClass('text-center pt-3'),

            Column::make('is_available')
                ->title('متوفر')
                ->addClass('text-center pt-3'),

            Column::make('status')
                ->title('الحالة')
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
