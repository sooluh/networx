<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class SpkWidget extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.spk-widget';

    protected function getViewData(): array
    {
        return [
            'description' => 'Sistem Pendukung Keputusan (SPK) adalah sistem informasi berbasis komputer yang dirancang untuk membantu pengambil keputusan dalam menganalisis dan memecahkan permasalahan kompleks dengan memberikan informasi dan rekomendasi yang mendukung proses pengambilan keputusan.',
        ];
    }
}
