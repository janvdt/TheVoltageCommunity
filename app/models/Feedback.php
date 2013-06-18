<?php

class Feedback extends BaseModel {

	public function account()
	{
		return $this->belongsTo('Account');
	}

}