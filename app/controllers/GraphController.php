<?php

class GraphController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$graphposts = Post::where('type','graph')->orderBy('created_at', 'desc');

		$graphposts = $graphposts->paginate(4);
		return View::make('graph.index')
			->with('graphposts',$graphposts);
	}

	public function search()
	{
		/* The search input from user ** passed from jQuery .get() method */
    	$param = Input::get("searchData");

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $graphposts = Post::where('type','graph')->where('title', 'LIKE', '%' . $param . '%')->orderBy('created_at', 'desc')->get();

        

        foreach($graphposts as $graphpost)
        {
        	$graphpost['firstname'] = $graphpost->createdBy()->first_name;
        	$graphpost['lastname'] = $graphpost->createdBy()->last_name;
        	$graphpost['userid'] = $graphpost->createdBy()->id;
        	$graphpost['imagegraph'] = $graphpost->image->getSize('original')->getPathname();
        	if($graphpost->createdBy()->accountUser()->facebookpic != NULL)
        	{
        		$graphpost['image'] = $graphpost->createdBy()->accountUser()->facebookpic;
        	}
        	else
        	{
        		$graphpost['image'] = $graphpost->createdBy()->accountUser()->getImagePathname();
        	}
        	$test[] = $graphpost->toArray();

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