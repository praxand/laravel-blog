<?php

namespace App\Http\Controllers;

use App\Models\Post;

class RSSFeedController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->orderBy('published_at', 'desc')->get();
        return response()->view('feed.index', compact('posts'))->header('Content-Type', 'text/xml');
    }
}
