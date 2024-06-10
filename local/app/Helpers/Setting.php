<?php

namespace App\Helpers;

use App\Setting as Sett;

class Setting
{
    static function get($name)
    {
        $setting = Sett::where('name', $name)->first();
        if ($setting) {
            if ($setting->type == 'string' || $setting == 'radio') {
                if ($setting->value != NULL) {
                    return $setting->value;
                } else {
                    return false;
                }
            } elseif ($setting->type == 'file') {
                $imageUrl = "";
                if ( ! is_null($setting->value))
                {
                    $imagePath = public_path() . "/images/" . $setting->value;
                    if (file_exists($imagePath)) $imageUrl = asset("images/" . $setting->value);
                }
                return $imageUrl;
            } else {
                if ($setting->text != NULL) {
                    return $setting->text;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}