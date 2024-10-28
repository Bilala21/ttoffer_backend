<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'product';
    
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'category_id',
        'sub_category_id',
        'condition',
        'make_and_model',
        'mileage',
        'color',
        'fix_price',
        'firm_on_price',
        'auction_price',
        'final_price',
        'notify',
        'starting_date',
        'starting_time',
        'ending_date',
        'ending_time',
        'sell_to_us',
        'location',
        'status',
        'is_urgent',
        'total_review',
        'review_percentage',
        'is_archived',
        'is_sold',
        'sold_to_user_id',
        'brand',
        'model',
        'edition',
        'authenticity',
        'views_count',
        'attributes',
        'booster_start_datetime',
        'booster_end_datetime',
        'deleted_at'
    ];
    
    // Append custom attributes to the model
    protected $appends = [
        'ProductType',
        'IsProductExpired'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Categories::class);
    }

    public function sub_category(){
        return $this->belongsTo(Sub_Category::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class);
    }
    
    public function ImagePath(){
        return $this->hasOne(Photo::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function video(){
        return $this->hasMany(Video::class);
    }

    public function auction(){
        return $this->hasMany(Auction::class);
    }

    public function offer(){
        return $this->hasMany(MakeOffer::class);
    }
    
    public function getProductTypeAttribute() {
        // $att = $this->attributes[0];

        // if (Str::lower($request->type) == 'featured') {
        //             $query->where('fix_price', '!=', null);
        //         } elseif (Str::lower($request->type) == 'auction') {
        //             $query->where('auction_price', '!=', null);
        return ($this->fix_price != null || $this->Price != null) ? "featured" : (($this->auction_price != null) ? "auction" : "other");
    }
    
    public function getIsProductExpiredAttribute()
    {
        // Check if ending_date and ending_time are set
        if ($this->ending_date && $this->ending_time) {
            // Combine ending_date and ending_time
            // $endingDateTime = Carbon::createFromFormat('Y-m-d H:i', $this->ending_date . ' ' . $this->ending_time, 'UTC');
            
            // // Convert current date and time to UTC for comparison
            // $currentDateTime = Carbon::now('UTC');

            // // Check if the current date and time is past the ending date and time
            // return $endingDateTime <= $currentDateTime;
            
            
            // Extract both date and time parts
            $dateString = $this->ending_date;  // ISO 8601 part
            $timeString = $this->ending_time;  // Extra time part
            // Parse the date (ISO 8601)
            $date = Carbon::parse($this->ending_date);
        
            // Modify the time part if necessary
            $date->setTimeFromTimeString($this->ending_time);  // Set the additional time
            
            // Get the current date/time
            $now = Carbon::now();
            
            // Compare dates
            return $date->isPast();
        }

        // If ending_date or ending_time are not set, assume not expired
        return false;
    }
}
