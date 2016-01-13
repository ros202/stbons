<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/home', function() {
	return Redirect::to('/');
});

Route::post('/update', function() {
	print(shell_exec('/usr/local/bin/updatewebsite'));
});

// Application routes...
Route::get('/', ['middleware' => 'auth', 'uses' => 'VideosController@index']);
Route::get('/videos', ['middleware' => 'auth', 'uses' => 'VideosController@index']);
Route::get('/video/show/{id}', ['middleware' => 'auth', 'uses' => 'VideosController@show']);
Route::post('/video/upvote/{id}', ['middleware' => ['throttle:2,1', 'auth'], 'uses' => 'VideosController@upvote']);
Route::get('/video/delete/{id}', ['middleware' => 'auth', 'uses' => 'VideosController@destroy']);
Route::get('/video/upload', ['middleware' => 'auth', 'uses' => 'VideosController@create']);
Route::post('/video/upload', ['middleware' => 'auth', 'uses' => 'VideosController@store']);