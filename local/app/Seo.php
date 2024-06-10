<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'name', 'label', 'description', 'keywords', 'image'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/seo/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/seo/" . $this->image);
        }

        return $imageUrl;
    }
}
