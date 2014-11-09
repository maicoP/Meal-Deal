<?php

class Deal extends Eloquent{

	protected $fillable =['gerecht','afbeeldingdeal','dealeinde','afhaaluur','afhalen','beschikbaar','porties','verkoperId','beschrijving'];
	public static $rules=[
		'dealeinde'	=>	'date_format:Y-m-d H:i:s',
		'afhaaluur'	=>	'date_format:Y-m-d H:i:s|after:dealeinde',
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
		$now = date('Y-m-d H:i:s');
		return Portie::whereHas('deal',function($q) use($now){
						$q->orderBy('created_at','DESC');
						$q->where('deals.dealeinde','>=',$now);
						})->where('verkoperId','=',Auth::id())
						->where('status','=','beschikbaar')
						->paginate(3);
	}
	public function getMyDealsVerkopenGeaccepteert()
	{
		$now = date('Y-m-d H:i:s');
		return Portie::whereHas('deal',function($q) use($now){
						$q->orderBy('created_at','DESC');
						$q->where('deals.afhaaluur','>=',$now);
						})->with(array('koper'))->Where('status', 'geaccepteert')
						->where('.verkoperId','=',Auth::id())
						->paginate(3);
	}

	public function getMyDealsVerkopenAagevraagt()
	{
		$now = date('Y-m-d H:i:s');
		return Portie::whereHas('deal',function($q) use($now) {
						$q->orderBy('created_at','DESC');
						$q->where('deals.dealeinde','>=',$now);
						})->with(array('koper'))->where('status','=','aangevraagt')
						->where('verkoperId','=',Auth::id())
						->paginate(3);
	}

	public function getMyDealsKopen()
	{
		$now = date('Y-m-d H:i:s');
		return Portie::whereHas('deal', function($q) use($now){
						$q->orderBy('created_at','DESC');
						$q->where('deals.afhaaluur','>=',$now);
						})->with(array('verkoper'))->where('status','=','aangevraagt')
						->where('koperId','=',Auth::id())
						->orWhere('status', 'geaccepteert')
						->whereHas('deal', function($q) use($now){
						$q->orderBy('created_at','DESC');
						$q->where('deals.afhaaluur','>=',$now);
						})
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

	public function getDealByRegion($id)
	{
		$now = date('Y-m-d H:i:s');
		return DB::table('deals')
						->join('users','users.id', '=','deals.verkoperId')
						->join('regions','users.regionId','=','regions.id')
						->where('regions.id','=',$id)
						->where('beschikbaar','=',true)
						->where('deals.dealeinde','>=',$now)
						->select('deals.*','users.naam','users.postcode','users.gemeente','users.straatnaam','users.postbus','users.huisnummer','users.afbeelding')
						->orderBy('deals.created_at','DESC')
						->paginate(6);
	}

	public function getDealByAfhaalMethode($afhalen,$id)
	{
		$now = date('Y-m-d H:i:s');
		return DB::table('deals')
						->join('users','users.id', '=','deals.verkoperId')
						->join('regions','users.regionId','=','regions.id')
						->where('regions.id','=',$id)
						->where('deals.afhalen','=',$afhalen)
						->where('beschikbaar','=',true)
						->where('deals.dealeinde','>=',$now)
						->select('deals.*','users.naam','users.postcode','users.gemeente','users.straatnaam','users.postbus','users.huisnummer','users.afbeelding')
						->orderBy('deals.created_at','DESC')
						->paginate(6);
	}

	public function getDealVerkoper($dealId)
	{
		return Deal::has('user')->where('id','=',$dealId)->first();
	}

}