<?php

namespace App\DataTables\Admin;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouponsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query()
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($coupon) {
                if (Route::is('admin.restaurants-coupons.*')) {
                    $routeEdit = auth()->user()->can('coupons update') ? 'admin.restaurants-coupons.edit' : '';
                    $routeDelete = auth()->user()->can('coupons delete') ? 'admin.restaurants-coupons.destroy' : '';
                } else {
                    $routeEdit = auth()->user()->can('coupons update') ? 'admin.coupons.edit' : '';
                    $routeDelete = auth()->user()->can('coupons delete') ? 'admin.coupons.destroy' : '';
                }

                return view('components.actions', [
                    'id' => $coupon->id,
                    'routeEdit' => $routeEdit,
                    'routeDelete' => $routeDelete,
                    'routeShow' => '',
                    'table' => 'coupons_table',
                ]);
            })
            ->addColumn('iterator', function () {
                static $i = 1;

                return $i++;
            })
            ->addColumn('status', function ($coupon) {
                return view('components.status', [
                    'id' => $coupon->id,
                    'status' => $coupon->status,
                    'tableId' => 'coupons_table',
                    'routeStatus' => auth()->user()?->can('coupons update') ? 'admin.coupons.updateStatus' : null,
                ]);
            })
            ->addColumn('discount_display', function ($coupon) {
                return $coupon->discount_type === 'percentage'
                    ? $coupon->discount_amount.'%'
                    : number_format($coupon->discount_amount, 2);
            })
            ->addColumn('start_date', function ($coupon) {
                return optional($coupon->start_date)->format('Y-m-d');
            })
            ->addColumn('end_date', function ($coupon) {
                return optional($coupon->end_date)->format('Y-m-d');
            })
            ->rawColumns(['action', 'status', 'discount_display']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model)
    {
        $query = $model->newQuery();

        if (Route::is('admin.restaurants-coupons.*')) {
            $query->whereNotNull('restaurant_id');
        } else {
            $query->whereNull('restaurant_id');
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coupons_table')
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

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns(): array
    {
        return [
            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::make('code')
                ->title('رمز الكوبون')
                ->addClass('text-center pt-3'),

            Column::computed('discount_display')
                ->title('الخصم')
                ->addClass('text-center pt-3'),

            Column::make('start_date')
                ->title('تاريخ البدء')
                ->addClass('text-center pt-3'),

            Column::make('end_date')
                ->title('تاريخ الانتهاء')
                ->addClass('text-center pt-3'),

            Column::make('usage_limit')
                ->title('حد الاستخدام')
                ->addClass('text-center pt-3'),

            Column::make('usage_limit_per_user')
                ->title('لكل مستخدم')
                ->addClass('text-center pt-3'),

            Column::computed('status')
                ->title('الحالة')
                ->addClass('text-center pt-3'),

            Column::computed('action')
                ->title('الإجراءات')
                ->addClass('text-center pt-3')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupons_'.date('YmdHis');
    }
}
