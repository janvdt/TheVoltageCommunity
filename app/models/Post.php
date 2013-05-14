<?php

class Post extends BaseModel {

	public function image()
	{
		return $this->belongsTo('Image');
	}

	/**
	 * Set polymorphic relationship.
	 */
	public function imageable()
	{
		return $this->morphTo();
	}

	public function createdBy()
	{
		return User::find($this->created_by);
	}

	public function likes()
	{
		return $this->hasMany('Like','post_id');
	}

    public function can($post_id,$user_id)
	{
			//Itterate over each permission from a role
			foreach($this->likes as $like)
			{
				//Check if a permission was found.
				if($post_id === $like->post_id)
				{
					// Or if a specified value was matched.
					if($user_id ===$like->user_id)return false;
				}
			}
		
		return true;
	}

	public function comments()
    {
        return $this->hasMany('Comment');
    }
    public function notifications()
    {
        return $this->hasMany('Notification');
    }
 
}