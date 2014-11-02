<?php

class Vote extends Eloquent{

	protected $fillable =['profileId','userId'];

	public function profile()
	{
		return $this->belongsTo('User','profileId');
	}

	public function user()
	{
		return $this->belongsTo('User','userId');
	}

}
