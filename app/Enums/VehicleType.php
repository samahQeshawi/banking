<?php

namespace App\Enums;

enum VehicleType: int
{
    case Private = 1;         // خاص
    case PublicTransport = 2; // نقل عام
    case PrivateTransport = 3; // نقل خاص
    case Temporary = 4;       // مؤقت
    case Diplomatic = 5;      // دبلوماسي
    case Export = 6;          // تصدير
    case PublicWorks = 7;     // اعمال عامة
    case PrivateBus = 8;      // باص نقل خاص
    case PublicBus = 9;       // باص نقل عام
    case Taxi = 10;           // سيارة أجرة

    public function label(): string
    {
        return match ($this) {
            self::Private => 'خاص',
            self::PublicTransport => 'نقل عام',
            self::PrivateTransport => 'نقل خاص',
            self::Temporary => 'مؤقت',
            self::Diplomatic => 'دبلوماسي',
            self::Export => 'تصدير',
            self::PublicWorks => 'اعمال عامة',
            self::PrivateBus => 'باص نقل خاص',
            self::PublicBus => 'باص نقل عام',
            self::Taxi => 'سيارة أجرة',
        };
    }
}
