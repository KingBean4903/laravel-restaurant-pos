<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class StockTrxn extends Model
{
    //
    use HasUlids;

    protected $fillable = [
        'qtty',
        'stock_before',
        'stock_after',
        'reason',
        'user',
        'trxn_type',
        'product_id',
        'ref_code',
        'location_from',
        'location_to'
    ];
}
