<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$images = Image::take(4)->get();
		$musicposts = Post::where('type','music')->take(4)->orderBy('created_at', 'desc')->get();
		$graphposts = Post::where('type','graph')->take(4)->orderBy('created_at', 'desc')->get();
		$posts = Post::where('type','music')->take(5)->orderBy('postlikes', 'desc')->get();

		return View::make('instance.index')
			->with('musicposts',$musicposts)
			->with('graphposts',$graphposts)
			->with('posts',$posts)
			->with('images',$images);

		
	}

	public function showActivity()
	{
		$followers = Follower::where('account_id',Auth::user()->accountUser()->id)->get();

		return View::make('instance.activity')
			->with('followers',$followers);
	}

}