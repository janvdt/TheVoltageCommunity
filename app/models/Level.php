<?php

class Level extends BaseModel {

	public function accounts()
	{
		return $this->belongsToMany('Account');
	}

}