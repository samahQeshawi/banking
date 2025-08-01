<?php

namespace App\Enums;

enum UserTypes: string
{
    case DRIVER = 'driver';
    case CUSTOMER = 'customer';
    case RESTAURANT = 'restaurant';
}
