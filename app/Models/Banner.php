<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'img',
        'html',
        'status',
        'page_name',
        'sequence',
        'start_datetime',
        'end_datetime',
    ];
}
