<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\Main;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\User\Category;
use App\Http\Controllers\Api\User\Products;
use App\Http\Controllers\Front\Chat;
use App\Http\Controllers\Front\Notification;
use App\Http\Controllers\Front\AuctionController;
use App\Http\Controllers\Front\MakeOfferController;
use App\Http\Controllers\Api\User\WishlistController;
use App\Http\Controllers\Api\User\Profile;
use App\Http\Controllers\Api\User\Payment;

use App\Http\Controllers\Api\Admin\CategoryA;
use App\Http\Controllers\Api\Admin\UserA;
use App\Http\Controllers\Api\Admin\ProductA;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/signup', [Main::class,'signup']);
Route::post('/login-email', [Main::class,'login_with_email']);
Route::post('/login-phone', [Main::class,'login_with_username']);

Route::post('/forgot-password', [Main::class,'forgot_pass_p']);
Route::post('/otp-verify', [Main::class,'reset_code']);
Route::post('/new-password', [Main::class,'new_password']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::middleware('cors')->group(function () {
        Route::get('/users', [AdminController::class,'get_users'])->name('get_users');
        Route::get('/users/delete', [AdminController::class,'delete_users'])->name('delete_users');
        Route::get('/users/search', [AdminController::class,'get_users_search'])->name('get_users_search');
        Route::get('/today-registration', [AdminController::class,'today_registration'])->name('today_registration');
        Route::get('/verified-users', [AdminController::class,'verified_users'])->name('verified_users');
        Route::get('/ads-verification', [AdminController::class,'ads_verification'])->name('ads_verification');
        Route::get('/ads', [AdminController::class,'get_ads'])->name('get_ads');
        Route::get('/reports', [AdminController::class,'get_reports'])->name('get_reports');
        Route::get('/latest-messages', [AdminController::class,'latest_messages'])->name('latest_messages');
    });
});