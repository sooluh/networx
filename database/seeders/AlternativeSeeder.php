<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    public function run(): void
    {
        Alternative::insert([
            [
                'id' => 1,
                'code' => '1',
                'name' => 'Desa Citeko',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'code' => '2',
                'name' => 'Desa Cadasmekar',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'code' => '3',
                'name' => 'CItalang',
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'code' => '4',
                'name' => 'Batutumpang',
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'code' => '5',
                'name' => 'Liunggunung',
                'created_at' => now(),
            ],
        ]);
    }
}
