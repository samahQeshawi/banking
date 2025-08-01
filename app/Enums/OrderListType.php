<?php

namespace App\Enums;

enum OrderListType: string
{
    case PENDING = 'pending';
    case CURRENT = 'current';
    case COMPLETED = 'completed';
}
