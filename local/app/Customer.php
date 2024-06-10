<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Customer extends Model
{
    protected $fillable = [
        'name', 'logo'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->logo))
        {
            $imagePath = public_path() . "/storage/images/customers/" . $this->logo;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/customers/" . $this->logo);
        }

        return $imageUrl;
    }
    
    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->logo))
        {
            $imagePath = public_path() . "/storage/images/customers/thumbs/" . $this->logo;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/customers/" . $this->logo);
                $thumb->resize(170, null, function ($constraint) {
                    $constraint->aspectRatio();
                });;
                $thumbPath = "/storage/images/customers/thumbs/$this->logo";
                $thumb->save(public_path($thumbPath), 70);
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/customers/thumbs/" . $this->logo);
        }
        return $imageUrl;
    }
}
