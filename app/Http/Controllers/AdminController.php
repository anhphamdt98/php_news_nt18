<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers()
    {
        $users = User::paginate(config('constains.paginate'));

        return view('admin.userList', compact('users'));
    }

    public function getPosts()
    {
        $posts = Post::paginate(config('constains.paginate'));

        return view('admin_pages.posts_list', compact('posts'));
    }

    public function getComments()
    {
        $comments = Comment::paginate(config('constains.paginate'));

        return view('admin_pages.comments_list', compact('comments'));
    }
}
