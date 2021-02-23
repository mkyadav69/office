<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_bank', function(Blueprint $table)
		{
			$table->integer('in_bank_id', true);
			$table->string('st_bank_name')->nullable();
			$table->string('st_bank_branch')->nullable();
			$table->string('st_bank_IFSC_code')->nullable();
			$table->string('st_bank_acc_no')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_bank');
	}

}
