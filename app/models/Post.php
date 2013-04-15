<?php

class Post extends BaseModel {

	public function image()
	{
		return $this->belongsTo('Image');
	}

	/**
	 * Set polymorphic relationship.
	 */
	public function imageable()
	{
		return $this->morphTo();
	}

	public function createdBy()
	{
		return User::find($this->created_by);
	}
}