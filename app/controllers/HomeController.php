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
		$musicposts = Post::where('type','music')->orderBy('views', 'desc')->take(4)->get();
		$graphposts = Post::where('type','graph')->orderBy('views', 'asc')->take(4)->get();
		$posts = Post::where('type','music')->take(5)->orderBy('postlikes', 'desc')->get();

		return View::make('instance.index')
			->with('musicposts',$musicposts)
			->with('graphposts',$graphposts)
			->with('posts',$posts)
			->with('images',$images);

		
	}

	public function showActivity()
	{
		$notifications = Notification::orderBy('id','desc');

		$notifications = $notifications->paginate(30);

		return View::make('instance.activity')
			->with('notifications',$notifications);
	}
	public function searchuser()
	{
		$param = Input::get("searchData");

		$users = User::where('id','!=',Auth::user()->id);

		$users =$users->Where(function($query)
			{
				$query->where('first_name', 'LIKE', '%' . Input::get("searchData") . '%')
					->orwhere('last_name', 'LIKE', '%' . Input::get("searchData") . '%');
			})->get();

		$test = array();
		foreach($users as $user)
		{
			if($user->accountUser()->facebookpic != NULL)
        	{
        		$user['image'] = $user->accountUser()->facebookpic;
        	}
        	else
        	{
        		$user['image'] = $user->accountUser()->getImagePathname();
        	}
			$test[] = $user->toArray();
		}
		return $test;
	}

}