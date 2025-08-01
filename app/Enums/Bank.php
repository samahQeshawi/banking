<?php

namespace App\Enums;

enum Bank: string
{
    case AlRajhi = 'Al-Rajhi Bank';
    case SNB = 'Al-Ahli (SNB)';
    case SaudiInvestment = 'The Saudi Investment Bank';
    case Alinma = 'Alinma Bank';
    case Fransi = 'Banque Saudi Fransi';
    case Riyad = 'Riyad Bank';
    case Alawwal = 'Alawwal Bank (SAB)';
    case AlBilad = 'Al Bilad Bank';
    case AlJazira = 'Bank AlJazira';
    case Meem = 'Meem Bank';
    case Samba = 'Samba Financial Group';
    case ANB = 'Arab National Bank';
    case QNB = 'QNB Group';
    case EmiratesNBD = 'Emirates NBD';

    public function label(): string
    {
        return match ($this) {
            self::AlRajhi => 'مصرف الراجحي',
            self::SNB => 'الأهلي (البنك السويسري)',
            self::SaudiInvestment => 'البنك السعودي للاستثمار',
            self::Alinma => 'بنك الإنماء',
            self::Fransi => 'البنك السعودي الفرنسي',
            self::Riyad => 'بنك الرياض',
            self::Alawwal => 'البنك الأول (ساب)',
            self::AlBilad => 'بنك البلاد',
            self::AlJazira => 'بنك الجزيرة',
            self::Meem => 'بنك ميم',
            self::Samba => 'مجموعة سامبا المالية',
            self::ANB => 'البنك العربي الوطني',
            self::QNB => 'مجموعة QNB',
            self::EmiratesNBD => 'بنك الإمارات دبي الوطني',
        };
    }

    public static function options(): array
    {
        return array_map(fn (self $bank) => [
            'value' => $bank->value,
            'label' => $bank->label(),
        ], self::cases());
    }
}
