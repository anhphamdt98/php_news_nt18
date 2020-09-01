<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $posts = Post::latest()->where('user_id', $user->id)->get();
        $followers = $user->followers;
        $following = $user->following;
        
        return view('profile.index',compact('user', 'posts', 'followers', 'following'));
    }

    public function followUser($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $user->followers()->attach(auth()->user()->id);

        return redirect()->back();
    }

    public function unFollowUser($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $user->followers()->detach(auth()->user()->id);

        return redirect()->back();
    }
    
    public function followers($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $other = $user->followers;

        return view('profile.userList', compact('other', 'user'));
    }
    
    public function following($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $other = $user->following;

        return view('profile.userList', compact('other', 'user'));
    }
}
