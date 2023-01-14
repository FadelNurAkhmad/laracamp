<?php

use App\Http\Controllers\User\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () { // nama untuk di url
    return view('welcome'); // kembali ke veiw -> welcome.blade.php
})->name('welcome'); // name untuk route di blade href={{route('welcome')}}


// socialite routes
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
// nama 'auth/google/callback' harus sama di env google redirect



// middleware, halaman harus login, kalau belum login tidak bisa masuk kehalaman tertentu
Route::middleware(['auth'])->group(function (){
    // CheckoutController::class, 'success' -> menuju ke CheckoutController.php di function success
    Route::get('checkout/success}', [CheckoutController::class, 'success'])->name('checkout.success');
    // checkout/{camp:slug}, diambil dari tabel db camp->slug, kalau tidak pakai slug maka nampilkan 'id'
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');

    // user dashboard
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard/checkout/invoice/{checkout}', [CheckoutController::class, 'invoice'])->name('user.checkout.invoice');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
