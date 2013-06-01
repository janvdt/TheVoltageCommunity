<?php

class Message extends BaseModel {

	public function account()
	{
		return $this->belongsTo('Account');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function notifications()
    {
        return $this->hasMany('Notification');
    }
}