<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // public static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($post) {
    //         $post->user_id = auth()->id();
    //     });
    // }

    // protected $guarded = ['id'];
    protected $fillable = ['title','preview','body','category_id', 'user_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // belongsTo Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // belongsToMany Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // morphMany Comment
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // getters - accessros
    // public function getTitleAttribute($title)
    // {
    //     return strtoupper($title);
    // }

    // setters - mutators
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str_slug($title);
    }

    public function isAuthoredBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    public function isNotAuthoredBy(User $user)
    {
        return ! $this->isAuthoredBy($user);
    }
}
