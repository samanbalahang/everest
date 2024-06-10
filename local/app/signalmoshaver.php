<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class signalmoshaver extends Model
{

    protected $fillable = [
        'karbar_id',
        'signal_id',
        'user_signal_id',
        'maharat',
        'naiz',
        'hadaf',
        'vazeiat',
        'tozih',
    ];
    protected $table = 'signalmoshaver';


}