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
				'koperId' => Auth::id()
			));
		// aantal beschikbare porties bij deal aanpassen
		Deal::where('id','=',$dealId)
						   ->decrement('porties');
		// controleren of aantal porties van de deal niet 0 is zo ja status veranderen naar niet meer beschikbaar
		$porties = Deal::select('porties')
						   ->where('id','=',$dealId)
						   ->get();
		if($porties[0]->porties == 0)
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
						   	"status" => "geaccepteert"
						   	));							
	}

}