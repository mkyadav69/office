<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblParameterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_parameter')) {
			Schema::create('tbl_parameter', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('p_name', 250);
				$table->string('column_name', 250);
				$table->dateTime('dt_created');
				$table->string('branch_id', 250)->nullable();
				$table->integer('user_id')->nullable();
				$table->integer('is_deleted')->default(0);
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
		Schema::drop('tbl_parameter');
	}

}
