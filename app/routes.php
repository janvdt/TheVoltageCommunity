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

View::composer('instance.header', function($view)
{
	if(Auth::user())
	{
	$notcount = Notification::where('viewed',FALSE)->where('user_id','!=',Auth::user()->id)->where('post_creator',Auth::user()->id)->where('activity',FALSE)->get();
	$notifications = Notification::where('user_id','!=',Auth::user()->id)->get();

	$following = Follower::where('account_id', Auth::user()->accountUser()->id)->get();

	$view->with('notcount', $notcount)->with('notifications',$notifications)->with('following',$following);
	}

});

Route::get('login', array('as' => 'login', function()
{
	return View::make('instance.login');
}));
Route::resource('comment','CommentController');
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
Route::get('user/showaccount/{id}', 'UserController@showAccount');
Route::get('user/visitaccount/{id}', 'UserController@visitAccount');
Route::resource('account','AccountController');
Route::post('account/unfollow/{id}', 'AccountController@unfollow');
Route::post('account/follow/{id}', 'AccountController@follow');
Route::get('activity', 'HomeController@showActivity');
Route::post('post/share/{id}', 'PostController@share');



Route::group(array('before' => 'auth'), function()
{
		// File management.
	Route::get('files', 'FileController@index');
	Route::post('files', 'FileController@store');
	Route::delete('files/{id}', 'FileController@destroy');
	Route::post('images', 'ImageController@index');
	Route::get('post/createGraph', 'PostController@createGraph');
	Route::post('post/storeGraph', 'PostController@storeGraph');
	Route::get('post/editmusic/{id}', 'PostController@editMusic');
	Route::post('post/updatemusic/{id}', 'PostController@updateMusic');
	Route::resource('subcomment','SubcommentController');
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
	Cache::forget('hybridAuth');
	return Redirect::to('/');

});

/**
 * GET-Route: Catch the provider for auth with other network and redirect to authenticate route
 */
Route::get('social/{provider}', array('as' => 'socialAuth', function($provider)
{
	return Redirect::route('hybridauth', 'start')->with('provider', $provider);
}));
 
/**
 * GET-Route: Catch action and process the login via hybrid Auth
 */
Route::get('social/authenticate/{action}', array("as" => "hybridauth", function($action = "")
{
	if (Session::has('provider'))
	{
		$provider = Session::get('provider');
	}
 
	// if "auth" is set as "action" do login
	if ($action == "auth")
	{
		// process auth
		try
		{
			Hybrid_Endpoint::process();
		}
		catch (Exception $e)
		{
			// redirect home on error
			return Redirect::route('showWelcome')
				->with('hybridAuthError', 'Social Network Authentication failed');
		}
 
		return;
	}
 
	// if != auth create new HybridAuth-Object
	try
	{
		// create a new HybridAuth Object by using the configuration file for secrets and token
		$socialAuth = new Hybrid_Auth(__DIR__ . '/config/hybridauth.php');
		// authenticate with Twitter
		$provider = $socialAuth->authenticate($provider);
		// fetch user profile
		$userProfile = $provider->getUserProfile();


	}
	catch (Exception $e)
	{
		// Redirect Home on error
		return Redirect::route('showWelcome')
			->with('hybridAuthError', 'Social Network Authentication failed');
	}
 
	// Store received data in session
	Cache::put('hybridAuth', $userProfile,120);
 
	// logout
	$provider->logout();

	$facebooklogin = Cache::get('hybridAuth');

	$identifier = $facebooklogin->identifier;

	$user = DB::table('users')->where('identifier', $identifier )->first();

	if($user == NULL)
	{	
		DB::table('accounts')->insert(array('identifier' => $facebooklogin->identifier,'facebookpic' => $facebooklogin->photoURL ));

		$account = Account::where('identifier',$facebooklogin->identifier)->first();

   		DB::table('users')->insert(array('email' => $facebooklogin->email,'first_name' => $facebooklogin->firstName,'last_name' => $facebooklogin->lastName,'status' => 'Active','account_id' => $account->id,'identifier' => $facebooklogin->identifier));
   		$facebookuser = User::where('identifier',$facebooklogin->identifier)->first();

   		Auth::loginUsingId($facebookuser->id);
   	}
   	else
   	{
   		Auth::loginUsingId($user->id);
   	}
             
    return Redirect::to('/')->with('hybridAuthSuccess', 'Social network Authentication successfull');
}));