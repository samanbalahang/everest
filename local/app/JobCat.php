<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCat extends Model
{
    protected $fillable = [
        'title', 'slug', 'views'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
