<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(User $user, Vote $vote,Deal $deal)
	{
		$this->user = $user;
		$this->vote = $vote;
		$this->deal = $deal;
	}
	
	public function index()
	{
		return user::getNotifications();
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
				$code = Input::get('code');
				$facebook = new Facebook(Config::get('facebook'));
			    $me = $facebook->api('/me');
				$filename = 'https://graph.facebook.com/'.$me['id'].'/picture?type=square&height=300';
			}
			if(Input::hasFile('afbeelding'))
			{
				$filename = Input::get('naam').'.png';
				$image = Image::make(Input::file('afbeelding')->getRealPath())->heighten(300);
				$image->crop(300,300);
				$destenation = 'img/'.$filename;
				$image->save($destenation);		
			}
			$this->user->naam = htmlspecialchars(Input::get('naam'));
			$this->user->email = htmlspecialchars(Input::get('email'));
			$this->user->straatnaam = htmlspecialchars(Input::get('straatnaam'));
			$this->user->postcode = htmlspecialchars(Input::get('postcode'));
			$this->user->gemeente = htmlspecialchars(Input::get('gemeente'));
			$this->user->huisnummer = htmlspecialchars(Input::get('huisnummer'));
			$this->user->postbus = htmlspecialchars(Input::get('postbus'));
			$this->user->info = htmlspecialchars(Input::get('info'));
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
			$userDeals = $this->deal->getDealsFromUser($id);
			$user= $this->user->getUserByNaam($id);
			$userId = Auth::id();
			$userVotedOn =  $this->user->getProfileIdVoted($userId);
			$dealsVerkocht = $this->user->dealsVerkocht($userId);
			$dealsGekocht = $this->user->dealsGekocht($userId);
			return View::make('users.profile',['userDeals' => $userDeals,'user' => $user,'userVotedOn'=> $userVotedOn,'dealsVerkocht' => $dealsVerkocht,'dealsGekocht' => $dealsGekocht]);
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
		if(Auth::check())
		{
			$userData = $this->user->getUserData();
			return View::make('users.profielWijzigen',['regions' =>  Region::getAllRegions(),'schools' => School::getAllSchools(),'userData'=> $userData]);
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Auth::check())
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
					$this->user->afbeelding = Auth::user()->afbeelding;
				if(Input::hasFile('afbeelding'))
				{
					$filename = Auth::user()->naam.".png";
					$image = Image::make(Input::file('afbeelding')->getRealPath())->heighten(300);
					$image->crop(300,300);
					$destenation = 'img/'.$filename;
					$this->user->afbeelding = $filename;
					$image->save($destenation);
				}
					$this->user->save();
					return Redirect::to('user/instellingen');
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($this->user->errors);
			}
		}
		else
		{
			return Redirect::to('/');
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
		if(Auth::check())
		{
			$userData = $this->user->getUserData();
			$userDeals = $this->deal->getDealsFromUser(Auth::user()->naam);
			$userId = Auth::id();
			$dealsVerkocht = $this->user->dealsVerkocht($userId);
			$dealsGekocht = $this->user->dealsGekocht($userId);
			return View::make('users.instellingen',['userDeals' => $userDeals,'userData'=> $userData,'dealsVerkocht' => $dealsVerkocht,'dealsGekocht' => $dealsGekocht]);
		}
		else
		{
			return Redirect::to('/');
		}
		
	}

	public function profielen()
	{
		if(Auth::check())
		{
			$topUsers = $this->user->getTopUsers();
			return View::make('users.profiles',['title' => 'Top mealdealers','users' => $topUsers,'zoekString' => null]);	
		}
		else
		{
			return Redirect::to('/');
		}		

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
	public function filter()
	{
		if(Auth::check())
		{
			$zoekString = Input::get('zoekString');
			$zoekString = htmlspecialchars($zoekString);
			$zoekResult = $this->user->filterByName($zoekString);
			return View::make('users.profiles',['title' => 'Zoekresultaten voor '.$zoekString,'users' => $zoekResult,'zoekString' => $zoekString]);
		}
		else
		{
			return Redirect::to('/');
		}
	}
	public function savePassword()
	{
		if(Auth::check())
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
		else
		{
			return Redirect::to('/');
		}
	}


}
