<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/register', [AuthController::class, 'authRegister'])->name('register');

Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-restaurant', [RestaurantController::class, 'myRestaurant'])->name('my-restaurant.index');
    Route::get('/my-restaurant/create', [RestaurantController::class, 'myRestaurantCreate'])->name('my-restaurant.create');
    Route::post('/my-restaurant/create', [RestaurantController::class, 'myRestaurantStore'])->name('my-restaurant.store');
    Route::get('/my-restaurant/{id}', [RestaurantController::class, 'myRestaurantShow'])->name('my-restaurant.show');
    Route::get('/my-restaurant/edit/{id}', [RestaurantController::class, 'myRestaurantEdit'])->name('my-restaurant.edit');
    Route::post('/my-restaurant/edit/{id}', [RestaurantController::class, 'myRestaurantUpdate'])->name('my-restaurant.update');
    Route::delete('/my-restaurant/delete/{id}', [RestaurantController::class, 'myRestaurantDelete'])->name('my-restaurant.delete');

    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{id}', [RestaurantController::class, 'restaurantDetail'])->name('restaurants.show');
    Route::post('/restaurant/review/store', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/create', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/delete/{id}', [BookingController::class, 'destroy'])->name('booking.delete');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [AuthController::class, 'profileUpdate'])->name('profile.update');
});

