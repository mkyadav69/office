<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblQuoteRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_quoteRequest')) {
			Schema::create('tbl_quoteRequest', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('str_name')->nullable();
				$table->string('str_company')->nullable();
				$table->string('str_email', 200)->nullable();
				$table->integer('int_mobile')->nullable();
				$table->string('str_landline', 100)->nullable();
				$table->string('str_country', 25)->nullable();
				$table->text('str_msg', 65535)->nullable();
				$table->text('str_product_detail', 65535)->nullable();
				$table->integer('int_lead_from')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->integer('is_deleted')->nullable();
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
		Schema::drop('tbl_quoteRequest');
	}

}
