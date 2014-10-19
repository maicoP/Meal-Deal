<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('naam')->unique();
			$table->string('password');
			$table->string('email')->unique();
			$table->integer('regionId')->references('id')->on('regions');
			$table->string('straatnaam');
			$table->integer('postcode');
			$table->string('gemeente');
			$table->string('postbus');
			$table->string('info');
			$table->string('afbeelding');
			$table->integer('coins')->default(5);
			$table->integer('votes')->default(0);
			$table->string('badge')->default('dummy');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
