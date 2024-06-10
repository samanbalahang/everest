<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['image', 'active'];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/sliders/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/sliders/" . $this->image);
        }

        return $imageUrl;
    }
}
