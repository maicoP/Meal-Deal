<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable =['naam','password','email','regionId','straatnaam','postcode','gemeente','huisnummer','postbus','info','afbeelding','coins','votes','badge','schoolId'];


	public static $registerRules=[
		'naam' => 'unique:users,naam',
		'email' => 'unique:users,email',
		'password' => 'min:8',
		'afbeelding' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif'
	];

	public static $editRules=[
		'email' => 'email|unique:users,email',
		'afbeelding' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif'
	];
	public static $editRulesNoEmail=[
		'afbeelding' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif'
	];
	

	public $errors;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	public function deal()
	{
		return $this->hasMany('Deal','verkoperId');
	}
	public function region()
	{
		return $this->belongsTo('Region','regionId');
	}
	public function vote()
	{
		return $this->belongsTo('Vote','userId');
	}
	public function profiles()
    {
        return $this->hasMany('Profile');
    }
	public function isValid($rules)
	{	
		if($rules == "register")
		{
			$validation =Validator::make($this->attributes,static::$registerRules);
		}
		elseif($rules == "edit")
		{
			$validation =Validator::make($this->attributes,static::$editRules);
		}
		elseif($rules == "editNoEmail")
		{
			$validation =Validator::make($this->attributes,static::$editRulesNoEmail);
		}

		

		if($validation->passes()) return true;
		
		$this->errors =$validation->messages();
		return false;
	}
	public static function getRegionId($id)
	{
		return DB::table('users')->select('regionId')->where('id','=',$id)->get();
	}

	public function getUserData()
	{
		return User::with('Region')->where('users.id','=',Auth::id())
								->get();
	}

	public function addCoin($id)
	{
		User::where('id','=',$id)->increment('coins');
	}

	public function deleteCoin($id)
	{
		User::where('id','=',$id)->decrement('coins');
	}

	public function addVote($userId)
	{
		User::where('id','=',$userId)->increment('votes');
	}

	public function getAantalAanvragen($id)
	{
		return Portie::where('koperId','=',$id)
						->where('status','=','aangevraagt')
						->count();
	}

	public function getProfileIdVoted($userId)
	{	
		$results = Vote::select('profileId')
					->where('userId','=',$userId)
		 			->get();

		$postVotedOn = array();
		foreach($results as $result)
		{
			$postVotedOn[]= $result->profileId;
		}
		return $postVotedOn;
	}
}
