<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{
    protected $postsRepo;

    public function __construct(PostsRepository $postsRepo)
    {
        $this->postsRepo = $postsRepo;
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('can:update,post')->only('edit', 'update');
        $this->middleware('can:delete,post')->only('delete');
    }

    public function index()
    {
        $posts = $this->postsRepo->getAll();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post = $this->postsRepo->show($post);

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
        $post = $this->postsRepo->store($request);

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
        $post = $this->postsRepo->update($post, $request);

        return redirect()->route('posts.edit', $post)->withStatus('Done.');
    }

    public function destroy(Post $post)
    {
        $this->postsRepo->delete($post);

        return redirect()->route('posts.index');
    }
}
