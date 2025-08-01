<?php

namespace App\DataTables\Restaurant;

use App\DataTables\BaseOrdersDataTable;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class OrdersDataTable extends BaseOrdersDataTable
{
    protected string $tableId = 'restaurant_orders_table';

    protected string $routeShow = 'restaurant.orders.show';

    protected string $statusViewPath = 'dashboard.restaurant.orders.status';

    protected bool $showRestaurantColumn = false;

    public function query(Order $model): QueryBuilder
    {
        $restaurantId = auth('restaurant')->user()->id;

        return $model->newQuery()
            ->where('restaurant_id', $restaurantId)
            ->with(['customer']);
    }

    public function getRouteShow(): string
    {
        return $this->routeShow;
    }
}
