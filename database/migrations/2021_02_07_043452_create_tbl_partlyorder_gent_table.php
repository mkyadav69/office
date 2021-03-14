<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPartlyorderGentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_partlyorder_gent')) {
			Schema::create('tbl_partlyorder_gent', function(Blueprint $table)
			{
				$table->integer('in_partparaint_ord_id', true);
				$table->string('in_uniq_order_id')->index('in_uniq_order_id');
				$table->string('in_qoute_uniqu_id')->index('in_qoute_uniqu_id');
				$table->string('in_partlyorder_id')->index('in_partlyorder_id');
				$table->integer('in_cust_id')->index('in_cust_id');
				$table->string('st_cust_order_num', 100);
				$table->date('dt_cust_order_date')->nullable();
				$table->text('st_partlyord_ship_adds', 65535)->nullable();
				$table->string('st_partlyord_ship_state', 100)->nullable();
				$table->string('st_partlyord_ship_pincode', 100)->nullable();
				$table->string('st_partlyord_ship_city', 100)->nullable();
				$table->integer('in_partlyord_ship_tel')->nullable();
				$table->string('st_partlyord_ship_email', 100)->nullable();
				$table->bigInteger('st_landline')->nullable();
				$table->integer('flg_same_as_bill_add')->nullable()->default(0);
				$table->string('st_qoute_enq_no', 100)->nullable();
				$table->string('st_ord_tin_no', 100)->nullable();
				$table->string('st_pay_turm')->nullable();
				$table->string('ord_invoice_no')->nullable();
				$table->text('st_ext_note', 65535)->nullable();
				$table->integer('flt_ord_saletax_id')->nullable();
				$table->integer('flt_ord_net_total')->nullable();
				$table->integer('flt_ord_saletax_amt')->nullable();
				$table->integer('flt_ord_frig_pack')->nullable();
				$table->integer('flt_ord_total')->nullable();
				$table->integer('in_del_period')->nullable();
				$table->integer('int_ord_status')->nullable();
				$table->integer('log_in_id')->nullable();
				$table->integer('in_branch_id')->nullable()->index('in_branch_id');
				$table->string('st_courier_option')->nullable();
				$table->integer('is_payment_paid')->nullable()->comment('Unpaid = 0 , Paid = 1');
				$table->string('lead_from', 250)->index('lead_from');
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->integer('flg_deleted')->nullable()->default(0);
				$table->string('st_cont_person_for_payment')->nullable();
				$table->string('int_cont_num_for_payment')->nullable();
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
		Schema::drop('tbl_partlyorder_gent');
	}

}
