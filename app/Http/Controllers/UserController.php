<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->where('status', 'draft')->get();
        return view('users.index', compact('user', 'posts'));
    }
}
