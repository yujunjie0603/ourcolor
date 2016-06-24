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

Route::get('login/', function () {
    return view('welcome');
});


Route::get('auth/logout', 'Auth\AuthController@logout');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {

	Route::resource('colorinfo', 'ColorInfoController');
	Route::resource('user', 'UserController');
	Route::get('/{team_id?}', 'AdminHomeController@index');
});
Route::get('/{team?}', 'ColorInfoController@index');
Route::auth();
Route::get('/', 'ColorInfoController@index');

Route::get('color/', 'ColorInfoController@index');

Route::get('/home', 'HomeController@index');
