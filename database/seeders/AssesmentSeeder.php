<?php

namespace Database\Seeders;

use App\Models\Assesment;
use Illuminate\Database\Seeder;

class AssesmentSeeder extends Seeder
{
    public function run(): void
    {
        Assesment::insert([
            [
                'alternative_id' => 1,
                'criteria_id' => 1,
                'subcriteria_id' => 1,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 1,
                'criteria_id' => 2,
                'subcriteria_id' => 9,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 1,
                'criteria_id' => 3,
                'subcriteria_id' => 11,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 1,
                'criteria_id' => 4,
                'subcriteria_id' => 18,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 1,
                'criteria_id' => 5,
                'subcriteria_id' => 25,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 1,
                'subcriteria_id' => 1,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 2,
                'subcriteria_id' => 8,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 3,
                'subcriteria_id' => 12,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 4,
                'subcriteria_id' => 17,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 5,
                'subcriteria_id' => 24,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 1,
                'subcriteria_id' => 4,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 2,
                'subcriteria_id' => 9,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 3,
                'subcriteria_id' => 11,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 4,
                'subcriteria_id' => 17,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 5,
                'subcriteria_id' => 23,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 1,
                'subcriteria_id' => 4,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 2,
                'subcriteria_id' => 7,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 3,
                'subcriteria_id' => 12,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 4,
                'subcriteria_id' => 18,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 5,
                'subcriteria_id' => 23,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 5,
                'criteria_id' => 1,
                'subcriteria_id' => 5,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 5,
                'criteria_id' => 2,
                'subcriteria_id' => 10,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 5,
                'criteria_id' => 3,
                'subcriteria_id' => 11,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 5,
                'criteria_id' => 4,
                'subcriteria_id' => 20,
                'created_at' => now(),
            ],
            [
                'alternative_id' => 5,
                'criteria_id' => 5,
                'subcriteria_id' => 21,
                'created_at' => now(),
            ],
        ]);
    }
}
