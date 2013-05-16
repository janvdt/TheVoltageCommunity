<?php

class MusicController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$musicposts = Post::where('type','music')->orderBy('created_at', 'desc');

		$soundclouds = Post::where('soundcloud','!=', NULL)->where('soundcloud_art','!=',NULL)->where('type','music')->get();

		foreach($soundclouds as $soundcloud)
		{
			$soundcloudsurl[] = $soundcloud->soundcloud;
		}

		
		$dbgenres = DB::table('genres')->select('title')->get();

		//$dbmodels = Businesscardmodel::all();
		$genres = array();

		foreach ($dbgenres as $genre) {
			$genres[$genre->title] = $genre->title;
		}

		$musicposts = $musicposts->paginate(8);
		return View::make('music.index')
			->with('musicposts',$musicposts)
			->with('genres',$genres)
			->with('soundcloudsurl',$soundcloudsurl);
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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