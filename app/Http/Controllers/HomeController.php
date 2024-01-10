<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class HomeController extends Controller
{
    public function index()
    {
        //     if (Auth::check()) {
        //         $restaurant_user = auth()->user()->restaurant;
        //         $restaurant_id = $restaurant_user->pluck('id');
        //         $list_restaurant = Restaurant::whereNotIn('id', $restaurant_id)->get();

        //         return view('index', ['restaurants' => $list_restaurant]);
        //     }else {
        //         $restaurants = Restaurant::all();
        //         return view('index', compact('restaurants'));
        //     }

        $restaurants = Restaurant::all();

        return view('index', compact('restaurants'));
    }
}
