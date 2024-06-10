<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPos extends Model
{
    protected $fillable = [
        'title', 'name'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
