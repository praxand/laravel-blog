<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'posts' => Post::all(),
            'users' => User::all(),
            'comments' => Comment::all(),
            'categories' => Category::all(),
        ]);
    }
}
