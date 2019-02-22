<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use CrudTrait;

    protected $appends = [
        'show_route'
    ];

    // belongsToMany Post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getShowRouteAttribute()
    {
        return route('tags.show', $this);
    }
}
