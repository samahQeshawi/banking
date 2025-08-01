<?php

namespace App\DataTables\Admin;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RestaurantsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($restaurant) {
                return view('components.actions', [
                    'id' => $restaurant->id,
                    'routeEdit' => auth()->user()?->can('restaurants update') ? 'admin.restaurants.edit' : '',
                    'routeDelete' => auth()->user()?->can('restaurants delete') ? 'admin.restaurants.destroy' : '',
                    'routeShow' => '',
                    'table' => 'restaurants_table',
                ]);
            })
            ->addColumn('iterator', function ($group) {
                static $loopCounter = 1;

                return $loopCounter++;
            })

            ->addColumn('section', function ($restaurant) {
                if ($restaurant->section) {
                    return '<span class="badge rounded-pill pb-2 bg-light-primary text-primary border">'.e($restaurant->section->title).'</span>';
                }

                return '';
            })

            ->addColumn('category', function ($restaurant) {
                $categories = $restaurant->categories;
                if ($categories->isEmpty()) {
                    return '<span class="text-muted">-</span>';
                }
                $badges = $categories->map(function ($category) {
                    return '<span class="badge rounded-pill pb-2 bg-light-info text-info border">'
                    .e($category->title).'</span>';
                })->implode(' ');

                return '<div class="d-flex flex-wrap gap-1">'.$badges.'</div>';
            })

            ->addColumn('owner_name', function ($restaurant) {
                return @$restaurant->owner_name;
            })
            ->addColumn('phone', function ($restaurant) {
                return @$restaurant->phone;
            })
            ->addColumn('logo', function ($restaurant) {
                return view('components.image', ['photo' => $restaurant->img_url]);
            })
            ->addColumn('status', function ($restaurant) {
                return view('components.status', [
                    'id' => $restaurant->id,
                    'status' => $restaurant->status,
                    'tableId' => 'restaurants_table',
                    'routeStatus' => auth()->user()?->can('restaurants update') ? 'admin.restaurants.updateStatus' : null,
                ]);
            })
            // ->addColumn('subscription_action', function ($restaurant) {
            //     $latest = $restaurant->subscriptions()
            //         ->orderByDesc('end_date')
            //         ->first();

            //     $label = 'اشتراك';
            //     $type = 'primary';
            //     $disabled = false;

            //     if ($latest) {
            //         if ($latest->pivot->end_date < now()) {
            //             $label = 'تجديد الاشتراك';
            //             $type = 'warning';
            //         } elseif ($latest->pivot->end_date >= now() && $latest->pivot->active) {
            //             $label = 'تجديد الاشتراك';
            //             $type = 'success';
            //             $disabled = true;
            //         } elseif ($latest->pivot->end_date >= now() && ! $latest->pivot->active) {
            //             $label = 'الاشتراك غير مفعل';
            //             $type = 'danger';
            //             $disabled = true;
            //         }
            //     }

            //     return view('dashboard.admin.restaurants.subscribe', [
            //         'restaurantId' => $restaurant->id,
            //         'label' => $label,
            //         'disabled' => $disabled,
            //         'type' => $type,
            //     ]);
            // })
            ->rawColumns(['action', 'iterator', 'category', 'section', 'logo', 'status']);
    }

    public function query(Restaurant $model)
    {
        $query = $model->with(['section', 'categories'])->newQuery();

        if (request()->has('filter_section') && request('filter_section') != '') {
            $query->whereHas('section', function ($q) {
                $q->where('title', request('filter_section'));
            });
        }

        if (request()->has('filter_category') && request('filter_category') != '') {
            $query->whereHas('categories', function ($q) {
                $q->where('title', request('filter_category'));
            });
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('restaurants_table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('admin.restaurants.index'), // أو اتركه null إذا هو نفس المسار الحالي
                'data' => 'function(d) {
                   d.filter_section = $("#filter-section").val();
                   d.filter_category = $("#filter-category").val();
                }',
            ])
            //            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->language([
                'paginate' => [
                    'next' => 'التالي',
                    'previous' => 'السابق',
                ],
            ]);

    }

    protected function getColumns()
    {
        return [

            Column::computed('iterator')
                ->title('#')
                ->addClass('text-center pt-3'),

            Column::computed('logo')
                ->title('الصورة')
                ->addClass('text-center pt-3'),

            Column::computed('owner_name')
                ->title('اسم المالك')
                ->addClass('text-center pt-3'),

            Column::make('name')
                ->title('اسم المطبخ')
                ->addClass('text-center pt-3'),

            Column::computed('phone')
                ->title('رقم الهاتف')
                ->addClass('text-center pt-3'),

            Column::computed('section')
                ->title('القسم')
                ->addClass('text-center pt-3'),

            Column::computed('category')
                ->title('التصنيفات')
                ->addClass('text-center pt-3'),

            Column::computed('status')
                ->title('الحالة')
                ->addClass('text-center pt-3'),

            // Column::computed('subscription_action')
            //     ->title('الاشتراك')
            //     ->addClass('text-center pt-3'),

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
