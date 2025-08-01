<?php

namespace App\Enums;

enum PaymentTypes: string
{
    case CREDIT_CARD = 'credit_card';
    case STC = 'stc';
    case MADA = 'mada';
    case APPLE_PAY = 'apple_pay';
}
