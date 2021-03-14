<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCustownerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_custowner')) {
			Schema::create('tbl_custowner', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('owner_name', 200);
				$table->text('owner_desc', 65535)->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->integer('is_deleted')->nullable()->default(0);
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
		Schema::drop('tbl_custowner');
	}

}
