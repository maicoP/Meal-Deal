<?php

class Deal extends Eloquent{

	protected $fillable =['gerecht','afbeeldingdeal','dealeinde','afhaaluur','afhalen','beschikbaar','porties','verkoperId'];

	public static $rules=[
		'gerecht' =>	'required',
		'dealeinde'	=>	'required',
		'afhaaluur'	=>	'required',
		'porties' => 'required',
		'afbeeldingdeal' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif',
		'afhalen'	=>	'required',
	];

	public $errors;

	public function isValid()
	{
		$validation =Validator::make($this->attributes,static::$rules);

		if($validation->passes()) return true;
		
		$this->errors =$validation->messages();
		return false;
	}

	public static function getDeals()
	{
		return DB::table('deals')
						->join('users','users.id', '=','deals.verkoperId')
						->select('deals.*','users.naam','users.postcode','users.gemeente','users.straatnaam','users.postbus','users.huisnummer','users.afbeelding')
						->orderBy('deals.created_at','DESC')
						->get();
	}

	public static function getDealsFromUser($id)
	{
		return DB::table('users')
						->join('deals','deals.verkoperId', '=','users.id')
						->select('deals.*')
						->orderBy('deals.created_at','DESC')
						->where('users.naam','=',$id)
						->get();
	}

	public static function getDealByRegion($id)
	{
		return DB::table('deals')
						->join('users','users.id', '=','deals.verkoperId')
						->join('regions','users.regionId','=','regions.id')
						->where('regions.id','=',$id)
						->select('deals.*','users.naam','users.postcode','users.gemeente','users.straatnaam','users.postbus','users.huisnummer','users.afbeelding')
						->orderBy('deals.created_at','DESC')
						->get();
	}

	public static function getDealByAfhaalMethode($afhalen,$id)
	{
		return DB::table('deals')
						->join('users','users.id', '=','deals.verkoperId')
						->join('regions','users.regionId','=','regions.id')
						->where('regions.id','=',$id)
						->where('deals.afhalen','=',$afhalen)
						->select('deals.*','users.naam','users.postcode','users.gemeente','users.straatnaam','users.postbus','users.huisnummer','users.afbeelding')
						->orderBy('deals.created_at','DESC')
						->get();
	}

}