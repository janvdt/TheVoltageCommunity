<?php

class Point extends BaseModel {

	public function account()
	{
		return $this->hasOne('Account');
	}

}