<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblContactusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_contactus')) {
			Schema::create('tbl_contactus', function(Blueprint $table)
			{
				$table->increments('int_id');
				$table->string('str_name', 150)->nullable();
				$table->timestamp('date_created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
				$table->string('str_company', 150)->nullable();
				$table->string('str_place', 150)->nullable();
				$table->string('str_email', 150)->nullable();
				$table->string('str_mobile', 11)->nullable();
				$table->string('str_reason', 256)->nullable();
				$table->integer('str_leadfrom')->nullable();
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
		Schema::drop('tbl_contactus');
	}

}
