<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', 'published')->orderBy('published_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'image_path' => 'image|mimes:png,jpg,jpeg,jfif,pjpeg,pjp',
            'status' => 'required',
        ]);

        $request->merge([
            'user_id' => Auth::user()->id,
            'slug' => strtolower(str_replace(' ', '-', $request->slug)),
            'published_at' => now()->toDateTimeString(),
        ]);

        if ($request->file('image_path')) {
            $fileName = time() . '_' . strtolower($request->file('image_path')->getClientOriginalName());
            $request->image_path = $fileName;
            $request->file('image_path')->storeAs('public/images/posts', $fileName);
        }

        Post::create($request->all());

        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->image_path !== 'default.jpg') {
            Storage::delete('public/images/posts/' . $post->image_path);
        }

        Post::destroy($id);

        return Redirect::route('posts.index');
    }
}
