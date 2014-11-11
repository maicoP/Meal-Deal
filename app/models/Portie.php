<?php

class Portie extends Eloquent{

	protected $fillable =['status','dealId','verkopeerId','koperId'];
	public function deal()
	{
		 return $this->belongsTo('Deal','dealId');
	}

	public function verkoper()
	{
		 return $this->belongsTo('User','verkoperId');
	}
	public function koper()
	{
		 return $this->belongsTo('User','koperId');
	}
	public static function savePorties($amount,$dealId,$userId)
	{
		for($i=0;$amount>$i;$i++)
		{
			DB::table('porties')->insert(
			    array('status' => 'beschikbaar',
			          'dealId' => $dealId,
			          'verkoperId' => $userId)
			);
		}
	}
	public function getPortieId($dealId)
	{
		return Portie::select('id')
						->where('dealId','=',$dealId)
					   ->where('status','=','beschikbaar')
					   ->first();
	}
	public function aanvraagPortie($dealId)
	{
		$portieId = $this->getPortieId($dealId);
		//deal op aangevraagt zetten + koper id aanpassen
		Portie::where('id','=',$portieId->id)
							->update(array(
				'status' => 'aangevraagt',
				'koperId' => Auth::id(),
				'notifVerkoper' => true
			));
		// aantal beschikbare porties bij deal aanpassen
		Deal::where('id','=',$dealId)
						   ->decrement('porties');
		// controleren of aantal porties van de deal niet 0 is zo ja status veranderen naar niet meer beschikbaar
		$porties = Deal::select('porties')
						   ->where('id','=',$dealId)
						   ->first();
		if($porties->porties == 0)
		{
			Deal::where('id','=',$dealId)
						   ->update(array(
						   	"beschikbaar" => false
						   	));	
		}						
	}

	public function acceptPortie($portieId)
	{
		Portie::where('id','=',$portieId)
						   ->update(array(
						   	"status" => "geaccepteert",
						   	'notifKoper' => true
						   	));							
	}

	public function wijgerPortie($portieId)
	{
		Portie::where('id','=',$portieId)
						   ->update(array(
						   	"status" => "beschikbaar",
						   	"koperId" => 0,
						   	'notifVerkoper' => false,
						   	'notifKoper' => false,
						   	));	
		$dealId = Portie::where('id','=',$portieId)
						->select('dealId')
						->first();
		$dealId = $dealId->dealId;
		$porties = Deal::where('id','=',$dealId)
						   ->select('porties')
						   ->first();
		if($porties->porties == 0)
		{
			Deal::where('id','=',$dealId)
						   ->update(array(
						   	"beschikbaar" => true
						   	));	
		}	
		Deal::where('id','=',$dealId)
						   ->increment('porties');					
	}

	public function getKoperId($id)
	{
		$koperId = Portie::where('id','=',$id)
						->select('koperId')
						->get();
		return $koperId[0]->koperId;
	}

	public function getPortieKoper($id)
	{
		return Portie::where('id','=',$id)->first();
	}

}