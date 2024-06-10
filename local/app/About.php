<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'image'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/abouts/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/abouts/" . $this->image);
        }

        return $imageUrl;
    }
}
