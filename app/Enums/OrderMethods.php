<?php

namespace App\Enums;

enum OrderMethods: string
{
    case PICKUP = 'pickup';
    case DELIVERY = 'delivery';
}
