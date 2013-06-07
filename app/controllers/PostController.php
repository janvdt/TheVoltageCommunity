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

		$genresdata = Genre::all();



		//Get tags that belong to images
		$genresdata = DB::table('genres')->whereExists(function($query){
				$query->select(DB::raw('*'))
					->from('genre_post')
					->whereRaw('genre_post.genre_id = genres.id');
			})
			->lists('title', 'id');


		//transform the $tagsdata array.
		array_walk($genresdata, function (&$item, $key) {
		$item = array("id"=>$item,"text"=>$item);
		});

		$subgenresdata = Subgenre::all();

		//Get tags that belong to images
		$subgenresdata = DB::table('subgenres')->whereExists(function($query){
				$query->select(DB::raw('*'))
					->from('subgenre_genre')
					->whereRaw('subgenre_genre.subgenre_id = subgenres.id');
			})
			->lists('title', 'id');


		//transform the $tagsdata array.
		array_walk($subgenresdata, function (&$item, $key) {
		$item = array("id"=>$item,"text"=>$item);
		});

		$images = Image::orderBy('created_at', 'desc')->where('profile',FALSE)->take(10)->get();
		return View::make('post.music.create')
			->with('images',$images)
			->with('genresdata', $genresdata)
			->with('subgenresdata', $subgenresdata);
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
				'genre'         => 'required',  
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$new_post = array(
			'title'          => stripslashes(Input::get('title')),
			'body'           => Input::get('body'),
			'type'			 => Input::get('type'),
			'soundcloud' 	 => Input::get('soundcloud-hidden'),
			'youtube' 	 	 => Input::get('youtube-hidden'),
			'created_by'     => Auth::user()->id,
		);


		$post = new Post($new_post);
		
		if(Input::has('art_urlsoundcloud'))
		{
			$post->soundcloud_art = Input::get('art_urlsoundcloud');
			$post->soundcloud_id = Input::get('soundcloudid-hidden');
		}
		if(Input::has('art_urlyoutube'))
		{
			$post->youtube_art = Input::get('art_urlyoutube');
		}
		else{
		$post->image_id = Input::get('image_id') ? Input::get('image_id'): 0;
		}
		
		$post->save();


		DB::table('notifications')->insert(array('body' => "created a post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => Auth::user()->id,'activity' => 1,'created_at' => $post->created_at,'type' => 1));

		//Decode json object.
		$inputgenre = Input::get('genre');

		if($inputgenre != NULL){
		
			$genre = Genre::where('title',$inputgenre)->first();
			//When no genre is found.
			if($genre != NULL){
			
			DB::table('genre_post')
				->insert(array('post_id' => $post->id, 'genre_id' => $genre->id));
			}
		}

		// validate if the number of tags exceeds the allowed to be chosen
		if (count(Input::get('subgenres')) > 3) {
			return Redirect::back()->with_errors(array('Sorry, you can only pick 3 maximum tags'));
		}

		//Decode json object.
		$obj2 = json_decode(stripslashes(Input::get('subgenre-hidden')));


		if($obj2 != NULL){

		foreach($obj2->val as $val){
			$subgenre = Subgenre::where('title',$val)->first();
			//When no genre is found.
			if($subgenre != NULL){
			
			DB::table('subgenre_genre')
				->insert(array('genre_id' => $genre->id, 'subgenre_id' => $subgenre->id, 'post_id' => $post->id));
			}
			else
			{
				DB::table('subgenres')
				->insert(array('title' => $val));

				$subgenre = Subgenre::where('title',$val)->first();

				DB::table('subgenre_genre')
				->insert(array('genre_id' => $genre->id, 'subgenre_id' => $subgenre->id,'post_id' => $post->id));
			}
		}
		}
		else
		{

			$subgenre = Subgenre::where('title',Input::get('subgenre-hidden'))->first();
			//When no genre is found.
			if($subgenre != NULL){
			
			DB::table('subgenre_genre')
				->insert(array('genre_id' => $genre->id, 'subgenre_id' => $subgenre->id,'post_id' => $post->id));
			}
			else
			{
				DB::table('subgenres')
				->insert(array('title' => Input::get('subgenre-hidden')));

				$subgenre = Subgenre::where('title',Input::get('subgenre-hidden'))->first();

				DB::table('subgenre_genre')
				->insert(array('genre_id' => $genre->id, 'subgenre_id' => $subgenre->id, 'post_id' => $post->id));
			}
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

		DB::table('notifications')->insert(array('body' => "created a post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => Auth::user()->id,'activity' => 1,'created_at' => $post->created_at,'type' => 6));
		
		return Redirect::action('GraphController@index');;	
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

		DB::table('posts')->where('id',$id)->increment('views');

		if(Auth::user())
		{
			DB::table('notifications')->where('user_id','!=',Auth::user()->id)->where('post_id',$post->id)->update(array('viewed' => 1));
		}
		if(Auth::user())
		{
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

		DB::table('posts')->where('id',$id)->increment('views');

		if(Auth::user())
		{
			DB::table('notifications')->where('user_id','!=',Auth::user()->id)->where('post_id',$post->id)->update(array('viewed' => 1));
		}

		if(Auth::user())
		{
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

		$genresdata = Genre::all();

		//Get tags that belong to images
		$genresdata = DB::table('genres')->whereExists(function($query){
				$query->select(DB::raw('*'))
					->from('genre_post')
					->whereRaw('genre_post.genre_id = genres.id');
			})
			->lists('title', 'id');

		//transform the $tagsdata array.
		array_walk($genresdata, function (&$item, $key) {
		$item = array("id"=>$item,"text"=>$item);
		});

		//Return the tags that belong to that image.
		$selectedgenres =   implode(',', $post->getGenresArray());
		return View::make('post.music.edit')
			->with('post',$post)
			->with('selectedgenres',$selectedgenres)
			->with('genresdata',$genresdata);
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

		//decode json object.
		$obj = json_decode(stripslashes(Input::get('genre-hidden')));

		// When object is empty.
		if($obj == NULL)
		{
			$genre = Genre::where('title', Input::get('genre-hidden'))->first();

			//delete tags from the specific image
			DB::table('genre_post')
				->where('post_id',$post->id)
				->delete();

			DB::table('genres')
				->insert(array('title' => Input::get('genre-hidden')));

				$genre = Genre::where('title',Input::get('genre-hidden'))->first();

				DB::table('genre_post')
				->insert(array('post_id' => $post->id, 'genre_id' => $genre->id));
		}
		else
		{
			//delete tags from the specific image
			DB::table('genre_post')
					->where('post_id',$post->id)
					->delete();

			foreach($obj->val as $val){
					
				$genre= Genre::where('title',$val)->first();
	
				if($genre != NULL){
					
					//when tag exists add to image tag pivot table.
					DB::table('genre_post')
						->insert(array('post_id' => $post->id, 'genre_id' => $genre->id));
				}
				else
				{
					//insert tag first in tags table
					DB::table('genres')
						->insert(array('title' => $val));
	
					$genre = Genre::where('title',$val)->first();
					
					// Then insert values in image tag pivot table.
					DB::table('genre_post')
						->insert(array('post_id' => $post->id, 'genre_id' => $genre->id));
				}
			}
		}

		return Redirect::action('PostController@showMusic', array($post->id));
	}

	public function editGraph($id)
	{
		$post = Post::find($id);

		//Return the tags that belong to that image.
		return View::make('post.graph.edit')
			->with('post',$post);
	}

	public function updateGraph($id)
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

		return Redirect::action('PostController@showGraph', array($post->id));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		DB::table('posts')->where('id',$id)->delete();

		DB::table('comments')->where('post_id',$id)->delete();

		DB::table('notifications')->where('post_id',$id)->delete();

		return Redirect::back();
	}

	public function destroySelected()
	{

		$posts = explode(',', Input::get('removeposts'));
	

		//remove all images that are selected.
		foreach ($posts as $post){

			DB::table('posts')
				->where('id',$post)->where('created_by',Auth::user()->id)->delete();

			DB::table('notifications')->where('post_id',$post)->delete();
			
		}
  		return Redirect::action('AccountController@visitmusicposts',array(Auth::user()->id));
	}


	public function destroygraphSelected()
	{

		$posts = explode(',', Input::get('removeposts'));
	

		//remove all images that are selected.
		foreach ($posts as $post){

			DB::table('posts')
				->where('id',$post)->where('created_by',Auth::user()->id)->delete();

			DB::table('notifications')->where('post_id',$post)->delete();
			
		}
  		return Redirect::action('AccountController@visitgraphposts',array(Auth::user()->id));
	}

	public function like($id)
	{
		$post = Post::find($id);

		Like::insert(array('post_id' => $post->id,'user_id' => Auth::user()->id));

		DB::table('posts')->where('id',$post->id)->increment('postlikes');
		
		Notification::insert(array('body' => "liked your post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => $post->created_by,"type" => 3,'created_at' => date("Y-m-d H:i:s")));
		
		if($post->created_by != Auth::user()->id){
		Notification::insert(array('body' => "liked a post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => $post->created_by,'activity' => 1, 'type' => 3,'created_at' => date("Y-m-d H:i:s")));
		}

		if(Auth::user())
		{
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
	public function share($id)
    {
    	$socialAuth = new Hybrid_Auth('../app/config/hybridauth.php');

    	$facebook = $socialAuth->authenticate( "Facebook" );

    	$post = Post::find($id);
   		
   		if($post->soundcloud_art != NULL){
   		$facebook->api()->api("/me/feed", "post", array(
      	"message" => "I just shared a post from the Voltage Community",
      	"picture" => "$post->soundcloud_art",
      	"link"    => "http://www.thevoltagecommunity.com/post/showmusic/$post->id/",
      	"name"    => "$post->title",
      	"caption" => Input::get('textshare')
   		));
   		}
   		else
   		{
   			$facebook->api()->api("/me/feed", "post", array(
      	"message" => "I just shared a post from the Voltage Community",
      	"picture" => "$post->youtube_art",
      	"link"    => "http://www.thevoltagecommunity.com/post/showmusic/$post->id/",
      	"name"    => "$post->title",
      	"caption" => Input::get('textshare')
   		));
   		}

   		if(Auth::user())
		{
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

   		return Redirect::action('PostController@showMusic', array('id' => $post->id));

	}
	public function showGenre()
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
			if($soundcloud->genrescheck(Input::get('type'))){
			$soundcloudsurl[] = $soundcloud->soundcloud;
			}
		}

		$subgenresdata = Subgenre::where('title','!=','object');
		
		$genre = Genre::where('title',Input::get('type'))->first();
		
		if($subgenresdata != NULL and $genre != NULL )
		{
		//Get tags that belong to an image.
		$subgenresdata = $subgenresdata->whereExists(function($query){
				$genre = Genre::where('title',Input::get('type'))->first();
				$query->select(DB::raw('*'))
					  ->from('subgenre_genre')
					  ->where('subgenre_genre.genre_id',$genre->id)
					  ->whereRaw('subgenre_genre.subgenre_id = subgenres.id');
		})
		->lists('title', 'id');
		}



		$type = Input::get('type');

		return View::make('post.genre.index')
			->with('genres',$genres)
			->with('musicposts',$musicposts)
			->with('type',$type)
			->with('soundcloudsurl',$soundcloudsurl)
			->with('subgenresdata',$subgenresdata);
	}
	public function showSubGenre()
	{
		$musicposts = Post::where('type','music')->get();
		
		$type = Input::get('type');

		$dbgenres = DB::table('genres')->select('title')->get();

		$genres = array();

		foreach ($dbgenres as $genre) {
			$genres[$genre->title] = $genre->title;
		}

		$soundclouds = Post::where('soundcloud','!=', NULL)->where('soundcloud_art','!=',NULL)->where('type','music')->get();

		$soundcloudsurl = array();
		foreach($soundclouds as $soundcloud)
		{
			if($soundcloud->subgenrescheck($soundcloud->id,$type)){
			$soundcloudsurl[] = $soundcloud->soundcloud;
			}
		}

		$genre = Input::get('genre');
		
		return View::make('post.genre.subgenre.index')
			->with('genres',$genres)
			->with('musicposts',$musicposts)
			->with('type',$type)
			->with('soundcloudsurl',$soundcloudsurl)
			->with('genre',$genre);
	}
	public function addplaylist()
	{
		$playlist = Playlist::find(Input::get('playlistid'));

		DB::table('playlist_post')->insert(array('playlist_id' => $playlist->id,'post_id' => Input::get('postid')));

		//Update position of the images
		DB::table('playlist_post')
			->where('playlist_id', $playlist->id)
			->where('position_id', '>=', 0)
			->update(array('position_id' => DB::raw('position_id + 1')));
		

		return $id;
	}
}