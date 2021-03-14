<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_order')) {
			Schema::create('tbl_order', function(Blueprint $table)
			{
				$table->integer('in_order_id', true);
				$table->string('in_uniq_order_id')->index('in_uniq_order_id');
				$table->string('in_qoute_uniqu_id')->index('in_qoute_uniqu_id');
				$table->integer('in_cust_id')->index('in_cust_id');
				$table->string('st_cust_order_num', 100);
				$table->date('dt_cust_order_date')->nullable();
				$table->text('st_ord_ship_adds', 65535)->nullable();
				$table->string('st_ord_ship_state', 100)->nullable();
				$table->string('st_ord_ship_pincode', 100)->nullable();
				$table->string('st_ord_ship_city', 100)->nullable();
				$table->string('in_ord_ship_tel', 100)->nullable();
				$table->string('st_landline', 200)->nullable();
				$table->string('st_ord_ship_email', 100)->nullable();
				$table->integer('flg_same_as_bill_add')->nullable()->default(0);
				$table->string('st_qoute_enq_no', 100)->nullable();
				$table->string('st_ord_tin_no', 100)->nullable();
				$table->integer('in_tax_branch_id')->nullable();
				$table->string('st_ord_bank_id', 100)->nullable();
				$table->string('st_pay_turm')->nullable();
				$table->string('ord_invoice_no', 75)->nullable();
				$table->text('st_ext_note', 65535)->nullable();
				$table->integer('flt_ord_saletax_id')->nullable();
				$table->integer('flt_ord_net_total');
				$table->integer('flt_ord_saletax_amt')->nullable();
				$table->integer('flt_ord_frig_pack')->nullable();
				$table->integer('flt_ord_total')->nullable();
				$table->integer('in_del_period')->nullable();
				$table->integer('int_ord_status');
				$table->integer('log_in_id');
				$table->integer('in_branch_id');
				$table->string('st_currency_applied', 200)->nullable();
				$table->integer('is_payment_paid')->nullable();
				$table->string('st_courier_option', 200)->nullable();
				$table->dateTime('dt_created');
				$table->integer('bill_add_id')->nullable();
				$table->integer('int_payment_mode')->nullable();
				$table->integer('is_shipment_pending')->nullable()->comment('0 = pending , 1 = shipment');
				$table->string('lead_from', 252);
				$table->string('stn_pdf_name', 200)->nullable()->comment('Direct download pdf order');
				$table->dateTime('dt_modify')->nullable();
				$table->integer('flg_deleted')->nullable()->default(0)->index('flg_deleted');
				$table->string('st_cont_person_for_payment');
				$table->string('int_cont_num_for_payment', 15);
				$table->integer('flg_is_order_closed')->nullable()->default(0)->comment('1 => oreder closed, 0 => order open');
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
		Schema::drop('tbl_order');
	}

}
