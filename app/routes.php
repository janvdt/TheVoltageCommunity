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

Route::get('/', function()
{
	$HomeController = new HomeController;

	return $HomeController->index();
});

Route::get('login', array('as' => 'login', function()
{
	return View::make('instance.login');
}));
Route::get('post/showlikes/{id}', 'PostController@showLikes');
Route::get('post/createMusic', 'PostController@createMusic');
Route::post('post/storeMusic', 'PostController@storeMusic');
Route::resource('user', 'UserController');
Route::resource('music','MusicController');
Route::resource('graph','GraphController');
Route::resource('post','PostController');
Route::post('post/like/{id}', 'PostController@like');
Route::get('post/showmusic/{id}', 'PostController@showMusic');
Route::get('post/showgraph/{id}', 'PostController@showGraph');

Route::group(array('before' => 'auth'), function()
{
		// File management.
	Route::get('files', 'FileController@index');
	Route::post('files', 'FileController@store');
	Route::delete('files/{id}', 'FileController@destroy');
	Route::post('images', 'ImageController@index');
	Route::get('user/showaccount/{id}', 'UserController@showAccount');
	Route::get('user/visitaccount/{id}', 'UserController@visitAccount');
	Route::resource('post','PostController');
	Route::get('post/createGraph', 'PostController@createGraph');
	Route::post('post/storeGraph', 'PostController@storeGraph');
	Route::get('post/editmusic/{id}', 'PostController@editMusic');
	Route::post('post/updatemusic/{id}', 'PostController@updateMusic');
	
	Route::resource('account','AccountController');

	
});

Route::post('login', function()
{
	$email = Input::get('email');
	$password = Input::get('password');
	$remember = Input::get('remember') ? true : false;

	if (Auth::attempt(array('email' => $email, 'password' => $password), $remember))
	{
					
			return Redirect::to('/');

	}
	
	return Redirect::to('login')->withInput()->with('login_errors', true);
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});