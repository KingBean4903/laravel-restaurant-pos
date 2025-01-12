<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Customer extends Model
{
    //
    use HasUlids;

    protected $fillable = [
        'names',
        'phone'
    ];
}
