<?php

class Account extends BaseModel {

	public function user()
	{
		return $this->hasOne('User');
	}
	public function image()
	{
		return $this->belongsTo('Image');
	}

	public function imageAccount()
	{
		return Account::find($this->image_id);
	}

	public function getImagePathname($size = 'thumb')
	{
		// If an image was linked.
		if ($image = $this->image)
		{
			return $image->getSize($size)->getPathname();
		}

		// Return placeholder by default.
		return 'http://placehold.it/300x100&text=Profile+image';
	}

	public function followers()
    {
        return $this->hasMany('Follower');
    }

    public function canFollow($account_id,$follower_id)
	{
			$account = Account::find($account_id);
			//Itterate over each permission from a role
			foreach($account->followers as $follower)
			{
				//Check if a permission was found.
				if($account_id === $follower->account_id)
				{
					// Or if a specified value was matched.
					if($follower_id ===$follower->follower_id)return false;
				}
			}
		
		return true;
	}
}