<?php

class Comment extends BaseModel {

	public function post()
	{
		return $this->belongsTo('Post');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function comments()
	{
		return $this->hasMany('Comment', 'parent');
	}

	public function hasParent($parent)
	{
		$comment = $this;

		while ($comment->parent) {
			if ($comment->parent == $parent) {
				return true;
		}

			 $comment = Comment::find($comment->parent);
		}

		return false;
	}
}