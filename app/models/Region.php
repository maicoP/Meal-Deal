<?php

class Region extends Eloquent{

	public static function getAllRegions()
	{
		$results = DB::table('regions')->select('naam','id')->orderBy('naam','asc')->get();
		$allRegions = array();
		foreach($results as $result)
		{
			$allRegions = array_add($allRegions , $result->id , $result->naam);
		}
		return $allRegions;
	}

}

