<?php

class Taste extends BaseModel {

	public function account()
	{
		return $this->hasMany('Account');
	}

}
