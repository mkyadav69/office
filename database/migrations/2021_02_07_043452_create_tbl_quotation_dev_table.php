<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblQuotationDevTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_quotation_dev')) {
			Schema::create('tbl_quotation_dev', function(Blueprint $table)
			{
				$table->string('in_quot_num', 100);
				$table->integer('in_quot_id', true);
				$table->integer('in_cust_id');
				$table->string('st_shiping_add', 2500)->nullable();
				$table->string('st_shipping_email')->nullable();
				$table->string('st_shipping_phone', 100)->nullable();
				$table->string('st_shiping_city', 150)->nullable();
				$table->string('st_shiping_state', 150)->nullable();
				$table->string('st_shiping_pincode', 100)->nullable();
				$table->integer('flg_same_as_bill_add')->nullable()->default(0);
				$table->string('st_enq_ref_number', 200)->nullable();
				$table->string('st_tin_number', 200)->nullable();
				$table->string('in_bank_id', 200)->nullable();
				$table->string('st_pay_turm')->nullable();
				$table->text('st_ext_note', 65535)->nullable();
				$table->integer('fl_sub_total')->nullable()->default(0);
				$table->integer('fl_sales_tax_amt')->nullable()->default(0);
				$table->integer('fl_sales_tax')->nullable();
				$table->integer('in_sal_tax_id')->nullable();
				$table->integer('fl_fleight_pack_charg')->nullable();
				$table->integer('final_amount')->nullable();
				$table->integer('fl_nego_amt')->nullable();
				$table->integer('in_deliv_priod')->nullable()->comment('For select branch id to show taxes');
				$table->integer('in_pro_deli_period');
				$table->string('st_ref_through')->nullable();
				$table->date('dt_ref')->nullable();
				$table->integer('in_tax_branch_id')->nullable();
				$table->integer('in_branch_id');
				$table->string('st_currency_applied')->nullable()->default('rupees');
				$table->integer('in_login_id')->nullable();
				$table->string('stn_pdf_name', 200)->nullable()->comment('pdf path for download direct');
				$table->string('lead_from', 250);
				$table->integer('is_order_pending')->nullable()->default(0)->comment('0 = pending , 1 = complete');
				$table->dateTime('dt_date_created')->nullable();
				$table->dateTime('dt_date_modified')->nullable();
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
		Schema::drop('tbl_quotation_dev');
	}

}
