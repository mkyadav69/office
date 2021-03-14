<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('address')) {
			Schema::create('address', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('place', 256);
				$table->string('address', 256);
				$table->string('phone', 256);
				$table->string('email', 256);
				$table->string('map', 1024);
				$table->boolean('status');
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
		Schema::drop('address');
	}

}
