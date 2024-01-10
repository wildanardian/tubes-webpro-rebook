<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantUser;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function restaurantDetail(String $id)
    {
        $restaurant = Restaurant::find($id);

        $open_from = Carbon::parse('next ' . $restaurant->opening_day_from);
        $open_to = $open_from->copy()->next($restaurant->opening_day_to);
        $number_days = $open_to->diffInDays($open_from) + 1;

        $days = [];
        for ($i = 0; $i < $number_days; $i++) {
            $days[] = $open_from->copy()->addDays($i)->format('l');
        }

        $hour_from = $restaurant->opening_hour_from;
        $hour_to = $restaurant->opening_hour_to;

        $time_category = $this->getTimeCategory($hour_from, $hour_to);

        $restaurant_user = auth()->user()->restaurant;
        $restaurant_user_id = $restaurant_user->pluck('id');

        $reviews = Review::where('restaurant_id', $id)->get();
        $name = '';
        if (count($reviews) != 0) {
            $user = User::find($reviews[0]->user_id);
            if ($user->full_name != null) {
                $name = $user->full_name;
            } else {
                $name = $user->username;
            }
        }

        return view('restaurants.detail', [
            'restaurant' => $restaurant,
            'days' => $days,
            'time_category' => $time_category,
            'restaurant_user_id' => $restaurant_user_id,
            'reviews' => $reviews,
            'name' => $name
        ]);
    }

    public function getTimeCategory($hour_from, $hour_to)
    {
        $time_category = [];
        $hour_from_24 = date('H:i', strtotime($hour_from));
        $hour_to_24 = date('H:i', strtotime($hour_to));

        if ($hour_from_24 < '12:00' && $hour_to_24 >= '06:00') {
            array_push($time_category, 'Pagi');
        }
        if ($hour_from_24 < '18:00' && $hour_to_24 >= '12:00') {
            array_push($time_category, 'Siang');
        }
        if ($hour_from_24 < '24:00' && $hour_to_24 >= '18:00') {
            array_push($time_category, 'Malam');
        }

        return $time_category;
    }

    public function myRestaurant()
    {
        $user_restaurant = auth()->user()->restaurant;
        $restaurant_id = $user_restaurant->pluck('id');
        $restaurants = Restaurant::whereIn('id', $restaurant_id)->get();
        return view('my-restaurant.index', compact('restaurants'));
    }

    public function myRestaurantCreate()
    {
        $restaurant_day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $restaurant_hour = [
            '01:00', '02:00', '03:00', '04:00', '05:00', '06:00',
            '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00',
            '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'
        ];
        return view('my-restaurant.create', compact('restaurant_day', 'restaurant_hour'));
    }

    public function myRestaurantStore(Request $request): RedirectResponse
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|min:3|max:255',
            'description' => 'required|max:255',
            'address' => 'required|max:255',
            'opening_day_from' => 'required',
            'opening_day_to' => 'required',
            'opening_hour_from' => 'required',
            'opening_hour_to' => 'required',
            'contact' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($validator->fails()) {
            toastr('Gagal menambahkan restoran. Perika kembali inputan anda', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->opening_day_from == "" || $request->opening_day_to == "") {
            return redirect()->back()->with('error', 'Opening day is required.')->withInput();
        }

        if ($request->opening_hour_from == "" || $request->opening_hour_to == "") {
            return redirect()->back()->with('error', 'Opening hour is required.')->withInput();
        }

        $request_data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $request_data['image'] = '/storage/' . $path;
        }

        $restaurant = Restaurant::create($request_data);

        RestaurantUser::create([
            'user_id' => auth()->user()->id,
            'restaurant_id' => $restaurant->id,
        ]);

        if ($restaurant) {
            toastr('Restaurant created successfully.', 'success');
            return redirect()->route('my-restaurant.index');
        } else {
            toastr('Restaurant created failed.', 'error');
            return back();
        }
    }

    public function myRestaurantShow(String $id)
    {
        $restaurant = Restaurant::find($id);

        return view('my-restaurant.detail', [
            'restaurant' => $restaurant
        ]);
    }

    public function myRestaurantEdit(string $id)
    {
        $restaurant = Restaurant::find($id);

        $restaurant_day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $restaurant_hour = [
            '01:00', '02:00', '03:00', '04:00', '05:00', '06:00',
            '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00',
            '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'
        ];
        return view('my-restaurant.edit', compact('restaurant', 'restaurant_day', 'restaurant_hour'));
    }

    public function myRestaurantUpdate(Request $request, string $id)
    {
        $restaurant = Restaurant::find($id);

        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'address' => 'required|max:255',
            'opening_day_from' => 'required',
            'opening_day_to' => 'required',
            'opening_hour_from' => 'required',
            'opening_hour_to' => 'required',
            'contact' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            toastr('Gagal menambahkan restoran. Perika kembali inputan anda', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->opening_day_from == "" || $request->opening_day_to == "") {
            return redirect()->back()->with('error', 'Opening day is required.')->withInput();
        }

        if ($request->opening_hour_from == "" || $request->opening_hour_to == "") {
            return redirect()->back()->with('error', 'Opening hour is required.')->withInput();
        }

        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->address = $request->address;
        $restaurant->opening_day_from = $request->opening_day_from;
        $restaurant->opening_day_to = $request->opening_day_to;
        $restaurant->opening_hour_from = $request->opening_hour_from;
        $restaurant->opening_hour_to = $request->opening_hour_to;
        $restaurant->contact = $request->contact;

        $request_data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $request_data['image'] = '/storage/' . $path;
            $restaurant->image = $request_data['image'];
        }

        $restaurant->save();

        if ($restaurant) {
            toastr()->success('Restaurant updated successfully.');
            return redirect()->route('my-restaurant.index');
        } else {
            toastr()->error('Restaurant updated failed.');
            return redirect()->back();
        }
    }

    public function myRestaurantDelete(string $id)
    {
        $restaurant = Restaurant::findOrfail($id);
        $restaurant->delete();

        if ($restaurant) {
            toastr()->success('Restaurant deleted successfully.');
            return redirect()->route('my-restaurant.index');
        } else {
            toastr()->error('Restaurant deleted failed.');
            return redirect()->back();
        }
    }
}
