<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('profile.index', compact('posts'));
    }

    public function create()
    {

        return view('profile.index');
    }

    public function store(PostRequest $request)
    {
        $request['user_id'] = Auth::id();
        $userId = Auth::user()->id;
        $post = Post::create($request->all());

        return back();
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);
        $comments = $post->comments;

        return view('profile.index', compact('post','comments'));
    }

    public function destroy(post $post)
    {
        $post->delete();

        return redirect()->route('profile.index');
    }
}
