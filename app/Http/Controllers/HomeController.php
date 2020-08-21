<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allUsers = User::all();

        $followers = $user->followers;
        $following = $user->following;
        $unfollowUsers = $allUsers->diff($following);

        $authPosts = Post::latest()->where('user_id', Auth::id())->get();
        $posts = collect($authPosts);

        foreach ($following as $other) 
        {
            foreach ($other->posts as $post)
            {
                $posts->push($post);
            }
        }
        $posts = $posts->sortByDesc->created_at;
        
        return view('home.home',compact('user', 'posts', 'followers', 'unfollowUsers'));
    }

    public function logout()
    {
        Auth::logout();
        
        return view('auth.login');
    }
}
