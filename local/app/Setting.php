<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'type', 'name', 'label', 'value', 'text', 'show'
    ];

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->value))
        {
            $imagePath = public_path() . "/storage/images/settings/" . $this->value;
            if (file_exists($imagePath)) $imageUrl = asset("storage/images/settings/" . $this->value);
        }

        return $imageUrl;
    }
}
