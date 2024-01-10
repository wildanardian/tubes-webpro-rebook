<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::insert([
            [
                'name' => 'Restaurant 1',
                'description' => 'Restaurant 1 description',
                'address' => 'Restaurant 1 address',
                'opening_day_from' => 'Monday',
                'opening_day_to' => 'Sunday',
                'opening_hour_from' => '08:00',
                'opening_hour_to' => '22:00',
                'contact' => '082222222222',
            ],
            [
                'name' => 'Restaurant 2',
                'description' => 'Restaurant 2 description',
                'address' => 'Restaurant 2 address',
                'opening_day_from' => 'Monday',
                'opening_day_to' => 'Sunday',
                'opening_hour_from' => '08:00',
                'opening_hour_to' => '22:00',
                'contact' => '082134567890',
            ],
            [
                'name' => 'Restaurant 3',
                'description' => 'Restaurant 3 description',
                'address' => 'Restaurant 3 address',
                'opening_day_from' => 'Monday',
                'opening_day_to' => 'Sunday',
                'opening_hour_from' => '08:00',
                'opening_hour_to' => '22:00',
                'contact' => '087999647332',
            ],
            [
                'name' => 'Restaurant 4',
                'description' => 'Restaurant 4 description',
                'address' => 'Restaurant 4 address',
                'opening_day_from' => 'Monday',
                'opening_day_to' => 'Sunday',
                'opening_hour_from' => '08:00',
                'opening_hour_to' => '22:00',
                'contact' => '0898347635735',
            ],
            [
                'name' => 'Restaurant 5',
                'description' => 'Restaurant 5 description',
                'address' => 'Restaurant 5 address',
                'opening_day_from' => 'Monday',
                'opening_day_to' => 'Friday',
                'opening_hour_from' => '08:00',
                'opening_hour_to' => '22:00',
                'contact' => '088576764734321',
            ],
            [
                'name' => 'Restaurant Admin',
                'description' => 'Restaurant Admin description',
                'address' => 'Restaurant Admin address',
                'opening_day_from' => 'Monday',
                'opening_day_to' => 'Wednesday',
                'opening_hour_from' => '08:00',
                'opening_hour_to' => '22:00',
                'contact' => '0876754562421',
            ]
        ]);
    }
}
