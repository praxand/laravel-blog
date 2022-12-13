<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $draftedPosts = Post::where('user_id', $id)->where('status', 'draft')->orderBy('published_at', 'desc')->paginate(1, ['*'], 'drafts');
        return view('users.index', compact('user', 'draftedPosts'));
    }
}
