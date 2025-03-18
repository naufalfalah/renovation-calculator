<?php

namespace App\Enums;

enum PropertyStatusEnum: string
{
    case NEW = 'new';
    case RESALE = 'resale';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'New',
            self::RESALE => 'Resale',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
