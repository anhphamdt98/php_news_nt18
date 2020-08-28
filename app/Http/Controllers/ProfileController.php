<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        $posts = Post::latest()->where('user_id', Auth::id())->get();
        
        return view('profile.index',compact('user', 'posts'));
    }
}
