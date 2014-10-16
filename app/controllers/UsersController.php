<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.register');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
		if( $this->user->fill($input)->isValid("register"))
		{
			if(Input::hasFile('image'))
			{
				$filename = Input::file('image')->getClientOriginalName();
				$image = Image::make(Input::file('image')->getRealPath())->heighten(100);
				$image->crop(100,100);
				$destenation = 'img/'.$filename;
				$image->save($destenation);
				$this->user->image = $filename;
				$this->user->password = Hash::make($input['password']);
				$this->user->save();

				return Redirect::to('/');
			}
			else
			{
				$this->user->image = 'no file';
				$this->user->password = Hash::make($input['password']);
				$this->user->save();

				return Redirect::to('/');
			}
			
			
			

		}
		else
		{
			return Redirect::back()->withInput()->withErrors($this->user->errors);
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
			$user = $this->user->whereid($id)->first();
			$usersPosts = Post::getPostsFromUser($id);
			return View::make('users.profile',['user' => $user,'posts' => $usersPosts]);
		}
		else
		{
			$user = $this->user->whereid($id)->first();
			$usersPosts = Post::getPostsFromUser($id);
			return View::make('profile',['user' => $user,'posts' => $usersPosts]);
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
