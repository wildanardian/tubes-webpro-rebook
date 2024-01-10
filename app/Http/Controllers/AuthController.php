<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect('/');
        }else {
            return view('login');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        
        return redirect('/login');
    }

    public function register()
    {
        if(Auth::check()) {
            return redirect('/');
        }else {
            return view('login');
        }
    }

    public function authRegister(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $title = 'Profile';
        return view('profile', compact('user', 'title'));
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Please check your input again!', 'Error');
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::where('id', auth()->user()->id)->first();
        $user->username = $request->username;
        $user->email = $request->email;

        if($request->full_name) {
            $user->full_name = $request->full_name;
        }else {
            $user->full_name = '';
        }

        if($request->phone_number) {
            $user->phone_number = $request->phone_number;
        }else {
            $user->phone_number = '';
        }

        if($request->address) {
            $user->address = $request->address;
        }else {
            $user->address = '';
        }

        $request_data = $request->all();
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $request_data['image'] = '/storage/' . $path;
            $user->image = $request_data['image'];
        }

        if ($user->save()) {
            toastr()->success('Profile updated!', 'Success');
            return redirect()->route('profile');
        } else {
            toastr()->error('Profile update failed!', 'Error');
            return redirect()->back();
        }
    }
}
