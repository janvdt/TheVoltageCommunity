<?php

class TurntableController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$musicposts = Post::where('soundcloud','!=', NULL)->where('soundcloud_art','!=',NULL)->where('type','music')->where('soundcloud_id','!=',0);

		$musicposts = $musicposts->paginate(8);
		return View::make('diy.index')
			->with('musicposts',$musicposts);
	}

	public function search()
	{
		/* The search input from user ** passed from jQuery .get() method */
    	$param = Input::get("searchData");

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $musicposts = Post::where('type','music')->where('title', 'LIKE', '%' . $param . '%')->where('soundcloud_id','!=',0)->orderBy('created_at', 'desc')->get();

        

        foreach($musicposts as $musicpost)
        {
        	$musicpost['firstname'] = $musicpost->createdBy()->first_name;
        	$musicpost['soundcloudid'] = $musicpost->soundcloud_id;
        	$musicpost['lastname'] = $musicpost->createdBy()->last_name;
        	$musicpost['userid'] = $musicpost->createdBy()->id;
        	if($musicpost->createdBy()->accountUser()->facebookpic != NULL)
        	{
        		$musicpost['image'] = $musicpost->createdBy()->accountUser()->facebookpic;
        	}
        	else
        	{
        		$musicpost['image'] = $musicpost->createdBy()->accountUser()->getImagePathname();
        	}
        	$test[] = $musicpost->toArray();

        }
      	return $test;
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