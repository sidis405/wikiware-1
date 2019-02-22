<?php

namespace App\Repositories;

use App\Post;
use App\Events\PostWasUpdated;
use Illuminate\Foundation\Http\FormRequest;

class PostsRepository
{
    public function getAll($howMany = 10)
    {
        return Post::with('user', 'category', 'tags')->latest()->paginate($howMany);
    }

    public function show(Post $post)
    {
        return $post->load('user', 'category', 'tags');
    }

    public function store(FormRequest $request)
    {
        $post = $request->user()->posts()->create($request->validated());

        $post->tags()->sync($request->tags);

        return $post;
    }

    public function update(Post $post, FormRequest $request)
    {
        $post->update($request->validated());

        $post->fresh()->tags()->sync($request->tags);

        event(new PostWasUpdated($post));

        return $post;
    }

    public function delete(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();

        return $post;
    }
}
