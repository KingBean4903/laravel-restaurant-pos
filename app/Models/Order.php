<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Order extends Model
{
    //
    use HasUlids;
    
    protected $fillable = [
        'customer_id',
        'total',
        'cashier',
        'status',
        'dine',
        'payment',
    ];
}
