<?php

class School extends Eloquent{

	public static function getAllSchools()
	{
		$results = School::select('naam','id')->orderBy('naam','asc')->get();
		$allSchools = array();
		foreach($results as $result)
		{
			$allSchools = array_add($allSchools , $result->id , $result->naam);
		}
		return $allSchools;
	}

}

