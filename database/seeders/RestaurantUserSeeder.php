<?php

namespace Database\Seeders;

use App\Models\RestaurantUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RestaurantUser::insert([
            [
                'restaurant_id' => 1,
                'user_id' => 1,
            ],
            [
                'restaurant_id' => 6,
                'user_id' => 1,
            ]
        ]);
    }
}
