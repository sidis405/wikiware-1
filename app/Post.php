<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use CrudTrait;
    // public static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($post) {
    //         $post->user_id = auth()->id();
    //     });
    // }

    protected $guarded = ['id'];
    // protected $fillable = ['title','preview','body','category_id', 'user_id', 'cover'];

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
    public function getCoverAttribute($cover)
    {
        return '/storage/' . ($cover ?? 'covers/default.jpg');
    }

    // public function getAttachmentAttribute($attachment)
    // {
    //     return $attachment;
    //     // return config('filesystems.disks.vault.root') . '/' . $attachment;
    // }

    // setters - mutators
    public function setCoverAttribute($cover)
    {
        // $this->attributes['cover'] =
        // auth()->user()->can('upload', $this) ? $cover->store('covers') ? null;

        $this->attributes['cover'] = $cover->store('covers');
    }

    public function setAttachmentAttribute($attachment)
    {
        $this->attributes['attachment'] = Storage::disk('vault')->putFile('attachments', $attachment);
    }


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
