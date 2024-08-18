<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class NobatMoshavereh extends Model
{

    protected $fillable = [
        'class',
        'year',
        'month',
        'day',
        'hour',
        'usersignal_id',
    ];
    protected $table = 'nobatmoshavereh';


}