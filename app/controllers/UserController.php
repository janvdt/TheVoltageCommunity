<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		return View::make('user.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			$validator = Validator::make(
				Input::all(),
				array(
					'email' => 'required',
					'firstname'  => 'required',
					'lastname'  =>'required',
					'password' => 'confirmed',
					'password_confirmation'  => 'required', 
				)
			);
	
			if ($validator->fails())
			{
				return Redirect::back()
					->withInput()
					->withErrors($validator);
			}

			$account = new Account;

			$account->biography = "Fill in your biography";

			$account->save();
	

			$user = new User;

			$user->email = Input::get('email');

			$user->first_name = Input::get('firstname');

			$user->last_name = Input::get('lastname');

			$user->status = 'Active'; 

			$user->password = Hash::make(Input::get('password'));

			$user->account_id = $account->id;

			$user->save();

	
			return Redirect::to('/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function showAccount($id)
	{	

		$user = User::find($id);
		$musicposts = Post::where('created_by',$user->id)->where('type','music')->get();
		$graphposts = Post::where('created_by',$user->id)->where('type','graph')->get();
		if(Session::has('hybridAuth'))
		{
			$facebookuser = User::where('identifier',Session::get('hybridAuth')->identifier)->first();
			$followers = Follower::where('account_id','!=', $facebookuser->accountUser()->id)->where('follower_id',$facebookuser->accountUser()->id)->get();

			$following = Follower::where('account_id', $facebookuser->accountUser()->id)->get();
		}
		else{
		$followers = Follower::where('account_id','!=', Auth::user()->accountUser()->id)->where('follower_id',Auth::user()->accountUser()->id)->get();
		$following = Follower::where('account_id', Auth::user()->accountUser()->id)->get();
		}

		$tastes = Taste::where('account_id',$user->accountuser()->id)->get();

		return View::make('user.account.index')
			->with('user',$user)
			->with('musicposts',$musicposts)
			->with('graphposts',$graphposts)
			->with('followers',$followers)
			->with('following',$following)
			->with('tastes',$tastes);
	}
	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Activation link user.
	 *
	 * @return Response
	 */
	public function activateUser($id)
	{
			
		
	}

	/**
	 * Activation password form.
	 *
	 * @return Response
	 */
	public function submitActivation($id)
	{
		
	}

	/**
	 * Activate password.
	 *
	 * @return Response
	 */
	public function passwordActivation($id)
	{
		
	}


	/**
	 * Show the form for editing the password.
	 *
	 * @return Response
	 */
	public function editPassword($id)
	{
	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function updatePassword($id)
	{
		

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		
	}	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function visitAccount($id)
	{	
		$user = User::find($id);
		$shortmusicposts = Post::where('created_by',$user->id)->where('type','music')->take(9)->orderBy('id','desc')->get();
		$musicposts = Post::where('created_by',$user->id)->where('type','music')->orderBy('id','desc')->get();
		$shortgraphposts = Post::where('created_by',$user->id)->where('type','graph')->take(9)->orderBy('id','desc')->get();
		$graphposts = Post::where('created_by',$user->id)->where('type','graph')->get();
		$notifications = Notification::where('activity',1)->orderBy('id','desc');

		$notifications = $notifications->paginate(8);

		$tastes = Taste::where('account_id',$user->accountuser()->id)->get();

		if(Session::has('hybridAuth')){
			$facebooksession = Session::get('hybridAuth');
			$facebookuser = User::where('identifier',$facebooksession->identifier)->first();
			
			return View::make('user.account.visit')
				->with('user',$user)
				->with('musicposts',$musicposts)
				->with('graphposts',$graphposts)
				->with('facebookuser',$facebookuser)
				->with('tastes',$tastes)
				->with('shortgraphposts',$shortgraphposts)
				->with('shortmusicposts',$shortmusicposts)
				->with('notifications',$notifications);
		}
		else
		{
			return View::make('user.account.visit')
				->with('user',$user)
				->with('musicposts',$musicposts)
				->with('graphposts',$graphposts)
				->with('tastes',$tastes)
				->with('shortmusicposts',$shortmusicposts)
				->with('shortgraphposts',$shortgraphposts)
				->with('notifications',$notifications);
		}
	}

}