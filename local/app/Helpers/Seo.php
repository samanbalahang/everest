<?php

namespace App\Helpers;

use App\Seo as Val;

class Seo
{
    static function desc($name)
    {
        $seo = Val::where('name', $name)->first();
        $def = Val::where('name', 'default')->first();
        if ($seo) {
            if ($seo->description) {
                return $seo->description;
            } else {
                return $def->description;
            }
        } elseif ($def) {
            return $def->description;
        } else {
            return false;
        }
    }

    static function key($name)
    {
        $seo = Val::where('name', $name)->first();
        $def = Val::where('name', 'default')->first();
        if ($seo) {
            if ($seo->keywords) {
                return $seo->keywords;
            } else {
                return $def->keywords;
            }
        } elseif ($def) {
            return $def->keywords;
        } else {
            return false;
        }
    }

    static function image($name)
    {
        $seo = Val::where('name', $name)->first();
        $def = Val::where('name', 'default')->first();
        if ($seo) {
            if ($seo->image) {
                return $seo->image_url;
            } else {
                return $def->image_url;
            }
        } elseif ($def) {
            return $def->image_url;
        } else {
            return false;
        }
    }
}