<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblContactCromoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_contact_cromo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('st_name', 250)->nullable();
			$table->text('st_company', 65535)->nullable();
			$table->string('st_email', 200)->nullable();
			$table->integer('int_phone')->nullable();
			$table->text('st_msg', 65535)->nullable();
			$table->dateTime('dt_created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_contact_cromo');
	}

}
