<?php

namespace App\DataTables\Admin;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NotificationDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('iterator', function ($notification) {
                static $loopCounter = 1;

                return $loopCounter++;
            })
            ->addColumn('status', function ($notification) {
                return view('dashboard.admin.notifications.status', [
                    'id' => $notification->id,
                    'status' => $notification->status,
                    'status_text' => $notification->status === 'sent' ? 'تم الارسال' : 'ارسال',
                    'btn_class' => $notification->status === 'sent' ? 'btn-success' : 'btn-warning',
                    'icon' => $notification->status === 'sent' ? 'fa-check-circle' : 'fa-clock',
                ]);
            })
            ->addColumn('created_at', function ($notification) {
                return $notification->created_at->format('Y-m-d');
            })
            ->addColumn('action', function ($notification) {
                return view('components.actions', [
                    'notification' => $notification,
                    'routeEdit' => auth()->user()->can('notifications update') ? 'admin.notifications.edit' : '',
                    'routeDelete' => auth()->user()->can('notifications delete') ? 'admin.notifications.destroy' : '',
                    'routeShow' => '',
                    'id' => $notification->id,
                    'table' => 'notifications_table',
                ]);
            })
            ->rawColumns(['action', 'status']);
    }

    public function query(Notification $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('notifications_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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

            Column::make('title')
                ->title('العنوان')
                ->addClass('text-center pt-3'),

            Column::make('desc')
                ->title('الوصف')
                ->addClass('text-center pt-3'),

            Column::computed('status')
                ->title('الحالة')
                ->exportable(false)
                ->printable(false)
                ->width(130)
                ->addClass('text-center pt-3'),

            Column::make('created_at')
                ->title('تاريخ الإضافة')
                ->addClass('text-center pt-3'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center pt-3')
                ->title('الإجراءات'),
        ];
    }

    protected function filename(): string
    {
        return 'Notifications_'.date('YmdHis');
    }
}
