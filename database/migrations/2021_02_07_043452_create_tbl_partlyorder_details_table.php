<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPartlyorderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_partlyorder_details', function(Blueprint $table)
		{
			$table->integer('in_partlyord_detail_id', true);
			$table->integer('in_partparaint_ord_id')->index('in_partparaint_ord_id');
			$table->integer('in_partlyorder_id')->index('in_partlyorder_id');
			$table->string('st_part_no')->nullable();
			$table->integer('in_partlyord_prod_id')->index('in_partlyord_prod_id');
			$table->string('in_partlyord_pro_desc', 200);
			$table->string('in_partlyord_delivery_period');
			$table->string('in_partlyord_pro_maker', 100)->nullable();
			$table->integer('in_partlyord_pro_qty');
			$table->integer('in_sent_pro_qty');
			$table->integer('in_balance_pro_qty');
			$table->integer('flt_partlyord_pro_price');
			$table->integer('flt_partlyord_pro_disct')->nullable();
			$table->integer('flt_partlyord_pro_net_price');
			$table->integer('flt_partlyord_pro_row_total')->nullable();
			$table->integer('in_igst_rate')->nullable();
			$table->integer('in_partlyord_pro_status')->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->integer('flg_deleted')->nullable()->default(0)->index('flg_deleted');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_partlyorder_details');
	}

}
