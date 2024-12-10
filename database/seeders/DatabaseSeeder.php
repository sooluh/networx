<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CriteriaSeeder::class,
            SubcriteriaSeeder::class,
            AlternativeSeeder::class,
            AssesmentSeeder::class,
        ]);
    }
}
