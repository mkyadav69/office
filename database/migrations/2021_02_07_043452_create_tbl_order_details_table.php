<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_order_details')) {
			Schema::create('tbl_order_details', function(Blueprint $table)
			{
				$table->integer('in_ord_detail_id', true);
				$table->integer('in_order_id')->index('in_order_id');
				$table->string('st_part_no')->nullable()->index('st_part_no');
				$table->integer('in_ord_prod_id');
				$table->string('in_ord_pro_desc', 200);
				$table->string('in_ord_delivery_period');
				$table->string('in_ord_pro_maker', 100);
				$table->integer('in_ord_pro_qty');
				$table->integer('in_ord_pro_sent_qty')->nullable();
				$table->integer('in_ord_pro_bal_qty')->nullable();
				$table->integer('flt_ord_pro_price');
				$table->float('flt_ord_pro_disct', 10, 0)->nullable();
				$table->integer('flt_ord_pro_net_price');
				$table->text('st_hsn_no')->nullable()->comment('Product hsn number');
				$table->integer('in_igst_rate')->nullable();
				$table->integer('flt_ord_pro_row_total')->nullable();
				$table->integer('is_order_type')->nullable();
				$table->integer('in_ord_pro_status')->nullable();
				$table->integer('flg_partord_status')->nullable();
				$table->integer('flg_is_partial_checked')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->integer('flg_deleted')->nullable()->default(0)->index('flg_deleted');
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
		Schema::drop('tbl_order_details');
	}

}
