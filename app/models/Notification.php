<?php

class Notification extends BaseModel {


	public function post()
    {
        return $this->belongsTo('Post');
    }

    public function message()
    {
        return $this->belongsTo('Message');
    }

     public function playlist()
    {
        return $this->belongsTo('Playlist');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
    public function followers()
    {
        return $this->belongsTo('Follower');
    }

    public function following($user_id)
	{
		$followers = DB::table('followers')->where('follower_id',$user_id)->get();
		
			foreach($followers as $follower)
			{
				
				//Check if a permission was found.
				if($follower->follower_id === $user_id and $follower->account_id === Auth::user()->accountUser()->id )
				{
					return true;
				}
			}
		
		return false;
	}

}