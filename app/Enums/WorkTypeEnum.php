<?php

namespace App\Enums;

enum WorkTypeEnum: string
{
    case HACKING = 'hacking';
    case MASONRY = 'masonry';
    case CARPENTRY = 'carpentry';
    case CEILING_PARTITION = 'ceiling_partition';
    case PLUMBING = 'plumbing';
    case ELECTRICAL = 'electrical';
    case PAINTING = 'painting';
    case GLASS_ALUMINIUM = 'glass_aluminium';
    case CLEANING_POLISHING = 'cleaning_polishing';

    public function label(): string
    {
        return match ($this) {
            self::HACKING => 'Hacking',
            self::MASONRY => 'Masonry',
            self::CARPENTRY => 'Carpentry',
            self::CEILING_PARTITION => 'Ceiling & Partition',
            self::PLUMBING => 'Plumbing',
            self::ELECTRICAL => 'Electrical',
            self::PAINTING => 'Painting',
            self::GLASS_ALUMINIUM => 'Glass & Aluminium',
            self::CLEANING_POLISHING => 'Cleaning & Polishing',
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
