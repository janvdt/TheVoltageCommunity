<?php

class Genre extends BaseModel {

	public function posts()
	{
		return $this->belongsToMany('Post');
	}
	 public function subgenres()
	{
		return $this->belongsToMany('Subgenre');
	}

}