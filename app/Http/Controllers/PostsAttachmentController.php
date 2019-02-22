<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsAttachmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:attach,post');
    }

    public function __invoke(Post $post)
    {
        [, $extension] = explode('.', $post->attachment);

        return response(
            Storage::disk('vault')->get($post->attachment),
            200
        )->header(
            'Content-Type',
            Storage::disk('vault')->mimetype($post->attachment)
        )->header(
            'Content-Disposition',
            'filename="download.' . $extension .  '"'
        );
    }
}
