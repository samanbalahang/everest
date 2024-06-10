<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class UserSignal extends Model
{

    protected $fillable = [
        "karbar_id",
        'fname',
        'lname',
        'mobile',
        'mellicode',
        'tozihat',
        'birthDay',
        'Age',
        'gender',
        'field',
        'fieldLevel',
        'state',
        'city',
        'area',
        'method_id',
        'lead',
        'course_id',
        'request',
    ];
    protected $table = 'usersignal';


}