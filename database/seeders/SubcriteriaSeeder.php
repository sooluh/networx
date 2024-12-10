<?php

namespace Database\Seeders;

use App\Models\Subcriteria;
use Illuminate\Database\Seeder;

class SubcriteriaSeeder extends Seeder
{
    public function run(): void
    {
        Subcriteria::insert([
            [
                'id' => 1,
                'criteria_id' => 1,
                'name' => '100-200',
                'value' => '1',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'criteria_id' => 1,
                'name' => '201-300',
                'value' => '2',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'criteria_id' => 1,
                'name' => '301-400',
                'value' => '3',
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'criteria_id' => 1,
                'name' => '401-500',
                'value' => '4',
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'criteria_id' => 1,
                'name' => '501-600',
                'value' => '5',
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'criteria_id' => 2,
                'name' => 'Sangat Tidak Baik',
                'value' => '1',
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'criteria_id' => 2,
                'name' => 'Tidak Baik',
                'value' => '2',
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'criteria_id' => 2,
                'name' => 'Cukup Baik',
                'value' => '3',
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'criteria_id' => 2,
                'name' => 'Baik',
                'value' => '4',
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'criteria_id' => 2,
                'name' => 'Sangat Baik',
                'value' => '5',
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'criteria_id' => 3,
                'name' => 'Sangat Kuat',
                'value' => '1',
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'criteria_id' => 3,
                'name' => 'Kuat',
                'value' => '2',
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'criteria_id' => 3,
                'name' => 'Cukup Kuat',
                'value' => '3',
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'criteria_id' => 3,
                'name' => 'Tidak Kuat',
                'value' => '4',
                'created_at' => now(),
            ],
            [
                'id' => 15,
                'criteria_id' => 3,
                'name' => 'Sangat Tidak Kuat',
                'value' => '5',
                'created_at' => now(),
            ],
            [
                'id' => 16,
                'criteria_id' => 4,
                'name' => '1-5 JT',
                'value' => '1',
                'created_at' => now(),
            ],
            [
                'id' => 17,
                'criteria_id' => 4,
                'name' => '5-10 JT',
                'value' => '2',
                'created_at' => now(),
            ],
            [
                'id' => 18,
                'criteria_id' => 4,
                'name' => '10-15 JT',
                'value' => '3',
                'created_at' => now(),
            ],
            [
                'id' => 19,
                'criteria_id' => 4,
                'name' => '15-20 JT',
                'value' => '4',
                'created_at' => now(),
            ],
            [
                'id' => 20,
                'criteria_id' => 4,
                'name' => '20-25 JT',
                'value' => '5',
                'created_at' => now(),
            ],
            [
                'id' => 21,
                'criteria_id' => 5,
                'name' => '2.6 KM+',
                'value' => '1',
                'created_at' => now(),
            ],
            [
                'id' => 22,
                'criteria_id' => 5,
                'name' => '2.1-2.5 KM',
                'value' => '2',
                'created_at' => now(),
            ],
            [
                'id' => 23,
                'criteria_id' => 5,
                'name' => '1.6-2 KM',
                'value' => '3',
                'created_at' => now(),
            ],
            [
                'id' => 24,
                'criteria_id' => 5,
                'name' => '1.1-1.5 KM',
                'value' => '4',
                'created_at' => now(),
            ],
            [
                'id' => 25,
                'criteria_id' => 5,
                'name' => '0-1 KM',
                'value' => '5',
                'created_at' => now(),
            ],
        ]);
    }
}
