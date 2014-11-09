<?php

class Region extends Eloquent{

	public function user()
	{
		return $this->hasMany('User','regionId');
	}
	public static function getAllRegions()
	{
		$results = Region::select('naamRegio','id')->orderBy('naamRegio','asc')->get();
		$allRegions = array();
		foreach($results as $result)
		{
			$allRegions = array_add($allRegions , $result->id , $result->naamRegio);
		}
		return $allRegions;
	}

}

