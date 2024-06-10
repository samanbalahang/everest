<?php

namespace App\Helpers;

use App\Banner as Text;

class Banner
{
    static function get($slug)
    {
        $banner = Text::where('slug', $slug)->first();
        if ($banner) {
            if ($banner->active == 1 && $banner->desc) {
                return $banner->desc;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}