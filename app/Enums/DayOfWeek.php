<?php

namespace App\Enums;

enum DayOfWeek: string
{
    case saturday = 'saturday';
    case sunday = 'sunday';
    case monday = 'monday';
    case tuesday = 'tuesday';
    case wednesday = 'wednesday';
    case thursday = 'thursday';
    case friday = 'friday';

    public function label(): string
    {
        return match ($this) {
            self::saturday => 'السبت',
            self::sunday => 'الأحد',
            self::monday => 'الاثنين',
            self::tuesday => 'الثلاثاء',
            self::wednesday => 'الأربعاء',
            self::thursday => 'الخميس',
            self::friday => 'الجمعة',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn ($case) => ['value' => $case->value, 'label' => $case->label()],
            self::cases()
        );
    }

    public static function labels(): array
    {
        return array_column(self::options(), 'label', 'value');
    }
}
