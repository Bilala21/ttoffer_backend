<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'deleted_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function Product(){
        return $this->belongsTo(Product::class)->select(
            'id',
            'user_id',
            'title',
            'slug',
            'description'
        );
    }
}
