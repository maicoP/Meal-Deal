<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable =['username','password','email','info','image'];

	public static $logInRules=[
		'email' => 'required|email',
		'password' => 'required|min:8'
	];

	public static $registerRules=[
		'username' => 'required|unique:users,username',
		'email' => 'required|email|unique:users,email',
		'info' =>'required',
		'password' => 'required|min:8',
		'image' => 'image|max:250|mimes:jpg,jpeg,bmp,png,gif'
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

	public function getUserId()
	{
		return Auth::user()->id;
	}
}
