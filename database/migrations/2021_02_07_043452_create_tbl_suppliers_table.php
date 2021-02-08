<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSuppliersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_suppliers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('dt_source')->nullable();
			$table->string('s_make', 250)->nullable();
			$table->string('s_partno', 250)->nullable();
			$table->text('s_description', 65535)->nullable();
			$table->string('s_source', 250)->nullable();
			$table->string('s_currency', 250)->nullable();
			$table->integer('s_rate_fc')->nullable();
			$table->integer('s_factor_fc')->nullable();
			$table->float('s_totalcost', 10, 0)->nullable();
			$table->float('s_discount', 10, 0)->nullable();
			$table->float('s_netprice', 10, 0)->nullable();
			$table->float('s_profit', 10, 0)->nullable();
			$table->float('s_cust_price', 10, 0)->nullable();
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
		Schema::drop('tbl_suppliers');
	}

}
