<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Department extends Model
{
    protected $fillable = [
        'title', 'slug', 'image'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/departments/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/departments/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/departments/thumbs/" . $this->image;
            // if (! file_exists($imagePath)) {
            //     $thumb = Image::make(public_path() . "/storage/images/departments/" . $this->image);
            //     $thumb->resize(223,175);
            //     $thumbPath = "/storage/images/departments/thumbs/$this->image";
            //     $thumb->save(public_path($thumbPath), 50);
            // }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/departments/thumbs/" . $this->image);
        }
        return $imageUrl;
    }

    public function oldcourses()
    {
        return $this->hasMany(OldCourse::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
