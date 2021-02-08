<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblApplicationpdfTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_applicationpdf', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('str_title', 250)->nullable();
			$table->string('str_pdf', 250)->nullable();
			$table->integer('branch_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->dateTime('dt_modify')->nullable();
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
		Schema::drop('tbl_applicationpdf');
	}

}
