<?php

class Vote extends Eloquent{

	protected $fillable =['postId','userId'];


	public function voted($userId,$postId)
	{	
		$result = Vote::where('userId','=',$userId)
					 ->where('postId','=', $postId)
					 ->get();

		if(count($result) > 0)
		{
			return true;	
		}
		else
		{
			return false;			
		}
	}

	public function getPostsVoted($userId)
	{	
		return DB::table('votes')
					->join('posts','posts.id', '=','votes.postId')
					->join('users','posts.userId', '=','users.id')
					->select('posts.*','users.username','users.image')
					->where('votes.userId','=',$userId)
					->orderBy('posts.created_at','DESC')
					->get();

	}
}