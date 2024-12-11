<?php

namespace App\Models;

use App\Enums\CriteriaType;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Result extends Model
{
    use Sushi;

    public function getRows()
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

        $data = [];
        foreach ($alternatives as $alternative) {
            $sumBenefit = 0;
            $sumCost = 0;

            foreach ($criterias as $criteria) {
                $assesment = $alternative->assesments->firstWhere('criteria_id', $criteria->id);
                $raw = $assesment && $assesment->subcriteria ? (float) $assesment->subcriteria->value : 0;
                $normalized = $denominators[$criteria->id] != 0 ? ($raw / $denominators[$criteria->id]) : 0;
                $weighted = $normalized * $criteria->weight;

                if ((int) $criteria->type === CriteriaType::COST->value) {
                    $weighted = -$weighted;
                    $sumCost += $weighted;
                } else {
                    $sumBenefit += $weighted;
                }
            }

            $yi = $sumBenefit + $sumCost;

            $data[] = [
                'id' => $alternative->id,
                'code' => $alternative->code,
                'name' => $alternative->name,
                'yi' => $yi,
            ];
        }

        usort($data, fn ($a, $b) => $b['yi'] <=> $a['yi']);

        foreach ($data as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        return $data;
    }

    protected $schema = [
        'id' => 'integer',
        'code' => 'integer',
        'name' => 'string',
        'yi' => 'float',
        'rank' => 'integer',
    ];
}
