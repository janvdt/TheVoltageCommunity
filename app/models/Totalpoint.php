<?php

class Totalpoint extends BaseModel {

	public function account()
	{
		return $this->hasOne('Account');
	}

}