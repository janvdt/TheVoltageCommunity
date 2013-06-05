<?php

class Playlist extends BaseModel {

	public function account()
	{
		return $this->belongsTo('Account');
	}

	public function posts()
	{
		return $this->belongsToMany('Post')->orderBy('playlist_post.position_id', 'asc');
	}

	public function notifications()
    {
        return $this->hasMany('Notification');
    }
}