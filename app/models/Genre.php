<?php

class Genre extends BaseModel {

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

}