<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_reasons')) {
			Schema::create('tbl_reasons', function(Blueprint $table)
			{
				$table->integer('int_id', true);
				$table->text('stn_reasons', 65535)->nullable();
				$table->integer('stn_reason_type')->nullable();
				$table->string('branch_name', 200)->nullable();
				$table->integer('branch_id')->nullable();
				$table->integer('int_updated')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->integer('is_deleted')->nullable()->default(0)->index('is_deleted');
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
		Schema::drop('tbl_reasons');
	}

}
