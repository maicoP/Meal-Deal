<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillTableRegions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('regions', function(Blueprint $table)
		{
			DB::table('regions')->insert(array(
	        array('naamRegio' => 'Aalst'),
	        array('naamRegio' => 'Antwerpen'),
	        array('naamRegio' => 'Brussel'),
	        array('naamRegio' => 'Geel'),
	        array('naamRegio' => 'Genk'),
	        array('naamRegio' => 'Gent'),
	        array('naamRegio' => 'Hasselt'),
	        array('naamRegio' => 'Kortrijk'),
	        array('naamRegio' => 'Leuven'),
	        array('naamRegio' => 'Mechelen'),
	        array('naamRegio' => 'Turnhout')
	    	));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('regions', function(Blueprint $table)
		{
			//
		});
	}

}
