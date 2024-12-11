<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class MooraWidget extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.moora-widget';

    protected function getViewData(): array
    {
        return [
            'description' => 'Metode MOORA (Multi-Objective Optimization on the basis of Ratio Analysis) adalah metode pengambilan keputusan multi-kriteria yang digunakan untuk menyeleksi dan mengevaluasi alternatif terbaik berdasarkan sejumlah kriteria. Metode ini mengoptimalkan beberapa atribut atau kriteria secara bersamaan dengan menggunakan rasio optimasi.',
        ];
    }
}
