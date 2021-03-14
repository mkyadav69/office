<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('states')) {
			Schema::create('states', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('state_name', 30);
				$table->integer('country_id')->default(1);
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
		Schema::drop('states');
	}

}
