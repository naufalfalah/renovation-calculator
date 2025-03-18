<?php

namespace App\Enums;

enum PropertyTypeEnum: string
{
    case HDB = 'hdb';
    case CONDO = 'condo';
    case LANDED = 'landed';

    public function label(): string
    {
        return match ($this) {
            self::HDB => 'HDB',
            self::CONDO => 'Condo',
            self::LANDED => 'Landed',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labelFromValue(string $value): string
    {
        $case = self::tryFrom($value);

        return $case?->label() ?? 'Unknown';
    }
}
