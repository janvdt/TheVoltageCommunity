<?php

class FeedbackController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$feedbacks = Feedback::orderBy('id','desc')->paginate(4);
		
		return View::make('feedback.index')
			->with('feedbacks',$feedbacks);
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
		$feedback = new Feedback;
		$feedback->text = Input::get('textcomment');
		$feedback->account_id = Auth::user()->accountUser()->id;

		$feedback->save();

		// If it was an ajax call, pass along the filename and file id
		// as a json array.
		if (Input::get('ajax')) {

			$response = array(
				'user_id'    => Auth::user()->id,
				'body' => $feedback->text,
				'id'    => $feedback->id,
				'date'  => $feedback->created_at,
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