<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\AfterRegister;

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
        //$user = User::firstOrCreate(['email' => $data['email']], $data); // firstOrCreate -> apabila email sudah ada maka tidak buat baru

        // ketika login atau register dicheck dulu
        $user = User::whereEmail($data['email'])->first(); // first() = dicek ada datanaya atau tidak

        // kalau tidak ada maka dianggap register
        if(!$user) {
            $user = User::create($data);
            Mail::to($user->email)->send(new AfterRegister($user));
        }
        Auth::login($user, true); // membuat user menjadi true

        return redirect(route('welcome'));
    }
}
