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
		return Portie::with(array('deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->where('verkoperId','=',Auth::id())
						->where('status','=','beschikbaar')
						->paginate(3);
	}
	public function getMyDealsVerkopenGeaccepteert()
	{
		return Portie::with(array('koper','deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->Where('status', 'geaccepteert')
						->where('.verkoperId','=',Auth::id())
						->paginate(3);
	}

	public function getMyDealsVerkopenAagevraagt()
	{
		return Portie::with(array('koper','deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->where('status','=','aangevraagt')
						->where('verkoperId','=',Auth::id())
						->paginate(3);
	}

	public function getMyDealsKopen()
	{
		return Portie::with(array('verkoper','deal'=>  function($q){
						$q->orderBy('created_at','DESC');
						}))->where('status','=','aangevraagt')
						->where('koperId','=',Auth::id())
						->orWhere('status', 'geaccepteert')
						->where('.koperId','=',Auth::id())
						->paginate(3);
	}

	public static function getDealsFromUser($id)
	{
		return Deal::whereHas('user',function($q) use($id){
							$q->where('naam','=',$id);
						})->orderBy('deals.created_at','DESC')
						->paginate(5);
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
						->paginate(6);
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
						->paginate(6);
	}

	public function getDealVerkoper($dealId)
	{
		return Deal::has('user')->where('id','=',$dealId)->first();
	}

}