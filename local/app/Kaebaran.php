<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kaebaran extends Model
{
    protected $fillable = [
        'karbar_name',
        'karbar_lname',
        'karbar_phone',
        'karbar_role',
        'password',
        'active',
    ];
    protected $table = 'kaebaran';
}