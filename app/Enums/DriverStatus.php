<?php

namespace App\Enums;

enum DriverStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Suspended = 'suspended';
    case Banned = 'banned';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'فعال',
            self::Inactive => 'غير فعال',
            self::Suspended => 'معلق',
            self::Banned => 'موقوف',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'secondary',
            self::Suspended => 'warning',
            self::Banned => 'danger',
        };
    }

    public function next(): self
    {
        return match ($this) {
            self::Active => self::Inactive,
            self::Inactive => self::Suspended,
            self::Suspended => self::Banned,
            self::Banned => self::Active,
        };
    }
}
