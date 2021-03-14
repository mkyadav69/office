<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblProductDevTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_product_dev')) {
			Schema::create('tbl_product_dev', function(Blueprint $table)
			{
				$table->integer('pro_id', true);
				$table->string('st_part_No', 250)->nullable();
				$table->string('st_pro_desc')->nullable();
				$table->float('fl_pro_price', 12)->nullable()->default(0.00);
				$table->integer('in_pro_qty')->nullable()->default(0);
				$table->float('in_pro_disc', 10)->nullable()->default(0.00);
				$table->string('in_cat_id', 100)->nullable();
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
		Schema::drop('tbl_product_dev');
	}

}
