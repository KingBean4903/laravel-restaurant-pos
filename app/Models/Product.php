<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Product extends Model
{
    //
    use HasUlids;

    protected $fillable = [
        'title',
        'uom',
        'department',
        'category',
        'is_menu',
        'opening_stock',
        'price',
    ];
}
