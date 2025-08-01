<?php

namespace App\Enums;

enum OrderStatuses: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case PREPARING = 'preparing';
    case READY = 'ready';
    case DRIVER_REACHED_RESTAURANT = 'driver_reached_restaurant';
    case PICKED_BY_DRIVER = 'picked_by_driver';
    case DRIVER_REACHED_CLIENT = 'driver_reached_client';
    case COMPLETED = 'completed';
    case CANCELED_BY_CUSTOMER = 'canceled_by_customer';
    case CANCELED_BY_RESTAURANT = 'canceled_by_restaurant';
}
