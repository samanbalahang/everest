<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'course', 'date_day', 'date_month', 'date_year', 'video', 'views'
    ];

    public function getVideoUrlAttribute()
    {
        $videoUrl = "";

        if ( ! is_null($this->video))
        {
            $imagePath = public_path() . "/storage/videos/" . $this->video;
            if (file_exists($imagePath)) $videoUrl = asset("storage/videos/" . $this->video);
        }

        return $videoUrl;
    }
}
