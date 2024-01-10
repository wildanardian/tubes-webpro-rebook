<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::insert([
            [
                'restaurant_id' => 2,
                'user_id' => 1,
                'rating' => 5,
                'review' => 'Good restaurant, recommended',
            ],
            [
                'restaurant_id' => 5,
                'user_id' => 1,
                'rating' => 4,
                'review' => 'Good restaurant, recommended',
            ],
            [
                'restaurant_id' => 2,
                'user_id' => 2,
                'rating' => 5,
                'review' => 'Good restaurant, recommended',
            ],
            [
                'restaurant_id' => 5,
                'user_id' => 2,
                'rating' => 4,
                'review' => 'Good restaurant, recommended',
            ]
        ]);
    }
}
