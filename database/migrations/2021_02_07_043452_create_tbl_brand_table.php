<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_brand')) {
			Schema::create('tbl_brand', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('brand_name', 250)->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
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
		Schema::drop('tbl_brand');
	}

}
