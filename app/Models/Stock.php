<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Stock extends Model
{
    //
    use HasUlids;

    protected $fillable = [
        'location',
        'status',
        'product_id',
        'in_stock',
        'reason',
    ];
}
