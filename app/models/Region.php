<?php

class Region extends Eloquent{

	public static function getAllRegions()
	{
		$results = DB::table('regions')->select('naamRegio','id')->orderBy('naamRegio','asc')->get();
		$allRegions = array();
		foreach($results as $result)
		{
			$allRegions = array_add($allRegions , $result->id , $result->naamRegio);
		}
		return $allRegions;
	}

}

