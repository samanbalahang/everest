<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class News extends Model
{
    protected $fillable = [
        'title', 'desc', 'content', 'image', 'views'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/news/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/news/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/news/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/news/" . $this->image);
                $thumb->resize(164,130);
                $thumbPath = "/storage/images/news/thumbs/$this->image";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/news/thumbs/" . $this->image);
        }
        return $imageUrl;
    }
}
