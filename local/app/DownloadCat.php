<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadCat extends Model
{
    protected $fillable = [
        'title', 'slug', 'views'
    ];

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
