<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Media;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $post_request['user_id'] = Auth::id();
        $userId = Auth::id();
        $post_request['caption'] = $request->caption;
        $post = Post::create($post_request);

        if($request->hasFile('url'))
        {            
            foreach ($request->file('url') as $image)
            {
                $name = $image->getClientOriginalName();
                $image->move(public_path().config('media.image'), $name);
                $data[] = $name;
            };
            $media_request['post_id'] = $post->id; 
            $media_request['url'] = json_encode($data);
            $media = Media::create($media_request);
        }
    
        return redirect()->route('profile.index', compact('userId'));
    }

    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        return view('post.editPost', compact('post', 'user'));
    }

    public function update($postId, Request $request)
    {
        $post = Post::findOrFail($postId);
        $userId = Auth::id();

        $post->caption = $request->caption;
        $media = Media::where('post_id', $postId)->delete();

        if ($request->hasFile('url'))
        {            
            foreach ($request->file('url') as $image)
            {
                $name = $image->getClientOriginalName();
                $image->move(public_path().config('media.image'), $name);
                $data[] = $name;
            };
            $media_request['post_id'] = $post->id;
            $media_request['url'] = json_encode($data);
            $media = Media::updateOrCreate($media_request);
        }

        $post->save();

        return redirect()->route('profile.index', compact('userId'));
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);
        $comments = $post->comments;

        return view('profile.index', compact('post','comments'));
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
        $userId = Auth::id();
        $post->delete();

        return redirect()->route('profile.index', compact('userId'));
    }
}
