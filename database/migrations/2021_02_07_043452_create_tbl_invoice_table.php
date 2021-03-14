<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_invoice')) {
			Schema::create('tbl_invoice', function(Blueprint $table)
			{
				$table->integer('in_invoice_id', true);
				$table->integer('in_partorder_id')->nullable()->index('in_partorder_id');
				$table->string('st_invoice_no')->nullable()->index('st_invoice_no');
				$table->string('st_courier_docket')->nullable();
				$table->string('st_invoice_docs')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modified')->nullable();
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
		Schema::drop('tbl_invoice');
	}

}
