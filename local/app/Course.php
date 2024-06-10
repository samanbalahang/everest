<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Course extends Model
{
    protected $fillable = [
        'title', 'slug', 'desc', 'lessons', 'works', 'requires', 'department_id', 'image', 'title_en', 'company', 'views'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/courses/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/courses/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/courses/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/courses/" . $this->image);
                $thumb->resize(160,160);
                $thumbPath = "/storage/images/courses/thumbs/$this->image";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/courses/thumbs/" . $this->image);
        }
        return $imageUrl;
    }
}
