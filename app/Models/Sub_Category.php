<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    use HasFactory;
    protected $table = 'sub_category';
    protected $fillable = [
        'category_id',
        'name',
    ];
}
