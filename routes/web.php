<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('logout', 'HomeController@logout')->name('logout');
Auth::routes();

// User Profile
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('{userId}', 'ProfileController@show')->name('profile.index');
    Route::post('{userId}/follow', 'ProfileController@followUser')->name('profile.follow');
    Route::post('{userId}/unfollow', 'ProfileController@unFollowUser')->name('profile.unfollow');
    Route::get('{userId}/followers', 'ProfileController@followers')->name('profile.followers');
    Route::get('{userId}/following', 'ProfileController@following')->name('profile.following');
});

// Posts
Route::post('post', 'PostController@store')->name('post.store')->middleware('auth');
Route::get('like/{post}', 'PostController@like')->name('post.like');
Route::get('unlike/{post}', 'PostController@unlike')->name('post.unlike');

// Comments
Route::post('comment', 'CommentController@store')->name('comment.store')->middleware('auth');


//Admin
Route::group(['prefix' => 'admin'], function() {
    // Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('action_users', 'UserController');
    Route::get('users', 'AdminController@getUsers')->name('admin.users');
    Route::get('posts', 'AdminController@getPosts')->name('admin.posts');
    Route::get('comments', 'AdminController@getComments')->name('admin.comments');
});
