<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTaxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_taxes', function(Blueprint $table)
		{
			$table->integer('in_tax_id', true);
			$table->string('st_tax_text')->nullable();
			$table->float('fl_tax_val', 4)->nullable();
			$table->integer('in_branch_id')->nullable();
			$table->string('st_branch_name')->nullable();
			$table->dateTime('dt_date_created')->nullable();
			$table->dateTime('dt_date_modified')->nullable();
			$table->integer('is_deleted')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_taxes');
	}

}
