<?php

namespace Database\Seeders;

use App\Models\HealthConcern;
use Illuminate\Database\Seeder;

class HealthConcernsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthConcern::factory()->count(10)->create();
    }
}