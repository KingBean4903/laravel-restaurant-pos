<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Department extends Model
{
    //
    use HasUlids;

    protected $fillable = [
        'title',
        'description'
    ];
}
