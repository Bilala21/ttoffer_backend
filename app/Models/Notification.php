<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'from_user_id',
        'buyer_id',
        'seller_id',
        'text',
        'type',
        'type_id',
        'product_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
    
    public function ToUser(){
        return $this->belongsTo(User::class);
    }
    
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
