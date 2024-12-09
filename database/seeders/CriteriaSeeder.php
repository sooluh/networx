<?php

namespace Database\Seeders;

use App\Enums\CriteriaType;
use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    public function run(): void
    {
        Criteria::insert([
            [
                'id' => 1,
                'code' => '1',
                'name' => 'Jumlah Banyaknya Rumah',
                'weight' => '0.26',
                'type' => CriteriaType::BENEFIT->value,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'code' => '2',
                'name' => 'Respon Warga Terhadap Penanaman Tiang',
                'weight' => '0.15',
                'type' => CriteriaType::BENEFIT->value,
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'code' => '3',
                'name' => 'Kompetitor',
                'weight' => '0.10',
                'type' => CriteriaType::BENEFIT->value,
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'code' => '4',
                'name' => 'Harga Buka Area',
                'weight' => '0.23',
                'type' => CriteriaType::COST->value,
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'code' => '5',
                'name' => 'Jarak OLT',
                'weight' => '0.26',
                'type' => CriteriaType::BENEFIT->value,
                'created_at' => now(),
            ],
        ]);
    }
}
