<?php

class MusicController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$musicposts = Post::where('type','music')->orderBy('id', 'desc');

		$soundclouds = Post::where('soundcloud_id','!=', 0)->where('type','music')->get();

		$soundcloudsurl = array();
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

		$musicposts = $musicposts->paginate(4);
		return View::make('music.index')
			->with('musicposts',$musicposts)
			->with('genres',$genres)
			->with('soundcloudsurl',$soundcloudsurl);
	}
	public function myTaste()
	{
		$musicposts = Post::where('type','music')->get();
		$dbgenres = DB::table('genres')->select('title')->get();

		//$dbmodels = Businesscardmodel::all();
		$genres = array();

		foreach ($dbgenres as $genre) {
			$genres[$genre->title] = $genre->title;
		}

		$soundclouds = Post::where('soundcloud','!=', NULL)->where('soundcloud_art','!=',NULL)->where('type','music')->get();
		$soundcloudsurl = array();
		foreach($soundclouds as $soundcloud)
		{
			if($soundcloud->tastescheck(Auth::user()->accountuser()->id)){
			$soundcloudsurl[] = $soundcloud->soundcloud;
			}
		}

		return View::make('music.mytaste')
			->with('genres',$genres)
			->with('soundcloudsurl',$soundcloudsurl)
			->with('musicposts',$musicposts);
	}
	public function search()
	{
		/* The search input from user ** passed from jQuery .get() method */
    	$param = Input::get("searchData");

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $musicposts = Post::where('type','music')->where('title', 'LIKE', '%' . $param . '%')->orderBy('created_at', 'desc')->get();

        

        foreach($musicposts as $musicpost)
        {
        	$musicpost['firstname'] = $musicpost->createdBy()->first_name;
        	$musicpost['lastname'] = $musicpost->createdBy()->last_name;
        	$musicpost['userid'] = $musicpost->createdBy()->id;
        	if($musicpost->soundcloud != NULL)
        	{
        		$musicpost['provider'] = $musicpost->soundcloud;
        		$musicpost['class'] = 'stratus';
        		$musicpost['value'] = $musicpost->id;
        		$musicpost['icon'] = 'icon-play';
        		$musicpost['name'] = '';

        	}
        	else
        	{
        		$musicpost['provider'] = '#youtube-post-{{ $musicpost->youtube }}';
        		$musicpost['class'] = 'playyoutube';
        		$musicpost['value'] = $musicpost->youtube;
        		$musicpost['icon'] = 'icon-film';
        		$musicpost['name'] = $musicpost->id;

        	}

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

	public function searchtaste()
	{
		/* The search input from user ** passed from jQuery .get() method */
    	$param = Input::get("searchData");

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $musicposts = Post::where('type','music')->where('title', 'LIKE', '%' . $param . '%')->orderBy('created_at', 'desc')->get();

       

        foreach($musicposts as $musicpost)
        {
        
        	if($musicpost->tastescheck(Auth::user()->accountuser()->id))
        	{
        		$musicpost['firstname'] = $musicpost->createdBy()->first_name;
        	$musicpost['lastname'] = $musicpost->createdBy()->last_name;
        	$musicpost['userid'] = $musicpost->createdBy()->id;
        	if($musicpost->soundcloud != NULL)
        	{
        		$musicpost['provider'] = $musicpost->soundcloud;
        		$musicpost['class'] = 'stratus';
        		$musicpost['value'] = $musicpost->id;
        		$musicpost['icon'] = 'icon-play';
        		$musicpost['name'] = '';

        	}
        	else
        	{
        		$musicpost['provider'] = '#youtube-post-{{ $musicpost->youtube }}';
        		$musicpost['class'] = 'playyoutube';
        		$musicpost['value'] = $musicpost->youtube;
        		$musicpost['icon'] = 'icon-film';
        		$musicpost['name'] = $musicpost->id;

        	}

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
        }
        return $test;
	}

	public function searchgenre()
	{
		/* The search input from user ** passed from jQuery .get() method */
    	$param = Input::get("searchData");

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
       $musicposts = Post::where('type','music')->where('title', 'LIKE', '%' . $param . '%')->orderBy('created_at', 'desc')->get();


        foreach($musicposts as $musicpost)
        {
        
        	if($musicpost->genrescheck(Input::get('type')))
        	{	
        		$musicpost['firstname'] = $musicpost->createdBy()->first_name;
        	$musicpost['lastname'] = $musicpost->createdBy()->last_name;
        	$musicpost['userid'] = $musicpost->createdBy()->id;
        	if($musicpost->soundcloud != NULL)
        	{
        		$musicpost['provider'] = $musicpost->soundcloud;
        		$musicpost['class'] = 'stratus';
        		$musicpost['value'] = $musicpost->id;
        		$musicpost['icon'] = 'icon-play';
        		$musicpost['name'] = '';

        	}
        	else
        	{
        		$musicpost['provider'] = '#youtube-post-{{ $musicpost->youtube }}';
        		$musicpost['class'] = 'playyoutube';
        		$musicpost['value'] = $musicpost->youtube;
        		$musicpost['icon'] = 'icon-film';
        		$musicpost['name'] = $musicpost->id;

        	}

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
        }

        return $test;
	}

	public function searchsubgenre()
	{
		/* The search input from user ** passed from jQuery .get() method */
    	$param = Input::get("searchData");

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
       $musicposts = Post::where('type','music')->where('title', 'LIKE', '%' . $param . '%')->orderBy('created_at', 'desc')->get();


        foreach($musicposts as $musicpost)
        {
        
        	if($musicpost->subgenrescheck($musicpost->id,Input::get('type')))
        	{
        		$musicpost['firstname'] = $musicpost->createdBy()->first_name;
        	$musicpost['lastname'] = $musicpost->createdBy()->last_name;
        	$musicpost['userid'] = $musicpost->createdBy()->id;
        	if($musicpost->soundcloud != NULL)
        	{
        		$musicpost['provider'] = $musicpost->soundcloud;
        		$musicpost['class'] = 'stratus';
        		$musicpost['value'] = $musicpost->id;
        		$musicpost['icon'] = 'icon-play';
        		$musicpost['name'] = '';

        	}
        	else
        	{
        		$musicpost['provider'] = '#youtube-post-{{ $musicpost->youtube }}';
        		$musicpost['class'] = 'playyoutube';
        		$musicpost['value'] = $musicpost->youtube;
        		$musicpost['icon'] = 'icon-film';
        		$musicpost['name'] = $musicpost->id;

        	}

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
        }

        return $test;
	}

	public function listenpoints($id)
	{
		if(Auth::user())
		{
			$post = Post::find($id);
			if($post->created_by != Auth::user()->id)
			{	
				$user = User::find($post->created_by);
				DB::table('totalpoints')->where('account_id',$user->accountUser()->id)->increment('value');
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