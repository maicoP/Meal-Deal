<?php

class Comment extends Eloquent{

	protected $fillable =['comment','postId','userId'];
	
	public static $rules=[
		'comment' =>	'required',
	];

	public $errors;

	public function isValid()
	{
		$validation =Validator::make($this->attributes,static::$rules);

		if($validation->passes()) return true;
		
		$this->errors =$validation->messages();
		return false;
	}

	public static function getPostComments($id)
	{
		return DB::table('comments')
						->join('users','comments.userId','=','users.id')
						->select('comments.*','users.username','users.image')
						->where('postId','=',$id)
						->orderBy('created_at','DESC')
						->get();
	}


}
