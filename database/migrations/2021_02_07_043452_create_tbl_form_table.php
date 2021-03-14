<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{	
		if (!Schema::hasTable('tbl_form')) {
			Schema::create('tbl_form', function(Blueprint $table)
			{
				$table->integer('int_form_id', true);
				$table->string('str_form_no', 50)->nullable();
				$table->string('str_invoice_no', 50)->nullable();
				$table->integer('in_cust_id')->nullable();
				$table->string('int_order_id', 100)->nullable()->comment('find order in order table ');
				$table->dateTime('dt_form')->nullable();
				$table->string('int_form_type')->nullable();
				$table->integer('int_order_type')->nullable();
				$table->integer('in_branch_id')->nullable();
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
		Schema::drop('tbl_form');
	}

}
