<?php

class InstanceController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$images = Image::take(4)->get();
		$musicposts = Post::where('type','music')->take(4)->get();
		$graphposts = Post::where('type','graph')->take(4)->get();
		$posts = Post::take(4)->get();

		return View::make('instance.index')
			->with('musicposts',$musicposts)
			->with('graphposts',$graphposts)
			->with('posts',$posts)
			->with('images',$images);
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
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		//
	}

	/**
	 * Search the Instance
	 *
	 * @return Response
	 */
	public function search()
	{
		
	}

}