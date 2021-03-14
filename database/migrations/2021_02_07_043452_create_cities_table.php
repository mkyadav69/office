<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('cities')) {
			Schema::create('cities', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('city_name', 30);
				$table->integer('state_id');
				$table->boolean('status')->default(1);
				$table->boolean('is_deleted')->default(0);
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
		Schema::drop('cities');
	}

}
