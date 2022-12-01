<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
