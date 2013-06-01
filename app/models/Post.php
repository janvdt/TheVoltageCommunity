<?php

class Post extends BaseModel {


	public function image()
	{
		return $this->belongsTo('Image');
	}
	public function style()
	{
		return $this->belongsTo('Style');
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
    public function genres()
	{
		return $this->belongsToMany('Genre');
	}

	/**
	 * Convert linked tags to key/value array.
	 *
	 * @return void
	 */
	public function getGenresArray()
	{
		$genres = array();

		if (count($this->genres)) {
			foreach ($this->genres as $genre) {
				$genres[] = $genre->title;
			}
		}

		return $genres;
	}
	public function genrescheck($title)
	{
				//Itterate over each permission from a role
				foreach($this->genres as $genre)
				{
					//Check if a permission was found.
					if($title=== $genre->title)
					{
						// Or if a specified value was matched.
						if($title ===$genre->title)return true;
					}
				}
			
			return false;
	}
	public function subgenrescheck($post_id,$type)
	{
			$dbgenre = DB::table('genres')->where('title',Input::get('genre'))->first();
			$dbsubgenre = DB::table('subgenres')->where('title',$type)->first();
			$dbtests = DB::table('subgenre_genre')->where('subgenre_id',$dbsubgenre->id)->where('genre_id',$dbgenre->id)->get();
				//Itterate over each permission from a role
				foreach($dbtests as $subgenre)
				{
					//Check if a permission was found.
					if($post_id=== $subgenre->post_id)
					{
						return true;
					}
				}
			
			return false;
	}
	public function tastescheck($account_id)
	{
		$dbtastes = DB::table('tastes')->where('account_id',$account_id)->get();


		$genresearch = array();

		foreach($this->genres as $genre)
		{
			$genresearch[] = $genre->title;		
		}


		$genrepost = reset($genresearch);

		//Itterate over each permission from a role
		foreach($dbtastes as $taste)
		{
			//Check if a permission was found.
			if($taste->name === $genrepost)
			{

				return true;
			}
					
		}
		return false;
	}
}