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
		return View::make('users.register',['regions' =>  Region::getAllRegions()]);
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
			$filename = 'nofile.png';
			if(Input::hasFile('afbeelding'))
			{
				$filename = Input::file('afbeelding')->getClientOriginalName();
				$image = Image::make(Input::file('afbeelding')->getRealPath())->heighten(100);
				$image->crop(100,100);
				$destenation = 'img/'.$filename;
				$image->save($destenation);
			}
				$this->user->afbeelding= $filename;
				$this->user->password = Hash::make($input['password']);
				$this->user->save();
				Mail::send('emails.name', array('username' => Input::get('username')), function($message)
				{
				 $message->to(Input::get('email'), Input::get('username'))->subject("Meal Deal registratie");
				});
				return Redirect::to('/');
		}
		else
		{
			return Redirect::to('users/create')->withInput()->withErrors($this->user->errors);
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
			$user = $this->user->wherenaam($id)->first();
			$usersDeals = Deal::getDealsFromUser($id);
			return View::make('users.profile',['user' => $user,'deals' => $usersDeals]);
		}
		else
		{
			return View::make('/');
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
