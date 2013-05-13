<?php

class PostController extends BaseController {

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
		return View::make('post.create');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createMusic()
	{
		$images = Image::orderBy('created_at', 'desc')->where('profile',FALSE)->take(10)->get();
		return View::make('post.music.create')
			->with('images',$images);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeMusic()
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'title'        => 'required',
				'body'         => 'required', 
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		if(Auth::user()){
		$new_post = array(
			'title'          => Input::get('title'),
			'body'           => Input::get('body'),
			'type'			 => Input::get('type'),
			'soundcloud' 	 => Input::get('soundcloud-hidden'),
			'youtube' 	 	 => Input::get('youtube-hidden'),
			'created_by'     => Auth::user()->id,
		);
		}
		else
		{
			$facebooksession = Session::get('hybridAuth');
			$facebookuser = User::where('identifier',$facebooksession->identifier)->first();

			$new_post = array(
			'title'          => Input::get('title'),
			'body'           => Input::get('body'),
			'type'			 => Input::get('type'),
			'soundcloud' 	 => Input::get('soundcloud-hidden'),
			'youtube' 	 	 => Input::get('youtube-hidden'),
			'created_by'     => $facebookuser->id,
		);
		}


		$post = new Post($new_post);
		
		if(Input::has('art_urlsoundcloud'))
		{
			$post->soundcloud_art = Input::get('art_urlsoundcloud');
		}
		if(Input::has('art_urlyoutube'))
		{
			$post->youtube_art = Input::get('art_urlyoutube');
		}
		else{
		$post->image_id = Input::get('image_id') ? Input::get('image_id'): 0;
		}
		
		$post->save();
		if(Auth::user()){

		DB::table('notifications')->insert(array('body' => "created a post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => Auth::user()->id,'activity' => 1));
		}
		else
		{

			DB::table('notifications')->insert(array('body' => "created a post!",'user_id' => $facebookuser->id,'post_id' => $post->id,'post_creator' => $facebookuser->id,'activity' => 1));
		}
		
		return Redirect::action('MusicController@index');	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createGraph()
	{
		$images = Image::orderBy('created_at', 'desc')->where('profile',0)->take(10)->get();
		return View::make('post.graph.create')
			->with('images',$images);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeGraph()
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'title'        => 'required',
				'body'         => 'required',
				'image_id'     => 'integer', 
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$new_post = array(
			'title'          => Input::get('title'),
			'body'           => Input::get('body'),
			'type'			 => Input::get('type'),
			'created_by'     => Auth::user()->id,
		);


		$post = new Post($new_post);

		$post->image_id = Input::get('image_id') ? Input::get('image_id'): 0;
		
		$post->save();
		
		return Redirect::action('InstanceController@index');	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showMusic($id)
	{
		$post = Post::find($id);
		if(Session::has('hybridAuth')){
			$facebooksession = Session::get('hybridAuth');
			$facebookuser = User::where('identifier',$facebooksession->identifier)->first();
		}

		DB::table('posts')->where('id',$id)->increment('views');

		if(Auth::user())
		{
			DB::table('notifications')->where('user_id','!=',Auth::user()->id)->where('post_id',$post->id)->update(array('viewed' => 1));
		}
		else
		{
			DB::table('notifications')->where('user_id','!=',$facebookuser->id)->where('post_id',$post->id)->update(array('viewed' => 1));
		}
		if(Session::has('hybridAuth')){
		return View::make('post.music.index')
			->with('post',$post)
			->with('facebookuser',$facebookuser);
		}
		else
		{
			return View::make('post.music.index')
			->with('post',$post);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showGraph($id)
	{
		$post = Post::find($id);
		return View::make('post.graph.index')
			->with('post',$post);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editMusic($id)
	{
		$post = Post::find($id);
		return View::make('post.music.edit')
			->with('post',$post);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateMusic($id)
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'title'	=> 'required',
				'body'	=> 'required',
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$post = Post::find($id);
		$post->title = Input::get('title');
		$post->body = Input::get('body');

		$post->save();

		return Redirect::action('PostController@showMusic', array($post->id));
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

	public function like($id)
	{
		$post = Post::find($id);

		DB::table('likes')->insert(array('post_id' => $post->id,'user_id' => Auth::user()->id));
		DB::table('posts')->where('id',$post->id)->increment('postlikes');
		
		DB::table('notifications')->insert(array('body' => "liked your post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => $post->created_by));
		
		if($post->created_by != Auth::user()->id){
		DB::table('notifications')->insert(array('body' => "liked a post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => $post->created_by,'activity' => 1));
		}

		return $id;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showLikes($id)
	{
		$post = Post::find($id);

		return View::make('like.index')
			->with('post',$post);
	}
}