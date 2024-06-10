<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Article extends Model
{
    protected $fillable = [
        'title', 'content', 'desc', 'image', 'article_cat_id', 'views', 'featured'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/articles/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/articles/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/articles/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/articles/" . $this->image);
                $thumb->resize(346,200);
                $thumbPath = "/storage/images/articles/thumbs/$this->image";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/articles/thumbs/" . $this->image);
        }
        return $imageUrl;
    }

    public function articleCat()
    {
        return $this->belongsTo(ArticleCat::class);
    }
}
