<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('logout','SessionsController@destroy');
Route::get('/', function()
{
	return View::make('home');
});

Route::get('posts/topPosts', 'PostsController@getTopPosts');

Route::resource('sessions','SessionsController');
Route::resource('users','UsersController');
Route::resource('posts','PostsController');
Route::resource('comments','CommentsController');
Route::resource('votes','VotesController');
