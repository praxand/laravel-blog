<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function index($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
            'body' => request('comment'),
        ]);

        return Redirect::route('posts.show', $slug);
    }
}
