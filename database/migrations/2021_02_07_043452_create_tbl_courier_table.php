<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCourierTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_courier', function(Blueprint $table)
		{
			$table->integer('in_courier_id', true);
			$table->string('st_courier_name')->nullable();
			$table->integer('in_branch_id')->nullable();
			$table->string('st_branch_name')->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->dateTime('dt_modified')->nullable();
			$table->integer('is_deleted')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_courier');
	}

}
