<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUspTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_usp')) {
			Schema::create('tbl_usp', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('cat_id')->nullable();
				$table->string('category', 250)->nullable();
				$table->string('usp_type', 200)->nullable();
				$table->text('packing', 65535)->nullable();
				$table->string('brand', 250)->nullable();
				$table->string('principal', 250)->nullable();
				$table->integer('user_id')->nullable();
				$table->integer('branch_id')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_updated')->nullable();
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
		Schema::drop('tbl_usp');
	}

}
