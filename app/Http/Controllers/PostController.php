<?php

namespace App\Http\Controllers;

use App\Models\Like;
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
        $posts = Post::where('status', 'published')->orderBy('published_at', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guest()) {
            abort(404);
        }

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
        $slug = strtolower(str_replace(' ', '-', $request->slug));

        $request->merge(['slug' => $slug]);

        $request->validate([
            'title' => 'required|unique:posts,title',
            'slug' => 'required|unique:posts,slug',
            'excerpt' => 'required',
            'body' => 'required',
            'image_path' => 'image|mimes:png,jpg,jpeg,jfif,pjpeg,pjp',
            'status' => 'required',
        ]);

        if ($request->file('image_path')) {
            $fileName = time() . '_' . strtolower($request->file('image_path')->getClientOriginalName());
            $request->image_path = $fileName;
            $request->file('image_path')->storeAs('public/images/posts', $fileName);
        }

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $request->image_path ?? 'default.jpg',
            'status' => $request->status,
            'published_at' => now()->toDateTimeString(),
        ]);

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
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->status !== 'published' && (Auth::guest() || Auth::user()->id !== $post->user_id)) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if (Auth::guest() || Auth::user()->id !== $post->user_id) {
            abort(404);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $slug = strtolower(str_replace(' ', '-', $request->slug));

        $request->merge(['slug' => $slug]);

        $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id,
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'excerpt' => 'required',
            'body' => 'required',
            'image_path' => 'image|mimes:png,jpg,jpeg,jfif,pjpeg,pjp',
            'status' => 'required',
        ]);

        if ($request->file('image_path')) {
            if ($post->image_path !== 'default.jpg') {
                Storage::delete('public/images/posts/' . $post->image_path);
            }

            $fileName = time() . '_' . strtolower($request->file('image_path')->getClientOriginalName());
            $request->image_path = $fileName;
            $request->file('image_path')->storeAs('public/images/posts', $fileName);
        }

        $post->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $request->image_path ?? $post->image_path,
            'status' => $request->status,
            'published_at' => now()->toDateTimeString(),
        ]);

        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::findOrFail($slug);

        if ($post->image_path !== 'default.jpg') {
            Storage::delete('public/images/posts/' . $post->image_path);
        }

        Post::destroy($slug);

        return Redirect::route('posts.index');
    }

    public function like($slug)
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
