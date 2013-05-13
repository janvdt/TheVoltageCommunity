<?php

class AccountController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$account = Account::find($id);
		return View::make('user.account.edit')
			->with('account',$account);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'biography' => 'required',
				 
			)
		);

		if ($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$account = Account::find($id);
		$account->biography = Input::get('biography');
		$account->image_id = Input::get('image_id') ? Input::get('image_id'): 0;

		DB::table('images')->where('id',Input::get('image_id') ? Input::get('image_id'): 0)->update(array('profile' => 1));

		$account->save();

		return Redirect::action('UserController@showAccount', array($account->user->id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function follow($id)
	{
		$account = Account::find($id);

		if(Auth::user()){
			DB::table('followers')->insert(array('account_id' => Auth::user()->accountUser()->id,'follower_id' => $account->id));
		}
		else
		{
			$facebooksession = Session::get('hybridAuth');
			$facebookuser = User::where('identifier',$facebooksession->identifier)->first();
			DB::table('followers')->insert(array('account_id' => $facebookuser->accountUser()->id,'follower_id' => $account->id));
		}
		
		return $id;
	}

	public function unfollow($id)
	{
		$account = Account::find($id);

		if(Auth::user()){
		DB::table('followers')->where('account_id',Auth::user()->accountUser()->id)->where('follower_id',$id)->delete();
		}
		else
		{
			$facebooksession = Session::get('hybridAuth');
			$facebookuser = User::where('identifier',$facebooksession->identifier)->first();
			DB::table('followers')->where('account_id',$facebookuser->accountUser()->id)->where('follower_id',$id)->delete();

		}
		
		return $id;
	}

}