<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAppQuotRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_AppQuotRequest', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('st_app_order_no', 200)->nullable();
			$table->string('str_prod_id', 200)->nullable();
			$table->string('str_prod_name', 200)->nullable();
			$table->text('st_product_desc', 65535)->nullable();
			$table->string('st_maker', 200)->nullable();
			$table->string('st_category', 200)->nullable();
			$table->integer('in_pro_qty')->nullable();
			$table->integer('fl_pro_unitprice')->nullable();
			$table->integer('fl_discount')->nullable();
			$table->integer('fl_net_price')->nullable();
			$table->string('st_user_email', 200)->nullable();
			$table->string('st_user_mobile', 11)->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->dateTime('dt_modify')->nullable();
			$table->integer('is_deleted')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_AppQuotRequest');
	}

}
