<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'state_id',
        'city_id',
        'area'
    ];
    protected $table = 'area';
}