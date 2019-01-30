<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('can:update,post')->only('edit', 'update');
        $this->middleware('can:delete,post')->only('delete');
        // $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index()
    {
        $posts = Post::with('user', 'category', 'tags')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('user', 'category', 'tags');

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $post = new Post;

        return view('posts.create', compact('categories', 'tags', 'post'));
    }

    public function store(PostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.show', $post)->withStatus('Done.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('categories', 'tags', 'post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $post->update($request->validated());

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.show', $post)->withStatus('Done.');
    }

    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
