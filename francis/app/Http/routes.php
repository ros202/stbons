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

Route::get('/', 'VideosController@index');
Route::get('/videos', 'VideosController@index');
Route::get('/video/show/{id}', 'VideosController@show');
Route::get('/video/upvote/{id}', 'VideosController@upvote');