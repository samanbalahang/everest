<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Download extends Model
{
    protected $fillable = [
        'title', 'image', 'desc', 'content', 'download_cat_id', 'file', 'downloads'
    ];

    public function downloadCat()
    {
        return $this->belongsTo(DownloadCat::class);
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/downloads/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/downloads/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/downloads/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/downloads/" . $this->image);
                $thumb->resize(460, null, function ($constraint) {
                    $constraint->aspectRatio();
                });;
                $thumbPath = "/storage/images/downloads/thumbs/$this->image";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/downloads/thumbs/" . $this->image);
        }
        return $imageUrl;
    }

    public function getFileUrlAttribute($value)
    {
        $fileUrl = "";

        if ( ! is_null($this->file))
        {
            $filePath = public_path() . "/storage/files/downloads/" . $this->file;
            if (file_exists($filePath)) $fileUrl = asset("storage/files/downloads/" . $this->file);
        }

        return $fileUrl;
    }
}
