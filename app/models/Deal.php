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
	public function porties()
	{
		 return $this->hasMany('Portie','dealId');
	}

	public function user()
	{
		 return $this->belongsTo('User','verkoperId');
	}

	public function isValid()
	{
		$validation =Validator::make($this->attributes,static::$rules);

		if($validation->passes()) return true;
		
		$this->errors =$validation->messages();
		return false;
	}

	public function getMyDealsBeschikbaar()
	{
		// return DB::table('porties')
		// 				->join('deals','deals.id', '=','porties.dealId')
		// 				->select('deals.*','porties.*')
		// 				->where('porties.verkoperId','=',Auth::id())
		// 				->where('status','=','beschikbaar')
		// 				->orderBy('deals.created_at','DESC')
		// 				->get();
		return Portie::with(array('deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->where('verkoperId','=',Auth::id())
						->where('status','=','beschikbaar')
						->get();
	}
	public function getMyDealsVerkopen()
	{
		return Portie::with(array('koper','deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->where('status','=','aangevraagt')
						->where('verkoperId','=',Auth::id())
						->orWhere('status', 'geaccepteert')
						->where('.verkoperId','=',Auth::id())
						->get();
	}

	public function getMyDealsKopen()
	{
		return Portie::with(array('verkoper','deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->where('status','=','aangevraagt')
						->where('koperId','=',Auth::id())
						->orWhere('status', 'geaccepteert')
						->where('.koperId','=',Auth::id())
						->get();
	}

	public static function getDealsFromUser($id)
	{
		return User::with(array('Deal' => function($q){
							$q->orderBy('deals.created_at','DESC');
						}))->where('naam','=',$id)
						->get();
	}

	public static function getDealByRegion($id)
	{
		return DB::table('deals')
						->join('users','users.id', '=','deals.verkoperId')
						->join('regions','users.regionId','=','regions.id')
						->where('regions.id','=',$id)
						->where('beschikbaar','=',true)
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
						->where('beschikbaar','=',true)
						->select('deals.*','users.naam','users.postcode','users.gemeente','users.straatnaam','users.postbus','users.huisnummer','users.afbeelding')
						->orderBy('deals.created_at','DESC')
						->get();
	}

}