<?php

namespace App\DataTables\Admin;

use App\Models\RestaurantSubscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RestaurantsSubsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('iterator', function () {
                static $i = 1;

                return $i++;
            })
            ->addColumn('restaurant_name', function ($row) {
                return $row->restaurant->name ?? '—';
            })
            ->addColumn('subscription_name', function ($row) {
                return $row->subscription->name ?? '—';
            })
            ->addColumn('start_date', fn ($row) => optional($row->start_date)->format('Y-m-d H:i'))
            ->addColumn('end_date', fn ($row) => optional($row->end_date)->format('Y-m-d H:i'))
            ->addColumn('active_badge', function ($row) {
                return $row->active
                    ? '<span class="badge bg-success">مفعل</span>'
                    : '<span class="badge bg-danger">غير مفعل</span>';
            })
            ->rawColumns(['active_badge']);
    }

    public function query(RestaurantSubscription $model): QueryBuilder
    {
        return $model->newQuery()->with(['restaurant', 'subscription']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('restaurant-subs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->language([
                'paginate' => [
                    'next' => 'التالي',
                    'previous' => 'السابق',
                ],
                'emptyTable' => 'لا توجد بيانات متاحة في الجدول',
                'info' => 'عرض _START_ إلى _END_ من أصل _TOTAL_ مدخل',
                'search' => 'بحث:',
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::computed('restaurant_name')
                ->title('اسم المطعم')
                ->addClass('text-center pt-3'),

            Column::computed('subscription_name')
                ->title('الباقة')
                ->addClass('text-center pt-3'),

            Column::computed('start_date')
                ->title('تاريخ البدء')
                ->addClass('text-center pt-3'),

            Column::computed('end_date')
                ->title('تاريخ الانتهاء')
                ->addClass('text-center pt-3'),

            Column::computed('active_badge')
                ->title('الحالة')
                ->addClass('text-center pt-3'),
        ];
    }

    protected function filename(): string
    {
        return 'RestaurantSubscriptions_'.date('YmdHis');
    }
}
