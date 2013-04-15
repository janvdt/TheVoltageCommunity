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
			'soundcloud' 	 => Input::get('soundcloud'),
			'created_by'     => Auth::user()->id,
		);


		$post = new Post($new_post);

		$post->image_id = Input::get('image_id') ? Input::get('image_id'): 0;
		
		$post->save();
		
		return Redirect::action('InstanceController@index');	
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
		return View::make('post.music.index')
			->with('post',$post);
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

}