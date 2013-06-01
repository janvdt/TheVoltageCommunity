<?php

class CommentController extends BaseController {

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
		$validator = Validator::make(
			Input::all(),
			array(
				'textcomment'      => 'required',
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
		$commentModel = new Comment;
		$commentModel->body = Input::get('textcomment');
		$commentModel->post_id = Input::get("post_id");
		$commentModel->user_id = Auth::user()->id;

		$post = Post::find(Input::get("post_id"));
		if(Input::has('comment_id'))
		{
			$commentModel->parent = Input::get('comment_id');	
		}
		$commentModel->save();

		$post = Post::find(Input::get("post_id"));

		
		Notification::insert(array('body' => "commented your post!",'user_id' => Auth::user()->id,'post_id' => $commentModel->post_id,'post_creator' => $post->created_by,'created_at' => $commentModel->created_at,'type' => 2,'text' => Input::get('textcomment') ));
		
		if($post->created_by != Auth::user()->id){
		Notification::insert(array('body' => "commented on a post!",'user_id' => Auth::user()->id,'post_id' => $commentModel->post_id,'post_creator' => $post->created_by,'activity' => 1, 'created_at' => $commentModel->created_at, 'type' => 2, 'text' => Input::get('textcomment')));
		}


		// If it was an ajax call, pass along the filename and file id
		// as a json array.
		if (Input::get('ajax')) {

			$response = array(
				'user_id'    => $commentModel->user_id,
				'body' => $commentModel->body,
				'id'    => $commentModel->id,
				'date'  => $commentModel->created_at,
			);

			return Response::json($response);
		}

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