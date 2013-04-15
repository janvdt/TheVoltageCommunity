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
}