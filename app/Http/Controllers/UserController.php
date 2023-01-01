<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.user.login'); // folder auth->user->login
    }

    public function google()
    {
        return Socialite::driver('google')->redirect(); // doc sicialite
    }

    public function handleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user(); // mengetahui data email yg dipakai

        // pasring data callback, untuk sign
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        //Integrasi ke database
        $user = User::firstOrCreate(['email' => $data['email']], $data); // firstOrCreate -> apabila email sudah ada maka tidak buat baru
        Auth::login($user, true); // membuat user menjadi true

        return redirect(route('welcome'));
    }
}
