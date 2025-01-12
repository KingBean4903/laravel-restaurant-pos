<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Category extends Model
{
    //

    use HasUlids;

    protected $fillable = [
        'title',
        'description'
    ];
}
