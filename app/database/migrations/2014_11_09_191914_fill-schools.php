<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSchools extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schools', function(Blueprint $table)
		{
			DB::table('schools')->insert(array(
	        array('naam' => 'Artesis Plantijn Hogeschool Antwerpen'),
	        array('naam' => 'Arteveldehogeschool'),
	        array('naam' => 'Erasmushogeschool Brussel'),
	        array('naam' => 'Groep T Hogeschool'),
	        array('naam' => 'Hogere Zeevaartschool Antwerpen'),
	        array('naam' => 'Odisee'),
	        array('naam' => 'Hogeschool Gent'),
	        array('naam' => 'LUCA School of Arts'),
	        array('naam' => 'Hogeschool West-Vlaanderen'),
	        array('naam' => 'Karel de Grote-Hogeschool'),
	        array('naam' => 'Hogeschool Thomas More'),
	        array('naam' => 'Katholieke Hogeschool Leuven'),
	        array('naam' => 'Katholieke Hogeschool Limburg'),
	        array('naam' => 'Katholieke Hogeschool Vives'),
	        array('naam' => 'Hogeschool PXL'),
	        array('naam' => 'Katholieke Universiteit Leuven'),
	        array('naam' => 'Universiteit Antwerpen'),
	        array('naam' => 'Universiteit Gent'),
	        array('naam' => 'Universiteit Hasselt'),
	        array('naam' => 'Vrije Universiteit Brussel'),
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
		Schema::table('schools', function(Blueprint $table)
		{
			//
		});
	}

}
