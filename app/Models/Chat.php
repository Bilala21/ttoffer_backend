<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'file',
        'file_name',
        'file_type',
        'status',
        'conversation_id',
        'buyer_id',
        'seller_id',
        'offer_id',
        'product_id',
        'created_at',
        'updated_at',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function offer(){
        return $this->belongsTo(MakeOffer::class);
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id');
    }

    public function seller(){
        return $this->belongsTo(User::class,'seller_id');
    }
    
    public function ImagePath(){
        return $this->hasOne(Photo::class, 'product_id', 'product_id');
    }
}
