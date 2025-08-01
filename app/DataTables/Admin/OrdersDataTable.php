<?php

namespace App\DataTables\Admin;

use App\DataTables\BaseOrdersDataTable;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class OrdersDataTable extends BaseOrdersDataTable
{
    protected string $tableId = 'orders_table';

    protected string $routeShow = 'admin.orders.show';

    protected string $statusViewPath = 'dashboard.admin.orders.status';

    protected bool $showRestaurantColumn = true;

    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()->with(['customer', 'restaurant']);
    }

    public function getRouteShow(): string
    {
        return auth()->user()?->can('orders display') ? $this->routeShow : '';
    }
}
