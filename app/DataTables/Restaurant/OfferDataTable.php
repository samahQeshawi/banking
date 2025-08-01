<?php

namespace App\DataTables\Restaurant;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfferDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('iterator', function ($offer) {
                static $i = 1;

                return $i++;
            })

            ->addColumn('type', function ($offer) {
                return $offer->type === 'fixed' ? 'مبلغ ثابت' : 'نسبة مئوية';
            })

            ->addColumn('offer_type', function ($offer) {
                return optional($offer->offerType)->title ?? '-';
            })

            ->addColumn('action', function ($offer) {
                return view('components.actions', [
                    'routeShow' => 'restaurant.offers.show',
                    'routeEdit' => 'restaurant.offers.edit',
                    'routeDelete' => 'restaurant.offers.destroy',
                    'id' => $offer->id,
                    'table' => $this->tableId,
                ]);
            })

            ->rawColumns(['action']);
    }

    public function query(Offer $model): QueryBuilder
    {
        $restaurantId = auth('restaurant')->user()->id;

        return $model->with('offerType')
            ->where('restaurant_id', $restaurantId)
            ->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('offers_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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

            Column::make('offer_type')
                ->title('نوع العرض')
                ->addClass('text-center pt-3'),

            Column::make('type')
                ->title('نوع الخصم')
                ->addClass('text-center pt-3'),

            Column::make('value')
                ->title('القيمة')
                ->addClass('text-center pt-3'),

            Column::make('start')
                ->title('تاريخ البداية')
                ->addClass('text-center pt-3'),

            Column::make('end')
                ->title('تاريخ النهاية')
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
}
