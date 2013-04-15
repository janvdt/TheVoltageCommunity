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
	$InstanceController = new InstanceController;

	return $InstanceController->index();
});

Route::get('login', array('as' => 'login', function()
{
	return View::make('instance.login');
}));

Route::resource('user', 'UserController');

Route::group(array('before' => 'auth'), function()
{
		// File management.
	Route::get('files', 'FileController@index');
	Route::post('files', 'FileController@store');
	Route::delete('files/{id}', 'FileController@destroy');
	Route::post('images', 'ImageController@index');
	Route::get('user/showaccount/{id}', 'UserController@showAccount');
	Route::get('post/createGraph', 'PostController@createGraph');
	Route::post('post/storeGraph', 'PostController@storeGraph');
	Route::get('post/editmusic/{id}', 'PostController@editMusic');
	Route::post('post/updatemusic/{id}', 'PostController@updateMusic');
	Route::get('post/createMusic', 'PostController@createMusic');
	Route::post('post/storeMusic', 'PostController@storeMusic');
	Route::get('post/showmusic/{id}', 'PostController@showMusic');
	Route::get('post/showgraph/{id}', 'PostController@showGraph');
	Route::resource('post','PostController');
	Route::resource('music','MusicController');
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