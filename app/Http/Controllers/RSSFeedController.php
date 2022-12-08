<?php

namespace App\Http\Controllers;

use App\Models\Post;

class RSSFeedController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return response()->view('feed.index', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
