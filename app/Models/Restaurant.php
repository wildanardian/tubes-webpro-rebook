<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'opening_day_from',
        'opening_day_to',
        'opening_hour_from',
        'opening_hour_to',
        'contact',
        'image',
    ];

    public function listBooking()
    {
        return $this->hasMany(Booking::class, 'restaurant_id', 'id');
    }

    public function getReviewCount()
    {
        return Review::where('restaurant_id', $this->id)->count();
    }

    public function getReviewAverage()
    {
        $average = Review::where('restaurant_id', $this->id)->avg('rating');
        return round($average, 1);
    }
}
