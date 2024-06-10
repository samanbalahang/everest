<?php

namespace App\Helpers;

use App\Number as Num;

class Number
{
    static function get($name)
    {
        $num = Num::where('name', $name)->first();
        if ($num) {
            return $num->number;
        } else {
            return false;
        }
    }
}