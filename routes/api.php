<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\Main;
use App\Http\Controllers\Api\User\Category;
use App\Http\Controllers\Api\User\Products;
use App\Http\Controllers\Api\ConditionController;
use App\Http\Controllers\Front\Chat;
use App\Http\Controllers\Front\Notification;
use App\Http\Controllers\Front\AuctionController;
use App\Http\Controllers\Front\MakeOfferController;
use App\Http\Controllers\Api\User\WishlistController;
use App\Http\Controllers\Api\User\Profile;
use App\Http\Controllers\Api\User\Payment;
use App\Http\Controllers\Api\AdminController;

use App\Models\Product;

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

Route::get('/cron',function(){
    dd(uniqid());
    $products = Product::where('auction_price', '!=', null)
        ->where('status', '1')
        ->where('is_archived', false)
        ->where('is_sold', false)
        ->where('notify',0)
        ->where('ending_date','<=',date('Y-m-d'))
        ->where('ending_time','<',date('H:i:s'))
        ->first();
    dd($products->ending_time,date('H:i:s'));
});

Route::post('/signup', [Main::class,'signup']);
Route::post('/login-email', [Main::class,'login_with_email']);
Route::post('/login-phone', [Main::class,'login_with_username']);

Route::post('/forgot-password', [Main::class,'forgot_pass_p']);
Route::post('/forgot-password-phone', [Main::class,'forgot_pass_phone']);
Route::post('/verify-forgot-password-phone', [Main::class,'verify_forgot_pass_phone']);
Route::post('/otp-verify', [Main::class,'reset_code']);
Route::post('/new-password', [Main::class,'new_password']);
Route::post('/new-password-phone', [Main::class,'new_password_phone']);

Route::post('/featured-products', [Products::class,'featured_products']);
Route::post('/auction-products', [Products::class,'auction_products']);
Route::get('/get-banners',[AdminController::class,'get_banners'])->name('admin.get.banners');

// to delete account
Route::get('/account/deactivate/{id}',[Profile::class, 'deactivate'])->name('deactivate');

Route::post('/get-all-products', [Products::class,'all_products']);

Route::post('/twilio-status', [Main::class,'sms_check']);

Route::post('/twilio-status-check', [Main::class,'sms_check']);

Route::group(['middleware' => 'jwt.auth'], function () {

    //User Profile Routes
    Route::get('/me',[Profile::class, 'index'])->name('my_info');
    // Route::get('/account/deactivate',[Profile::class, 'deactivate'])->name('deactivate');
    Route::get('/user/info/{id}',[Profile::class, 'user_info'])->name('user_info');
    Route::get('/get/all/users',[Profile::class, 'get_all_users'])->name('get_all_users');
    Route::post('/update/user',[Profile::class, 'update_user'])->name('update_user');
    Route::post('/update/user/name',[Profile::class, 'update_user_name'])->name('update_user_name');
    Route::post('/update/email',[Profile::class, 'update_email'])->name('update_email');
    Route::post('/update/phone/number',[Profile::class, 'update_phone_number'])->name('update_phone_number');
    Route::post('/update/password',[Profile::class, 'update_password'])->name('update_password');
    Route::post('/update/location',[Profile::class, 'update_location'])->name('update_location');
    Route::post('/update/custom/link',[Profile::class, 'update_custom_link'])->name('update_custom_link');
    Route::post('/verify-email',[Profile::class, 'verify_email'])->name('verify_email');
    Route::post('/verify-email-otp',[Profile::class, 'verify_email_otp'])->name('verify_email_otp');
    Route::get('/get/all/users/reports',[Profile::class, 'get_all_users_reports'])->name('get_all_users_reports');

    // Listing Products Routes
 
    Route::post('/sub-categories', [Category::class,'sub_category']);
    Route::get('/category/show', [Category::class,'show']);
    Route::get('/sub-category/show/{id}', [Category::class,'show_sub_category']);
    Route::post('/category/{id}', [Category::class,'sub_category']);
    
    Route::get('/condition', [ConditionController::class,'index']);

    // Product upload steps
    Route::post('/add-product-first-step', [Products::class,'first_step']);
    Route::post('/add-product-second-step', [Products::class,'second_step']);
    Route::post('/add-product-third-step', [Products::class,'third_step']);
    Route::post('/add-product-last-step', [Products::class,'last_step']);
    Route::post('/edit-product-first-step', [Products::class,'edit_product_first_step']);
    Route::post('/edit-product-second-step', [Products::class,'second_step']);
    Route::post('/edit-product-third-step', [Products::class,'third_step']);
    Route::post('/edit-product-last-step', [Products::class,'last_step']);
    Route::post('/product-reschedule-auction', [Products::class,'reschedule_auction']);
    Route::post('/upload-image', [Products::class,'upload_image']);
    Route::post('/replace-image', [Products::class,'replace_images']);
    Route::post('/delete-image', [Products::class,'delete_photo']);
    Route::post('/get-products', [Products::class,'get_products']);
    Route::post('/update-product-status', [Products::class,'update_product_status']);
    Route::post('/delete-product', [Products::class,'delete_product']);
    
    Route::get('/get-location', [Products::class,'get_location']);
    Route::post('/product-detail', [Products::class,'product_detail']);

    // Chatting Routes
    Route::middleware(['blockeduser'])->group(function () {
        Route::post('send_msg', [Chat::class, 'send_msg'])->name('send_msg');
    });
    Route::post('/get/conversation_id', [Chat::class, 'get_conversation_id'])->name('get_conversation_id');
    Route::get('/get/user/all/chats/{id}', [Chat::class, 'get_all_chats_of_user'])->name('get_all_chats_of_user');
    Route::get('/get/conversation/{conversation_id}', [Chat::class, 'get_conversation'])->name('get_conversation');
    Route::get('/mark/conversation/read/{conversation_id}', [Chat::class, 'mark_conversation_as_read'])->name('mark_conversation_as_read');
    Route::get('/delete/message/{message_id}', [Chat::class, 'delete_message'])->name('delete_message');
    Route::get('/delete/conversation/{conversation_id}', [Chat::class, 'delete_conversation'])->name('delete_conversation');
    Route::post('/delete/product/conversation', [Chat::class, 'delete_product_conversation'])->name('delete_product_conversation');
    Route::post('/delete/product/all/conversation', [Chat::class, 'delete_product_all_conversation'])->name('delete_product_all_conversation');
    Route::get('/search/conversation/message', [Chat::class, 'search_conversation_msg'])->name('search_conversation_msg');

    //Notification Routes
    Route::post('/create/notification',[Notification::class, 'create'])->name('create_notification');
    Route::get('/get/user/all/notifications/{id}',[Notification::class, 'get_user_all_notifications'])->name('get_user_all_notifications');
    Route::get('/get/user/unread/notifications/{id}',[Notification::class, 'get_user_unread_notifications'])->name('get_user_unread_notifications');
    Route::get('/get/user/read/notifications/{id}',[Notification::class, 'get_user_read_notifications'])->name('get_user_read_notifications');
    Route::get('/change/notification/status/{id}', [Notification::class, 'change_notification_status'])->name('change_notification_status');
    Route::get('/delete/single/notification/{id}', [Notification::class, 'delete_single_notification'])->name('delete_single_notification');
    Route::post('/delete/notifications', [Notification::class, 'delete_notifications'])->name('delete_notifications');
    Route::get('/unread/notifications', [Notification::class, 'get_unread_notifications'])->name('get_notifications');

    // Wishlist Routes
    Route::post('/wishlist-products', [WishlistController::class,'index']);
    Route::post('/add-wishlist-products', [WishlistController::class,'store']);
    Route::post('/remove-wishlist-products', [WishlistController::class,'destroy']);

    // Auction Routes
    Route::post('/place-bid', [AuctionController::class,'place_bid']);
    Route::post('/get-placed-bids', [AuctionController::class,'get_placed_bids']);
    Route::post('/placed-bids', [AuctionController::class,'get_all_placed_bid']);
    Route::post('/get-bid', [AuctionController::class,'get_bid']);
    Route::post('/get-highest-bid', [AuctionController::class,'get_highest_bid']);

    // Make Offer Routes
    Route::post('/make-offer', [MakeOfferController::class,'make_offer']);
    Route::post('/get-user-offers', [MakeOfferController::class,'get_user_offers']);
    Route::post('/get-offer', [MakeOfferController::class,'get_offer']);
    Route::post('/accept-offer', [MakeOfferController::class,'accept_offer']);
    Route::post('/reject-offer', [MakeOfferController::class,'reject_offer']);

    //Add Review to Product Routes
    Route::post('/product-review',[Products::class,'product_review']);
    Route::post('/user-review',[Profile::class,'user_review']);

    //Payment API
    Route::post('/sell-faster', [Payment::class,'sell_faster'])->name('sell_faster');
    Route::post('/charge', [Payment::class,'charge'])->name('charge');
    Route::post('/google-pay', [Payment::class,'google_pay'])->name('google_pay');
    Route::get('/get/user/all/transactions/{id}', [Payment::class,'get_user_all_trans'])->name('get_user_all_trans');
    Route::get('/get/user/all/cards/{id}', [Payment::class,'get_user_all_cards'])->name('get_user_all_cards');
    Route::get('/delete/user/card/{id}', [Payment::class,'del_user_card'])->name('del_user_card');
    Route::get('/get/all/transactions', [Payment::class,'get_all_trans'])->name('get_all_trans');
    Route::get('/get/transaction/{id}', [Payment::class,'get_trans'])->name('get_trans');


    Route::get('/mark-product-sold/{id}',[Products::class,'mark_product_sold']);
    Route::get('/mark-product-archive/{id}',[Products::class,'mark_product_archive']);
    Route::get('/mark-product-unarchive/{id}',[Products::class,'mark_product_unarchive']);
    Route::get('/selling-screen',[Profile::class,'selling_screen']);
    Route::post('/increase-product-view',[Products::class,'increase_product_view']);

    Route::post('/report-a-user',[Profile::class,'report_user']);
    Route::get('/list-report-a-user',[Profile::class,'list_reported_user']);
    Route::get('/list-report-user/{id}',[Profile::class,'list_one_reported_user']);

    Route::post('/block-a-user',[Profile::class,'block_user']);
    Route::post('/unblock-a-user',[Profile::class,'unblock_user']);
    Route::get('/list-block-a-user',[Profile::class,'list_blocked_user']);
    
    Route::get('/get-payment-status',[Profile::class,'list_blocked_user']);
    Route::get('/list-block-a-user',[Profile::class,'list_blocked_user']);

    Route::post('/who-bought',[Profile::class,'who_bought']);
    
    // new one
    Route::get('/get-seller-type', [Profile::class, 'get_seller_type']);

    Route::post('/device-token-update', [Main::class,'device_token_update']);

    Route::post('/verify-phone', [Main::class,'verify_phone']);
    Route::post('/verify-phone-code', [Main::class,'verify_code_phone']);


    Route::middleware('cors')->group(function () {
        Route::get('/users', [AdminController::class,'get_users'])->name('get_users');
        Route::get('/users/delete', [AdminController::class,'delete_users'])->name('delete_users');
        Route::get('/users/search', [AdminController::class,'get_users_search'])->name('get_users_search');
        Route::get('/today-registration', [AdminController::class,'today_registration'])->name('today_registration');
        Route::get('/verified-users', [AdminController::class,'verified_users'])->name('verified_users');
        Route::get('/ads-verification', [AdminController::class,'ads_verification'])->name('ads_verification');
        Route::get('/ads', [AdminController::class,'get_ads'])->name('get_ads');
        Route::get('/ads-search', [AdminController::class,'get_ads_search'])->name('get_ads_search');
        Route::get('/reports', [AdminController::class,'get_reports'])->name('get_reports');
        Route::post('/add-product-report', [AdminController::class,'add_product_report'])->name('add_product_report');
        Route::post('/delete-product-report', [AdminController::class,'delete_product_report'])->name('delete_product_report');
        Route::post('/change-product-report-status', [AdminController::class,'change_product_report_status'])->name('change_product_report_status');
        Route::post('search-product-report', [AdminController::class,'search_product_report'])->name('search_product_report');
        Route::get('/latest-messages', [AdminController::class,'latest_messages'])->name('latest_messages');

        Route::post('/add/team/member',[AdminController::class,'add_member'])->name('admin.add.member');
        Route::get('/get/team/member',[AdminController::class,'get_all_members'])->name('admin.get.member');
        Route::post('/get-users-daterange',[AdminController::class,'get_users_daterange'])->name('admin.get.users.daterange');
        Route::get('/get-boosting-products',[AdminController::class,'get_boosting_products'])->name('admin.get_boosting_products');
        Route::get('/get-configs',[AdminController::class,'get_configs'])->name('admin.get.configs');
        Route::post('/update-config',[AdminController::class,'update_configs'])->name('admin.update.configs');

        Route::get('/delete-banners',[AdminController::class,'delete_banners'])->name('admin.delete.banners');
        Route::post('/add-banner',[AdminController::class,'add_banner'])->name('admin.add.banner');
        Route::post('/update-banner',[AdminController::class,'update_banner'])->name('admin.update.banner');
    });
});

Route::get('/payment-status',[Profile::class,'payment_status']);
Route::get('/payment-fee',[Profile::class,'payment_fee']);

// Admin Apis
Route::post('/admin/upload/settings',[UserA::class,'upload_setting']);
Route::post('/admin/add-category',[CategoryA::class, 'add_category']);
Route::post('/admin/update-category',[CategoryA::class, 'edit_category']);
Route::post('/admin/update-user-data',[UserA::class, 'update_user']);
Route::post('/admin/update-product',[ProductA::class, 'update_product']);

//BILAL:PUBLIC ROUTES
   Route::post('/categories', [Category::class,'index']);