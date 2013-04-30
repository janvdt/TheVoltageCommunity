<?php

class Like extends BaseModel {

	public function post()
    {
        return $this->belongsTo('Post');
    }
}