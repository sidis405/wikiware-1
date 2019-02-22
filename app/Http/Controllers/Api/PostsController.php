<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{
    protected $postsRepo;

    public function __construct(PostsRepository $postsRepo)
    {
        $this->postsRepo = $postsRepo;
    }

    // index
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'payload' => [
                'operation' => 'index',
                'posts' => $this->postsRepo->getAll()
            ]
        ]);
    }

    // show
    public function show(Post $post)
    {
        return response()->json([
            'status' => 'success',
            'payload' => [
                'operation' => 'show',
                'post' => $this->postsRepo->show($post)
            ]
        ]);
    }

    // store
    public function store(PostRequest $request)
    {
        return response()->json([
            'status' => 'success',
            'payload' => [
                'operation' => 'success',
                'post' => $this->postsRepo->store($request)
            ]
        ], 201);
    }

    // update
    public function update(Post $post, PostRequest $request)
    {
        return response()->json([
            'status' => 'success',
            'payload' => [
                'operation' => 'update',
                'post' => $this->postsRepo->update($post, $request)
            ]
        ]);
    }

    // destroy
    public function destroy(Post $post)
    {
        return response()->json([
            'status' => 'success',
            'payload' => [
                'operation' => 'destroy',
                'post' => $this->postsRepo->delete($post)
            ]
        ]);
    }
}
