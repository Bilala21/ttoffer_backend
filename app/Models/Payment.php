<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'customer_id',
        'transaction_id',
        'last_four',
        'token',
        'amount',
        'currency',
        'description',
        'receipt_url',
        'status',
        'brand',
    ];
}
