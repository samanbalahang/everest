<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class OldCourse extends Model
{
    protected $fillable = [
        'title', 'students', 'start_day', 'start_month', 'start_year', 'department_id',
        'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10'
    ];

    public function getImage1UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image1))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image1;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image1);
        }

        return $imageUrl;
    }

    public function getImage2UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image2))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image2;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image2);
        }

        return $imageUrl;
    }

    public function getImage3UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image3))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image3;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image3);
        }

        return $imageUrl;
    }

    public function getImage4UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image4))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image4;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image4);
        }

        return $imageUrl;
    }

    public function getImage5UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image5))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image5;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image5);
        }

        return $imageUrl;
    }

    public function getImage6UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image6))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image6;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image6);
        }

        return $imageUrl;
    }

    public function getImage7UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image7))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image7;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image7);
        }

        return $imageUrl;
    }

    public function getImage8UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image8))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image8;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image8);
        }

        return $imageUrl;
    }

    public function getImage9UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image9))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image9;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image9);
        }

        return $imageUrl;
    }

    public function getImage10UrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image10))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/" . $this->image10;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/" . $this->image10);
        }

        return $imageUrl;
    }

    public function getThumb1UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image1))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image1;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image1);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image1";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image1);
        }
        return $imageUrl;
    }

    public function getThumb2UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image2))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image2;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image2);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image2";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image2);
        }
        return $imageUrl;
    }

    public function getThumb3UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image3))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image3;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image3);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image3";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image3);
        }
        return $imageUrl;
    }

    public function getThumb4UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image4))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image4;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image4);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image4";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image4);
        }
        return $imageUrl;
    }

    public function getThumb5UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image5))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image5;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image5);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image5";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image5);
        }
        return $imageUrl;
    }

    public function getThumb6UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image6))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image6;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image6);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image6";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image6);
        }
        return $imageUrl;
    }

    public function getThumb7UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image7))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image7;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image7);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image7";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image7);
        }
        return $imageUrl;
    }

    public function getThumb8UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image8))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image8;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image8);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image8";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image8);
        }
        return $imageUrl;
    }

    public function getThumb9UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image9))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image9;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image9);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image9";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image9);
        }
        return $imageUrl;
    }

    public function getThumb10UrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image10))
        {
            $imagePath = public_path() . "/storage/images/oldcourses/thumbs/" . $this->image10;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/oldcourses/" . $this->image10);
                $thumb->resize(75,50);
                $thumbPath = "/storage/images/oldcourses/thumbs/$this->image10";
                $thumb->save(public_path($thumbPath), 30);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/oldcourses/thumbs/" . $this->image10);
        }
        return $imageUrl;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
