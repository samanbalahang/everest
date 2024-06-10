<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'active', 'content'
    ];
    
    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/pages/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/pages/" . $this->image);
        }

        return $imageUrl;
    }
}
