<?php

namespace Database\Seeders;

use App\Models\PackageCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PackageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Popular Packages',
                'slug' => 'popular-packages',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Fever',
                'slug' => 'fever',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Women Health',
                'slug' => 'women-health',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Fitness',
                'slug' => 'fitness',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lifestyle Habits',
                'slug' => 'lifestyle-habits',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        PackageCategory::insert($data);

    }
}
