<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable =['naam','password','email','regionId','straatnaam','postcode','gemeente','huisnummer','postbus','info','afbeelding','coins','votes','badge','schoolId'];

	public static $logInRules=[
		'email' => 'required|email',
		'password' => 'required|min:8'
	];

	public static $registerRules=[
		'naam' => 'required|unique:users,naam',
		'email' => 'required|email|unique:users,email',
		'straatnaam' => 'required',
		'postcode' => 'required',
		'gemeente' => 'required',
		'huisnummer' => 'required',
		'info' =>'required',
		'password' => 'required|min:8',
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

	public function isValid($rules)
	{	
		if($rules == "login")
		{
			$validation =Validator::make($this->attributes,static::$logInRules);
		}
		elseif ($rules == "register") {
			$validation =Validator::make($this->attributes,static::$registerRules);
		}

		if($validation->passes()) return true;
		
		$this->errors =$validation->messages();
		return false;
	}
	public static function getRegionId($id)
	{
		return DB::table('users')->select('regionId')->where('id','=',$id)->get();
	}
}
