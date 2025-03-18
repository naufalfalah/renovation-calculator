<?php

namespace App\Enums;

enum WorkPackageNameEnum: string
{
    case LIGHT = 'light';
    case MODERATE = 'moderate';
    case EXTENSIVE = 'extensive';

    public function label(): string
    {
        return match($this) {
            self::LIGHT => 'Light',
            self::MODERATE => 'Moderate',
            self::EXTENSIVE => 'Extensive',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
