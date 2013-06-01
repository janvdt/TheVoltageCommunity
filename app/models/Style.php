<?php

class Style extends BaseModel {

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

	public function genres()
    {
        return $this->hasMany('Genre');
    }

}