<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function index()
	{
		if(Auth::check())
		{
			return View::make('post.home');
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check())
		{
			return View::make("post.create");
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::check())
		{
			$input = Input::all();

			if( $this->post->fill($input)->isValid())
			{

				$this->post->userId = Auth::user()->id;
				$this->post->save();
				return Redirect::route('posts.index');

			}
			else
			{
				return Redirect::back()->withInput()->withErrors($this->post->errors);
			}
		}
		else
		{
			return Redirect::to('/');
		}	
		
	}

	public function getTopPosts()
	{
		if(Auth::check())
		{
			$topPosts = Post::getTopPosts();
			return View::make('post.topPosts',['posts' => $topPosts]);
		}
		else
		{
			$topPosts = Post::getTopPosts();
			return View::make('topPosts',['posts' => $topPosts]);
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
		if(Auth::check())
		{
			$result = Post::getPostById($id);
			$comment = Comment::getPostComments($id);
			return View::make('post.detail',['post' => $result[0],'comments' => $comment]);
		}
		else
		{
			return Redirect::to('/');
		}
		
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
