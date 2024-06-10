<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCat extends Model
{
    protected $fillable = [
        'title', 'slug', 'views'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
