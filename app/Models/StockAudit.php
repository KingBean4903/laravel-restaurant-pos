<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class StockAudit extends Model
{
    //

    use HasUlids;

    protected $fillable = [
        'user',
        'spoilage',
        'physical_qtty',
        'product_id',
        'user',
        'location'
    ];
}
