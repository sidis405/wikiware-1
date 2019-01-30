<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // hasMany Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
