<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Stevebauman\Location\Facades\Location;
use App\Models\Categories;
use Illuminate\Http\Request;
class LocationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(Request $request): void
    {
        View::composer('layouts.front.navbar', function ($view) use ($request) {
            $ip = $request->ip(); 
            if ($position = Location::get($ip)) {
                $country = $position->cityName;
            } else {
                $country = 'Dubai';
            }
            $cats = Categories::where('status', 1)->orderBy('id', 'desc')->limit(7)->get();
            $view->with(['location' => $country, 'categories' => $cats]);
        });

        View::composer('layouts.front.modals', function ($view) {
            $cats = Categories::where('status',1)->orderBy('id','desc')->get();
            $view->with('categories', $cats);
        });

    }
}
