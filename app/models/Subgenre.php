<?php

class Subgenre extends BaseModel {

	public function genres()
	{
		return $this->belongsToMany('Genre');
	}
}