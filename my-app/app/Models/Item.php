<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use Softdeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available',
    ];
}
