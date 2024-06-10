<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class StudentW extends Model
{
    protected $fillable = [
        'name', 'image', 'year', 'courses', 'headline', 'company', 'views'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/students/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/students/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/students/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/students/" . $this->image);
                $thumb->resize(100,100);
                $thumbPath = "/storage/images/students/thumbs/$this->image";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/students/thumbs/" . $this->image);
        }
        return $imageUrl;
    }
}
