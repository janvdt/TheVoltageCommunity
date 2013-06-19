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

View::composer('layout', function($view)
{
	if(Auth::user())
	{
	$notcount = Notification::where('viewed',FALSE)->where('user_id','!=',Auth::user()->id)->where('post_creator',Auth::user()->id)->where('activity',FALSE)->get();
	$notifications = Notification::where('user_id','!=',Auth::user()->id)->orderBy('id','desc')->get();

	$following = Follower::where('account_id', Auth::user()->accountUser()->id)->get();

	$view->with('notcount', $notcount)->with('notifications',$notifications)->with('following',$following);
	}

});

View::composer('diy.layout', function($view)
{
	if(Auth::user())
	{
	$notcount = Notification::where('viewed',FALSE)->where('user_id','!=',Auth::user()->id)->where('post_creator',Auth::user()->id)->where('activity',FALSE)->get();
	$notifications = Notification::where('user_id','!=',Auth::user()->id)->orderBy('id','desc')->get();

	$following = Follower::where('account_id', Auth::user()->accountUser()->id)->get();

	$view->with('notcount', $notcount)->with('notifications',$notifications)->with('following',$following);
	}

});

Route::get('login', array('as' => 'login', function()
{
	return View::make('instance.login');
}));
Route::get('account/showscores', 'AccountController@showscores');
Route::get('account/choosetaste', 'AccountController@choosetaste');
Route::get('account/editprofile','AccountController@editprofile');
Route::get('playlist/showvisitplaylist', 'PlaylistController@showvisitplaylist');
Route::get('playlist/showowntype', 'PlaylistController@showowntype');
Route::get('playlist/showtype', 'PlaylistController@showtype');
Route::post('playlist/updatetitle/{id}', 'PlaylistController@updatetitle');
Route::get('playlist/copy/{id}', 'PlaylistController@copy');
Route::get('playlist/showplaylist/{id}', 'PlaylistController@showplaylist');
Route::post('post/destroygraphSelected', 'PostController@destroygraphSelected');
Route::post('post/destroySelected', 'PostController@destroySelected');
Route::post('playlist/destroySelected', 'PlaylistController@destroySelected');
Route::get('playlist/playlistsound','PlaylistController@playlistsound');
Route::post('playlist/orderplaylist/{id}', 'PlaylistController@orderPlaylist');
Route::get('post/addplaylist', 'PostController@addplaylist');
Route::get('search','HomeController@searchuser');
Route::get('turntable/search','TurntableController@search');
Route::get('music/subgenre/searchsubgenre','MusicController@searchsubgenre');
Route::get('music/genre/searchgenre','MusicController@searchgenre');
Route::get('graph/search','GraphController@search');
Route::get('music/search','MusicController@search');
Route::get('music/mytaste/searchtaste','MusicController@searchtaste');
Route::get('playlist/showall', 'PlaylistController@showAll');
Route::get('music/mytaste', 'MusicController@myTaste');
Route::get('music/genre', 'PostController@showGenre');
Route::get('music/subgenre', 'PostController@showSubgenre');
Route::resource('comment','CommentController');
Route::get('post/showlikes/{id}', 'PostController@showLikes');
Route::get('post/createGraph', 'PostController@createGraph');
Route::get('post/createMusic', 'PostController@createMusic');
Route::post('post/storeMusic', 'PostController@storeMusic');
Route::resource('playlist', 'PlaylistController');
Route::resource('user', 'UserController');
Route::post('account/updateprofile/{id}', 'AccountController@updateprofile');
Route::post('account/updateprofiletaste/{id}', 'AccountController@updateprofiletaste');

Route::resource('music','MusicController');
Route::get('turntable/utils/soundcloud_fetch_track', function()
{

    require '../public/utils/include/referrer_check.php';

	require '../public/utils/include/SC_API_KEY.php';

	require '../public/utils/include/API_cache.php';


	
 $track_id = intval(Input::get('id'));

  

  $ZOMG_SECRET = get_soundcloud_api_key();

  $cache_file = 'soundcloud_track_id_' . $track_id . '.json';
  $api_call = 'http://api.soundcloud.com/tracks/' . $track_id . '.json?client_id=' . $ZOMG_SECRET . '&format=json&callback=wheelsofsteel.soundcloudJSONP_' . $track_id;
  $cache_for = 480; // cache results for "n" minutes

  $api_cache = new API_cache ($api_call, $cache_for, $cache_file);

  echo($api_cache);

  if (!$res = $api_cache->get_api_cache())
    $res = '{"error": "Could not load cache"}';

  ob_start();
  echo $res;
  $json_body = ob_get_clean();

  header ('Content-Type: application/json');
  header ('Content-length: ' . strlen($json_body));
  header ("Expires: " . $api_cache->get_expires_datetime());
  echo $json_body;

});

Route::get('turntable/utils/soundcloud_fetch_url', function()
{
	require '../public/utils/include/referrer_check.php';
	require '../public/utils/include/SC_API_KEY.php';
	require '../public/utils/include/API_cache.php';


  $track_id = intval(Input::get('id'));

  $ZOMG_SECRET = get_soundcloud_api_key();

  $cache_file = 'soundcloud_track_id_' . $track_id . '.json';

  $js_callback = 'wheelsofsteel.soundcloudURL_' . $track_id;

  $api_call = 'http://api.soundcloud.com/tracks/' . $track_id . '/stream/?client_id=' . $ZOMG_SECRET . '&format=json&callback=' . $js_callback;

function get_web_page($url) {

    /*
     * hat tip: http://forums.devshed.com/php-development-5/curl-get-final-url-after-inital-url-redirects-544144.html
    */

    $options = array( 
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => false,     // return web page 
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true,
        CURLOPT_CONNECTTIMEOUT => 5,        // timeout on connect 
        CURLOPT_TIMEOUT        => 5,        // timeout on response 
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_RETURNTRANSFER => true,     // return web page 
    ); 

    $ch      = curl_init( $url ); 
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    return $header;

}  

$myUrlInfo = get_web_page($api_call);

echo "try{\n " . $js_callback . "({ url: '" . $myUrlInfo["url"] . "' });\n} catch(e){}";
});
Route::resource('feedback','FeedbackController');
Route::resource('turntable','TurntableController');
Route::resource('graph','GraphController');
Route::post('account/storemessage', 'AccountController@storeMessage');
Route::resource('post','PostController');
Route::any('post/share/{id}', 'PostController@share');
Route::any('post/activityshare/{id}', 'PostController@activityshare');

Route::post('post/like/{id}', 'PostController@like');
Route::any('music/listenpoints/{id}', 'MusicController@listenpoints');
Route::get('post/showmusic/{id}', 'PostController@showMusic');
Route::get('post/showgraph/{id}', 'PostController@showGraph');
Route::get('user/showaccount/{id}', 'UserController@showAccount');

Route::get('user/visitaccount/{id}', 'UserController@visitAccount');
Route::get('account/visitmusicposts/{id}', 'AccountController@visitmusicposts');
Route::get('account/visitgraphposts/{id}', 'AccountController@visitgraphposts');
Route::resource('account','AccountController');
Route::post('account/updatetaste/{id}', 'AccountController@updateTaste');
Route::get('account/edittaste/{id}', 'AccountController@editTaste');
Route::post('account/unfollow/{id}', 'AccountController@unfollow');
Route::post('account/follow/{id}', 'AccountController@follow');
Route::get('activity', 'HomeController@showActivity');







Route::group(array('before' => 'auth'), function()
{
		// File management.
	Route::get('files', 'FileController@index');
	Route::post('files', 'FileController@store');
	Route::delete('files/{id}', 'FileController@destroy');
	Route::post('images', 'ImageController@index');
	
	Route::post('post/storeGraph', 'PostController@storeGraph');
	Route::get('post/editmusic/{id}', 'PostController@editMusic');
	Route::get('post/editgraph/{id}', 'PostController@editGraph');
	Route::post('post/updatemusic/{id}', 'PostController@updateMusic');
	Route::post('post/updategraph/{id}', 'PostController@updateGraph');
	Route::resource('subcomment','SubcommentController');
});

Route::post('login', function()
{
	$email = Input::get('email');
	$password = Input::get('password');
	$remember = Input::get('remember') ? true : false;

	if (Auth::attempt(array('email' => $email, 'password' => $password,'identifier' => 0), $remember))
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
			$totalpoint = new Totalpoint;

			$totalpoint->value = 1;

			$totalpoint->save();

		DB::table('accounts')->insert(array('identifier' => $facebooklogin->identifier,'facebookpic' => $facebooklogin->photoURL,'totalpoint_id' => $totalpoint->id ));

		$account = Account::where('identifier',$facebooklogin->identifier)->first();

		$totalpointupdate = Totalpoint::find($totalpoint->id);

			$totalpointupdate->account_id = $account->id;

			$totalpointupdate->save();

			$point = new Point;

			$point->account_id = $account->id;

			$point->value = 1;

			$point->save();

			DB::table('account_level')->insert(array('account_id' => $account->id, 'level_id' => 1));

   		DB::table('users')->insert(array('email' => $facebooklogin->email,'first_name' => $facebooklogin->firstName,'last_name' => $facebooklogin->lastName,'status' => 'Active','account_id' => $account->id,'identifier' => $facebooklogin->identifier));
   		$facebookuser = User::where('identifier',$facebooklogin->identifier)->first();

   		Auth::loginUsingId($facebookuser->id);

   		return Redirect::action('AccountController@editprofile');
   	}
   	else
   	{
   		Auth::loginUsingId($user->id);
   	}
             
    return Redirect::to('/')->with('hybridAuthSuccess', 'Social network Authentication successfull');
}));