<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class OrderItem extends Model
{
    //
    use HasUlids;

    protected $fillable = [ 
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'total',
    ];
}
