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
	public function showscores()
	{
		$totalscores = Totalpoint::Orderby('value','desc')->get();
		return View::make('score.index')
			->with('totalscores',$totalscores);
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

		return Redirect::action('UserController@showAccount', array($account->id));
	
	}

	public function editprofile()
	{
		return View::make('user.editprofile');
	}

	public function updateprofile($id)
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

		return Redirect::action('AccountController@choosetaste');
	}
	public function choosetaste()
	{
		//Permission that belong to the role being edited.
		$checkedTastes = Taste::where('account_id',Auth::user()->accountUser()->id)->lists('value', 'name');

		$tastes = DB::table('genres')->select('title')->get();

		return View::make('user.account.choosetaste')
			->with('checkedTastes',$checkedTastes)
			->with('tastes',$tastes);
	}
	public function updateprofiletaste($id)
	{
		$account = Account::find($id);
		DB::table('tastes')
				->where('account_id',$account->id)
				->delete();
	
			$tastes = Input::get('tastes');



			if($tastes != NULL){
				//insert new permissions.
				foreach($tastes as $name => $value)
				{
					
					DB::table('tastes')
					->insert(array('account_id' => $account->id, 'name' => $name, 'value' => $value));

				}
			}
	
			return Redirect::to('/');
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

		DB::table('followers')->insert(array('account_id' => Auth::user()->accountUser()->id,'follower_id' => $account->id));
		
		return $id;
	}

	public function unfollow($id)
	{
		$account = Account::find($id);

		DB::table('followers')->where('account_id',Auth::user()->accountUser()->id)->where('follower_id',$id)->delete();
		
		return $id;
	}
	public function editTaste($id)
	{
		$account = Account::find($id);
			
		//Permission that belong to the role being edited.
		$checkedTastes = Taste::where('account_id',$account->id)->lists('value', 'name');

		$tastes = DB::table('genres')->select('title')->get();
	
		return View::make('user.account.taste.taste')
			->with('checkedTastes',$checkedTastes)
			->with('tastes',$tastes)
			->with('account',$account);
	}
	public function updateTaste($id)
	{
		$account = Account::find($id);
		DB::table('tastes')
				->where('account_id',$account->id)
				->delete();
	
			$tastes = Input::get('tastes');



			if($tastes != NULL){
				//insert new permissions.
				foreach($tastes as $name => $value)
				{
					
					DB::table('tastes')
					->insert(array('account_id' => $account->id, 'name' => $name, 'value' => $value));

				}
			}
	
			return Redirect::action('UserController@showAccount',array($account->id));
	}
	public function storeMessage()
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'textmessage'      => 'required',
			)
		);

		// If the validation fails.
		if ($validator->fails()) {
			
			// Else redirect back to the File Manager creation form.
			return Redirect::back()
				->withErrors($validator)
				->with('new_file_error', true);
		}
	
		// Prepare file to be saved into the database.
		$message = new Message;
		$message->body = Input::get('textmessage');
		$message->user_id = Auth::user()->id;
		$message->account_id = Input::get('account_id');

		$message->save();

		$account = Account::find(Input::get("account_id"));

		
		Notification::insert(array('body' => "placed a message!",'user_id' => Auth::user()->id,'account_id' => $message->account_id,'message_id' =>$message->id,'activity' => 1,'created_at' => $message->created_at,'type' => 5,'text' => Input::get('textmessage')));
		


		// If it was an ajax call, pass along the filename and file id
		// as a json array.
		if (Input::get('ajax')) {

			$response = array(
				'user_id'    => $message->user_id,
				'body' => $message->body,
				'id'    => $message->id,
				'date'  => $message->created_at,
				'text'  => 'placed a message!',
			);

			return Response::json($response);
		}
	}
	public function visitmusicposts($id)
	{
		$user = User::find($id);
		$musicposts = Post::where('created_by',$user->id)->where('type','music')->orderBy('id','desc')->get();
		return View::make('user.account.visit.musicpost')
			->with('musicposts',$musicposts)
			->with('user',$user);
	}

	public function visitgraphposts($id)
	{
		$user = User::find($id);
		$graphposts = Post::where('created_by',$user->id)->where('type','graph')->orderBy('id','desc');
		$graphposts = $graphposts->paginate(4);
		return View::make('user.account.visit.graphpost')
			->with('graphposts',$graphposts)
			->with('user',$user);
	}

}