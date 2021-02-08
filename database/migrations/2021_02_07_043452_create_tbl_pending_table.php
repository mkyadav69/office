<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPendingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_pending', function(Blueprint $table)
		{
			$table->integer('int_id', true);
			$table->string('stn_qtn_ord_no', 200)->nullable()->index('stn_qtn_ord_no');
			$table->dateTime('dt_date')->nullable();
			$table->string('stn_amt', 200)->nullable();
			$table->integer('int_cust_id')->nullable();
			$table->text('stn_reason', 65535)->nullable();
			$table->integer('int_reason_mode')->nullable();
			$table->integer('int_branch_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->integer('notify_group')->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->dateTime('dt_modify')->nullable();
			$table->integer('is_deleted')->nullable()->default(0)->index('is_deleted');
			$table->integer('int_qd_no')->nullable()->index('int_qd_no');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_pending');
	}

}
