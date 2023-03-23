<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccumulatorParam extends Model
{
    protected $fillable = [
        'type',
        'min',
        'max',
    ];
}
