<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(User $user, Vote $vote)
	{
		$this->user = $user;
		$this->vote = $vote;
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
		//
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
			if(Input::get('facebook'))
			{
				$filename = 'https://graph.facebook.com/'.str_replace(' ', '',Input::get('naam')).'/picture?type=square&height=100';
			}
			if(Input::hasFile('afbeelding'))
			{
				$image = Image::make(Input::file('afbeelding')->getRealPath())->heighten(100);
				$image->crop(100,100);
				$destenation = 'img/'.$filename;
				$image->save($destenation);		
			}
			$this->user->afbeelding= $filename;
			$this->user->password = Hash::make($input['password']);
			$this->user->save();
			$data = array('naam' => Input::get('naam') );
			Mail::send('emails.name',$data, function($message)
			{
			 $message->to(Input::get('email'), Input::get('naam'))->subject("Meal Deal registratie");
			});
		
			if(Input::get('facebook'))
			{
				$code = Input::get('code');
				$facebook = new Facebook(Config::get('facebook'));
			    $uid = $facebook->getUser();
				$profile = new Profile();
		        $profile->uid =$uid;
		        $profile->username = Input::get('naam');
		        $profile = $this->user->profiles()->save($profile);
			}
				 return Redirect::to('/')->with('message', 'U bent succesvol geregistreert');
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
			$userData = Deal::getDealsFromUser($id);
			$userVotedOn =  $this->user->getProfileIdVoted(Auth::id());
			return View::make('users.profile',['userData' => $userData[0],'userVotedOn'=> $userVotedOn]);
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
		$userData = $this->user->getUserData();
		return View::make('users.profielWijzigen',['regions' =>  Region::getAllRegions(),'userData'=> $userData[0]]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$this->user = User::find($id);
		if(Auth::user()->email == Input::get('email'))
		{
			$rules = "editNoEmail";
		}
		else{
			$rules = "edit";
		}
		if( $this->user->fill($input)->isValid($rules))
		{
			if(Input::hasFile('afbeelding'))
			{
				$filename = Auth::user()->naam.".png";
				$image = Image::make(Input::file('afbeelding')->getRealPath())->heighten(100);
				$image->crop(100,100);
				$destenation = 'img/'.$filename;
				$this->user->afbeelding = $filename;
				$image->save($destenation);
			}
				$this->user->afbeelding = Auth::user()->afbeelding;
				$this->user->save();
				return Redirect::to('users/instellingen');
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}
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
	public function vote($id)
	{
		if(Auth::check())
		{
			$profileUserId = $id;
			$userId = Auth::id();

			$this->vote->profileId = $profileUserId;
			$this->vote->userId = $userId;
			$this->vote->save();
			$this->user->addVote($profileUserId);

			return Redirect::back();

		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function instellingen()
	{
		$userData = $this->user->getUserData();
		return View::make('users.instellingen',['userData'=> $userData[0]]);
	}

	public function MakePasswordForm()
	{
		if(Auth::check())
		{
			return View::make('users.changePassword');
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function savePassword()
	{
		$input = Input::all();
		$validation =Validator::make(Input::all(),array(
			'password' => 'min:8',
			'newpassword' => 'min:8'));
		if( $validation->passes())
		{
			$user = User::find(Auth::id());
			$password = Input::get('password');
			$newpassword = Input::get('newpassword');
			$oldPassword = Auth::user()->password;
			if(Hash::check($password,$oldPassword))
			{
				$user->password = Hash::make($newpassword);
				$user->save();
				return View::make('users.changePassword',['id' => Auth::id(),'message' =>'Your password has been changed']);
			}
			else
			{
				return View::make('users.changePassword',['id' => Auth::id(),'message' =>'Your password could not be changed']);
			}
		}	
		else
		{
			return Redirect::back()->withInput()->withErrors($validation->messages())->with('errorsPrecent', true);
		}
	}


}
