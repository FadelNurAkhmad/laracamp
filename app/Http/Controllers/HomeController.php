<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth; // ambil data2 dari login

class HomeController extends Controller
{
    public function dashboard()
    {
        // $checkouts = Checkout::with('Camp')->whereUserId(Auth::id())->get();
        $checkouts = Checkout::with('Camp')->where('user_id', Auth::id())->get();
        // return $checkouts; untuk testing json

        return view('user.dashboard',[ // menuju folder views->user->dashboard.blade.php
            'checkouts' => $checkouts
        ]); 
    }
}
