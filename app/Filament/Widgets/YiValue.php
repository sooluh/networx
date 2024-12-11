<?php

namespace App\Filament\Widgets;

use App\Enums\CriteriaType;
use App\Models\Alternative;
use App\Models\Criteria;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class YiValue extends BaseWidget
{
    protected function getYiValues(): array
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
            $sumBenefit = 0;
            $sumCost = 0;

            foreach ($criterias as $criteria) {
                $assesment = $alternative->assesments->firstWhere('criteria_id', $criteria->id);
                $raw = $assesment && $assesment->subcriteria ? (float) $assesment->subcriteria->value : 0;
                $normalized = $denominators[$criteria->id] != 0 ? ($raw / $denominators[$criteria->id]) : 0;
                $weighted = $normalized * $criteria->weight;

                if ($criteria->type === CriteriaType::COST->value) {
                    $weighted = -$weighted;
                    $sumCost += $weighted;
                } else {
                    $sumBenefit += $weighted;
                }
            }

            $yi = $sumBenefit + $sumCost;

            $values[$alternative->id] = [
                'sumBenefit' => $sumBenefit,
                'sumCost' => $sumCost,
                'yi' => $yi,
            ];
        }

        return $values;
    }

    protected function getTableColumns(): array
    {
        $yiValues = $this->getYiValues();
        $criterias = Criteria::all();

        $benefitCriterias = $criterias->filter(fn ($c) => $c->type === CriteriaType::BENEFIT->value);
        $costCriterias = $criterias->filter(fn ($c) => $c->type === CriteriaType::COST->value);

        $benefitCodes = $benefitCriterias->pluck('code')->map(fn ($c) => "C{$c}")->join(', ');
        $costCodes = $costCriterias->pluck('code')->map(fn ($c) => "C{$c}")->join(', ');

        $maxLabel = 'Maximum ('.$benefitCodes.')';
        $minLabel = 'Minimum ('.$costCodes.')';
        $yiLabel = 'Yi = Max - Min';

        $columns = [
            TextColumn::make('code')
                ->label('Kode')
                ->formatStateUsing(fn (string $state) => "A{$state}"),

            TextColumn::make('name')->label('Alternatif'),

            TextColumn::make('max_value')
                ->label($maxLabel)
                ->getStateUsing(function ($record) use ($yiValues) {
                    return isset($yiValues[$record->id])
                        ? number_format($yiValues[$record->id]['sumBenefit'], 3)
                        : '-';
                }),

            TextColumn::make('min_value')
                ->label($minLabel)
                ->getStateUsing(function ($record) use ($yiValues) {
                    if (! isset($yiValues[$record->id])) {
                        return '-';
                    }

                    return number_format(abs($yiValues[$record->id]['sumCost']), 3);
                }),

            TextColumn::make('yi')
                ->label($yiLabel)
                ->getStateUsing(function ($record) use ($yiValues) {
                    return isset($yiValues[$record->id])
                        ? number_format($yiValues[$record->id]['yi'], 3)
                        : '-';
                }),
        ];

        return $columns;
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Nilai Yi')
            ->columns($this->getTableColumns())
            ->query(Alternative::query()->with('assesments.subcriteria', 'assesments.criteria'))
            ->paginated(false);
    }
}
