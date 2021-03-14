<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblHsncodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_hsncode')) {
			Schema::create('tbl_hsncode', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('str_hsncode', 100)->nullable();
				$table->integer('hsn_tax')->nullable();
				$table->integer('branch_id')->nullable();
				$table->integer('user_id')->nullable();
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
		Schema::drop('tbl_hsncode');
	}

}
