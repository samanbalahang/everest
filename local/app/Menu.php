<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Menu extends Model
{
    protected $fillable = [
        'title', 'link', 'parent_id', 'menu_pos_id', 'image'
    ];

    public function menuPos()
    {
        return $this->belongsTo(MenuPos::class);
    }

    public function getSubsAttribute()
    {
        $subs = Menu::where('parent_id', $this->id)->get();
        if ($subs->count() > 0) {
            return $subs;
        } else {
            return false;
        }
    }

    public function getParentAttribute()
    {
        if ($this->parent_id > 0) {
            $parent = Menu::findOrFail($this->parent_id);
            return $parent->title;
        } else {
            echo "-";
        }
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/menus/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/menus/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/storage/images/menus/thumbs/" . $this->image;
            if (! file_exists($imagePath)) {
                $thumb = Image::make(public_path() . "/storage/images/menus/" . $this->image);
                $thumb->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });;
                $thumbPath = "/storage/images/menus/thumbs/$this->image";
                $thumb->save(public_path($thumbPath));
            }
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/menus/thumbs/" . $this->image);
        }
        return $imageUrl;
    }
}
