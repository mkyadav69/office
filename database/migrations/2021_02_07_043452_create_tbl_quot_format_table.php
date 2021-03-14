<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblQuotFormatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_quot_format')) {
			Schema::create('tbl_quot_format', function(Blueprint $table)
			{
				$table->integer('int_quotformat_id', true);
				$table->text('stn_bill_add', 65535)->nullable();
				$table->text('stn_branch_add', 65535)->nullable();
				$table->string('str_branch_email')->nullable();
				$table->string('str_branch_phnumber', 20)->nullable();
				$table->text('stn_billing_note', 65535)->nullable();
				$table->string('stn_gst_no')->nullable();
				$table->string('stn_arn_no')->nullable();
				$table->string('stn_tin_no')->nullable();
				$table->integer('int_user_id')->nullable();
				$table->integer('int_branch_id')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->integer('is_deleted')->nullable()->default(0);
				$table->string('str_lat_lon', 256)->nullable();
				$table->string('str_city', 50)->nullable();
				$table->integer('int_orderby')->nullable();
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
		Schema::drop('tbl_quot_format');
	}

}
