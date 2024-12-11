<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MooraWidget;
use App\Filament\Widgets\SpkWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            SpkWidget::class,
            MooraWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
