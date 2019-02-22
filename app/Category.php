<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CrudTrait;

    // hasMany Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
