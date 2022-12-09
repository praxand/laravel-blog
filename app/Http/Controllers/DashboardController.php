<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            abort(404);
        }

        return view('dashboard', [
            'posts' => Post::all(),
            'users' => User::all(),
            'comments' => Comment::all(),
            'categories' => Category::all(),
        ]);
    }
}
