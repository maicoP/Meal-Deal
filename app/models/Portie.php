<?php

class Portie extends Eloquent{

	protected $fillable =['status','dealId','verkopeerId','koperId'];

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
		return DB::table('porties')->select('id')
								   ->where('dealId','=',$dealId)
								   ->where('status','=','beschikbaar')
								   ->first();
	}
	public function aanvraagPortie($dealId)
	{
		$portieId = $this->getPortieId($dealId);
		//deal op aangevraagt zetten + koper id aanpassen
		DB::table('porties')->where('id','=',$portieId->id)
							->update(array(
				'status' => 'aangevraagt',
				'koperId' => Auth::id()
			));
		// aantal beschikbare porties bij deal aanpassen
		DB::table('deals')->where('id','=',$dealId)
						   ->decrement('porties');
		// controleren of aantal porties van de deal niet 0 is zo ja status veranderen naar niet meer beschikbaar
		$porties = DB::table('deals')->select('porties')
						   ->where('id','=',$dealId)
						   ->get();
		if($porties[0]->porties == 0)
		{
			DB::table('deals')->where('id','=',$dealId)
						   ->update(array(
						   	"beschikbaar" => false
						   	));	
		}						
	}

	public function acceptPortie($portieId)
	{
		DB::table('porties')->where('id','=',$portieId)
						   ->update(array(
						   	"status" => "geaccepteert"
						   	));							
	}

}