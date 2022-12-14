<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function index($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $like = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first();

        if ($like) {
            Like::destroy($like->id);
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id,
            ]);
        }

        return Redirect::route('posts.show', $slug);
    }
}
