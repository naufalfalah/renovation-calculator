<?php

namespace App\Enums;

enum WorkTypeEnum: string
{
    case HACKING = 'Hacking';
    case MASONRY = 'Masonry';
    case CARPENTRY = 'Carpentry';
    case CEILING_PARTITION = 'Ceiling & Partition';
    case PLUMBING = 'Plumbing';
    case ELECTRICAL = 'Electrical';
    case PAINTING = 'Painting';
    case GLASS_ALUMINIUM = 'Glass & Aluminium';
    case CLEANING_POLISHING = 'Cleaning & Polishing';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
