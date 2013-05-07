<?php

class Follower extends BaseModel {

	public function account()
    {
        return $this->belongsTo('Account','follower_id');
    }

    public function accountfollower()
    {
        return $this->belongsTo('Account','account_id');
    }
}