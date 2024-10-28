<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Home;
use App\Http\Controllers\Front\Shop;
use App\Http\Controllers\Front\Chat;

use App\Http\Controllers\User\Profile;

use App\Http\Controllers\Auth\Main;
use App\Http\Controllers\Auth\Social;

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
// Auth pages
Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Session::forget('key');
    Session::flush();
    Cache::flush();

    die('Cleared');
});

Route::group(['middleware' => 'guest'], function () {

Route::get('forgot-password', [Main::class,'forgot_pass'])->name('forgot_pass');
Route::post('forgot-password-post', [Main::class,'forgot_pass_p'])->name('forgot_pass_p');

Route::get('/new-password', [Main::class, 'new_password_view']);
Route::post('/new_password', [Main::class, 'new_password']);

Route::get('/reset-code', [Main::class, 'reset_code_view']);
Route::post('/reset_code', [Main::class, 'reset_code']);



Route::post('/post/login', [Main::class,'login_p'])->name('login.post');
Route::post('/post/login-username', [Main::class,'login_p_username'])->name('login_username.post');
   Route::post('/post/signup', [Main::class,'signup_p'])->name('signup.post');
});

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [Main::class, 'signOut'])->name('logout');
    });

// Front pages
Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/shop-auction', [Shop::class, 'auction_shop'])->name('auction_shop');
Route::get('/shop-fixed', [Shop::class, 'fixed_shop'])->name('fixed_shop');

Route::get('/details-auction', [Shop::class, 'auction_details'])->name('auction_details');
Route::get('/details-fixed', [Shop::class, 'fixed_details'])->name('fixed_details');
Route::group(['middleware' => 'auth'], function () {
Route::get('/profile', [Profile::class, 'index'])->name('profile.home');
});