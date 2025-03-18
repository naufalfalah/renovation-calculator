<?php

namespace App\Enums;

enum BaseUnitEnum: string
{
    case SQFT = 'sqft';
    case M2 = 'm2';

    public function label(): string
    {
        return match ($this) {
            self::SQFT => 'sqft',
            self::M2 => 'm2',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
