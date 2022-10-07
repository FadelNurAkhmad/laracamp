<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { // nama di tag url
    return view('welcome');
})->name('welcome');

Route::get('login', function () {
    return view('login'); // kembali ke 'login.blade.php'
})->name('login'); // name buat 'route' di blade

Route::get('checkout', function () {
    return view('checkout'); // kembali ke 'checkout.blade.php'
})->name('checkout'); // name buat 'route' di blade

Route::get('success-checkout', function () {
    return view('success_checkout'); // kembali ke 'success_checkout.blade.php'
})->name('success-checkout'); // name buat 'route' di blade

Route::get('dashboard', function () {
    return view('dashboard'); // kembali ke 'dashboard.blade.php'
})->name('dashboard'); // name buat 'route' di blade
