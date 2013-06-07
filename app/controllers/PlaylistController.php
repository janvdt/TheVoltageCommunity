<?php

class PlaylistController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$playlists = Playlist::where('account_id',Auth::user()->accountUser()->id)->get();
		return View::make('playlist.index')
			->with('playlists',$playlists);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('playlist.create');
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
				'title' => 'required',
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$playlist = new Playlist;
		$playlist->title = Input::get('title');
		$playlist->account_id = Auth::user()->accountUser()->id;
		$playlist->save();

		DB::table('notifications')->insert(array('body' => "created a playlist!",'user_id' => Auth::user()->id,'playlist_id' => $playlist->id,'activity' => 1,'created_at' => $playlist->created_at,'type' => 7));

		return Redirect::action('PlaylistController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$playlist = Playlist::find($id);

		$soundcloudsurl = array();
		foreach($playlist->posts as $post)
		{
			$soundcloudsurl[] = $post->soundcloud;
		}


		return View::make('playlist.show')
			->with('playlist',$playlist)
			->with('soundcloudsurl',$soundcloudsurl);

	}
	public function showplaylist($id)
	{
		$playlist = Playlist::find($id);

		$soundcloudsurl = array();
		foreach($playlist->posts as $post)
		{
			$soundcloudsurl[] = $post->soundcloud;
		}


		return View::make('playlist.showplaylist')
			->with('playlist',$playlist)
			->with('soundcloudsurl',$soundcloudsurl);

	}
	public function showall()
	{
		if(Auth::user())
		{
			$playlists = Playlist::where('account_id','!=', Auth::user()->accountUser()->id)->get();
		}
		else
		{
			$playlists = Playlist::all();
		}
		return View::make('playlist.showall')
			->with('playlists',$playlists);
	}

	public function orderPlaylist($id)
	{
		$playlist = Playlist::find($id);
		$new_position = Input::get('index');
		$old_position = Input::get('old_position');
		$post_id = Input::get('post_id');

		//Old postion is bigger then new position, increment position_id.
		if($old_position > $new_position)
		{
		DB::table('playlist_post')
			->where('playlist_id',$playlist->id)
			->where('position_id', '<', $old_position)
			->increment('position_id');
		}
		//Old postion is smaller then new position, increment position_id.
		else
		{
			DB::table('playlist_post')
			->where('playlist_id',$playlist->id)
			->where('position_id', '>=', $old_position)
			->decrement('position_id');
		}

		DB::table('playlist_post')
			->where('playlist_id',$playlist->id)
			->where('post_id', $post_id)
			->update(array('position_id' => $new_position));
	}

	public function copy($id)
	{
		$playlist = Playlist::find($id);

		$id = DB::table('playlists')->insertGetId(
    	array('title' => $playlist->title, 'account_id' => Auth::user()->accountUser()->id));

		foreach($playlist->posts as $post)
		{
			DB::table('playlist_post')->insert(array('post_id' => $post->id, 'playlist_id' => $id));
		}

		if($playlist->account_id != Auth::user()->accountUser()->id)
		{
			
			DB::table('points')->where('account_id',$playlist->account_id)->increment('value');
		}

		if(Auth::user())
		{
			if($playlist->account_id != Auth::user()->accountUser()->id)
			{	
				$account = Account::find($playlist->account_id);
				$user = User::find($account->user->id);
				if($user->accountuser()->points->value < 100)
				{
					DB::table('points')->where('account_id',$user->accountUser()->id)->increment('value');
				}
				else
				{
					if($user->accountuser()->levels->first()->id != 5)
					{
						$user = User::find($post->created_by);
						DB::table('account_level')->where('account_id',$user->accountUser()->id)->increment('level_id');
						DB::table('points')->where('account_id',$user->accountUser()->id)->update(array('value' => 1));
					}

				}
			}
		}
	}
	public function playlistsound()
	{
		$playlist = Playlist::where('id',Input::get('playlistid'))->first();

		$test = array();

		foreach($playlist->posts as $post)
		{
			$test['url'] = $post->soundcloud; 
		}

		return $test;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updatetitle($id)
	{
	
		// Prepare file to be saved into the database.
		$playlist = Playlist::find($id);
		$playlist->title = Input::get('title');
		$playlist->save();

		// If it was an ajax call, pass along the filename and file id
		// as a json array.
		if (Input::get('ajax')) {

			$response = array(
				'title'    => $playlist->title,
				
			);

			return Response::json($response);
		}
		else
		{
			return Redirect::action('PlaylistController@index');	
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$playlist = Playlist::find($id);

		DB::table('playlist_post')
			->where('playlist_id',$playlist->id)
			->delete();

		$delete_playlist = Playlist::find($id);
		$delete_playlist->delete();

		DB::table('notifications')->where('playlist_id',$playlist->id)->delete();

		return Redirect::action('PlaylistController@index');
	}

	public function destroySelected()
	{
		$playlist = Playlist::find(Input::get('playlist'));
		$posts = explode(',', Input::get('removeposts'));
	

		//remove all images that are selected.
		foreach ($posts as $post){

			$playlist = Playlist::find(Input::get('playlist'));

			DB::table('playlist_post')
				->where('playlist_id',$playlist->id)->where('post_id',$post)->delete();
			
		}
  		return Redirect::action('PlaylistController@show',array($playlist->id));
	}

	

}