<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doreha extends Model
{
    protected $fillable = [
        'title',
        'active',
    ];
    protected $table = 'doreha';
}