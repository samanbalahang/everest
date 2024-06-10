<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Signal extends Model
{
    protected $fillable = [
        'karbar_id',
        'user_signal_id',
        'course_id',
        'request',
    ];
    protected $table = 'signals';
}