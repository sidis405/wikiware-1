<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // belongsToMany Post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
