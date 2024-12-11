<?php

namespace App\Filament\Widgets;

use App\Enums\CriteriaType;
use App\Models\Alternative;
use App\Models\Criteria;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class WeightNormalizedMatrix extends BaseWidget
{
    protected function getWeightedNormalizedValues(): array
    {
        $alternatives = Alternative::with('assesments.subcriteria', 'assesments.criteria')->get();
        $criterias = Criteria::all();

        $items = [];
        foreach ($alternatives as $alternative) {
            foreach ($criterias as $criteria) {
                $assesment = $alternative->assesments->firstWhere('criteria_id', $criteria->id);
                $value = $assesment && $assesment->subcriteria ? (float) $assesment->subcriteria->value : 0;
                $items[$criteria->id][] = $value;
            }
        }

        $denominators = [];
        foreach ($criterias as $criteria) {
            $squared = 0;

            if (! empty($items[$criteria->id])) {
                foreach ($items[$criteria->id] as $val) {
                    $squared += ($val ** 2);
                }
            }

            $denominators[$criteria->id] = $squared > 0 ? sqrt($squared) : 1;
        }

        $values = [];
        foreach ($alternatives as $alternative) {
            foreach ($criterias as $criteria) {
                $assesment = $alternative->assesments->firstWhere('criteria_id', $criteria->id);
                $raw = $assesment && $assesment->subcriteria ? (float) $assesment->subcriteria->value : 0;
                $normalized = $denominators[$criteria->id] != 0 ? ($raw / $denominators[$criteria->id]) : 0;
                $weighted = $normalized * $criteria->weight;

                if ($criteria->type === CriteriaType::COST) {
                    $weighted = -$weighted;
                }

                $values[$alternative->id][$criteria->id] = $weighted;
            }
        }

        return $values;
    }

    protected function getTableColumns(): array
    {
        $normalized = $this->getWeightedNormalizedValues();
        $criterias = Criteria::all();

        $columns = [
            TextColumn::make('code')->label('Kode')->formatStateUsing(fn (string $state) => "A{$state}"),
            TextColumn::make('name')->label('Alternatif'),
        ];

        foreach ($criterias as $criteria) {
            $columns[] = TextColumn::make("C{$criteria->code}")
                ->label("C{$criteria->code}")
                ->getStateUsing(function ($record) use ($criteria, $normalized) {
                    return isset($normalized[$record->id][$criteria->id])
                        ? number_format($normalized[$record->id][$criteria->id], 3)
                        : '-';
                });
        }

        return $columns;
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Matriks Ternormalisasi Terbobot')
            ->columns($this->getTableColumns())
            ->query(Alternative::query()->with('assesments.subcriteria', 'assesments.criteria'))
            ->paginated(false);
    }
}
