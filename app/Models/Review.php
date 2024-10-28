<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'to_user',
        'from_user',
        'product_id',
        'comments',
        'rating',
        'deleted_at'
    ];
    
    public function fromUesr(){
        return $this->hasOne(User::class, 'id', 'from_user');
    }
    
    public function ToUesr(){
        return $this->hasOne(User::class, 'id', 'to_user');
    }
    
    public function Product(){
        return $this->hasOne(Product::class, 'id', 'product_id')->select(
            'id',
            'user_id',
            'title',
            'slug',
            'description'
        );
    }
}
