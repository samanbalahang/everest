<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneCalls extends Model
{
    protected $fillable = [
        'karbar_id',
        'user_signal_id',
        'signals_id',
        'time',
        'tozihat',
    ];
    protected $table = 'phonecalls';
}
