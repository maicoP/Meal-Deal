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

}