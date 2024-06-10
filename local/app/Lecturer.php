<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Lecturer extends Model
{
    protected $fillable = [
        'name', 'image', 'year', 'status', 'views'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/lecturers/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/lecturers/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/lecturers/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/lecturers/" . $this->image);
                $thumb->resize(100,125);
                $thumbPath = "/storage/images/lecturers/thumbs/$this->image";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/lecturers/thumbs/" . $this->image);
        }
        return $imageUrl;
    }
}
