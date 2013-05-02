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
		$commentModel->save();

		// If it was an ajax call, pass along the filename and file id
		// as a json array.
		if (Input::get('ajax')) {

			$response = array(
				'user_id'    => $commentModel->user_id,
				'body' => $commentModel->body,
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