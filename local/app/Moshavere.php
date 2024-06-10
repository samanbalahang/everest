<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moshavere extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'method_id',
        'favs',
        'source',
    ];

    public function method()
    {
        return $this->belongsTo(Method::class);
    }

    public function getFavAttribute()
    {
        $favs = json_decode($this->favs);
        foreach ($favs as $fav) {
            echo "<span>$fav</span>,";  
        }
    }
}
