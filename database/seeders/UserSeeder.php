<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        User::create(
            [
                'first_name' => 'Techvizor',
                'last_name' => 'Admin',
                'email' => 'techvizoradmin@yopmail.com',
                'password' => bcrypt('Password123#'),
                'role' => 1,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        );

        // User::factory()->count(10)->create();
    }
}
