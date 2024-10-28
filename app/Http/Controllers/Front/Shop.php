<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Shop extends Controller
{
    public function auction_shop(){
        return view('front.shop.auction');
    }
    public function fixed_shop(){
        return view('front.shop.fixed');
    }
    public function auction_details(){
        return view('front.shop.aution_details');
    }
    public function fixed_details(){
        return view('front.shop.fixed_details');
    }
}
