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
	
	return View::make('home',['regions' =>  Region::getAllRegions()]);
});
Route::get('login/fb', 'FacebookController@index');
Route::get('login/fb/callback','FacebookController@callback');

Route::post('deals/filter', 'DealsController@filter');
Route::get('user/instellingen', 'UsersController@instellingen');
Route::get('user/editPassword','UsersController@MakePasswordForm');
Route::post('user/savePassword','UsersController@savePassword');
Route::post('user/{id}/vote','UsersController@vote');
Route::get('user/profielen','UsersController@profielen');
Route::post('user/filter','UsersController@filter');


Route::resource('sessions','SessionsController');
Route::resource('users','UsersController');
Route::resource('deals','DealsController');
Route::resource('mydeals','myDealsController');
Route::resource('comments','CommentsController');
Route::resource('votes','VotesController');
