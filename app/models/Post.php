<?php

class Post extends Eloquent{

	protected $fillable =['title','url','info','userId'];

	public static $rules=[
		'title' =>	'required',
		'url'	=>	'required',
	];

	public $errors;

	public function isValid()
	{
		$validation =Validator::make($this->attributes,static::$rules);

		if($validation->passes()) return true;
		
		$this->errors =$validation->messages();
		return false;
	}

	public static function getAllPosts()
	{
		return DB::table('posts')
						->join('users','posts.userId', '=','users.id')
						->select('posts.*','users.username','users.image')
						->orderBy('posts.created_at','DESC')
						->get();
		
	}

	public static function voteOnPost($postId)
	{
		DB::table('posts')->where('id','=',$postId)->increment('votes');
	}

	public static function getTopPosts()
	{
		return DB::table('posts')
						->join('users','posts.userId', '=','users.id')
						->select('posts.*','users.username','users.image')
						->orderBy('votes','desc')
						->take(10)
						->get();
	}

	public static function getPostsFromUser($id)
	{
		return DB::table('posts')
						->join('users','posts.userId', '=','users.id')
						->select('posts.*','users.username','users.image')
						->orderBy('posts.created_at','DESC')
						->where('users.id','=',$id)
						->get();
	}

	public static function getPostById($id)
	{
		return DB::table('posts')
						->join('users','posts.userId', '=','users.id')
						->select('posts.*','users.username','users.image')
						->where('posts.id','=',$id)
						->get();
	}

}