<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('country')) {
			Schema::create('country', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('sortname', 3);
				$table->string('country_name', 150);
				$table->boolean('status');
				$table->boolean('is_deleted');
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('country');
	}

}
