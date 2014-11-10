<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumsForNotification extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('porties', function(Blueprint $table)
		{
			$table->boolean('notifVerkoper')->default(false);
			$table->boolean('notifKoper')->default(false);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('porties', function(Blueprint $table)
		{
			$table->dropColumn('notifVerkoper');
			$table->dropColumn('notifKoper');
		});
	}

}
