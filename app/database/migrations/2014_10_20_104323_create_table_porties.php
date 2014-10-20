<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePorties extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('porties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('status');
			$table->integer('dealId')->references('id')->on('deals');
			$table->integer('verkoperId')->references('id')->on('users');
			$table->integer('koperId')->references('id')->on('users');
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
		Schema::drop('porties');
	}

}
