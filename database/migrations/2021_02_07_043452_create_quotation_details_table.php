<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuotationDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('quotation_details')) {
			Schema::create('quotation_details', function(Blueprint $table)
			{
				$table->integer('in_qout_detail_id', true);
				$table->integer('in_cust_id')->nullable()->index('in_cust_id');
				$table->integer('in_product_id')->nullable()->index('in_product_id');
				$table->string('st_part_no')->nullable()->index('st_part_no');
				$table->string('st_product_desc')->nullable();
				$table->string('stn_hsn_no', 150)->nullable()->comment('Add HSN code in each product');
				$table->string('st_maker')->nullable();
				$table->integer('in_pro_qty')->nullable();
				$table->integer('fl_pro_unitprice')->nullable();
				$table->integer('in_igst_rate')->nullable();
				$table->integer('fl_net_price')->nullable();
				$table->integer('fl_row_total');
				$table->integer('fl_discount')->nullable();
				$table->text('prod_comments', 65535)->nullable();
				$table->text('in_pro_deli_period', 65535);
				$table->integer('flg_is_deleted')->default(0)->index('flg_is_deleted');
				$table->integer('in_quot_id')->index('in_quot_id');
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
		Schema::drop('quotation_details');
	}

}
