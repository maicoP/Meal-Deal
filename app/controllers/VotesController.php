<?php

class VotesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(Vote $vote)
	{
		$this->vote = $vote;
	}

	public function index()
	{
		$results = $this->vote->getPostsVoted(Auth::id());
		return View::make('post.myVotedPosts',['myVotedPosts' => $results]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$userId = Auth::id();
		$postId = Input::get('postId');

		if($this->vote->voted($userId,$postId))
		{
			$allPosts = Post::getAllPosts();
			return View::make('post.home',['posts' => $allPosts, 'postId' => $postId]);	
		}
		else
		{
			$this->vote->postId = $postId;
			$this->vote->userId = $userId;
			$this->vote->save();
			Post::voteOnPost($postId);
			return Redirect::back();			
		}
		
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
