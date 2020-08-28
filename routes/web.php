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

Route::get('home', 'HomeController@index')->name('home');
Route::get('logout', 'HomeController@logout')->name('logout');
Auth::routes();
Route::get('user/{username}', 'ProfileController@show')->name('profile.index')->middleware('auth');
Route::post('post', 'PostController@store')->name('post.store')->middleware('auth');
Route::post('comment', 'CommentController@store')->name('comment.store')->middleware('auth');
