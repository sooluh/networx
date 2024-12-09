<?php

namespace App\Enums;

enum CriteriaType: int
{
    case BENEFIT = 0;
    case COST = 1;

    public function label(): string
    {
        return match ($this) {
            self::BENEFIT => 'Benefit (Keuntungan)',
            self::COST => 'Cost (Biaya)',
        };
    }
}
