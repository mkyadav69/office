<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblMakeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_make')) {
			Schema::create('tbl_make', function(Blueprint $table)
			{
				$table->integer('in_make_id', true);
				$table->string('stn_make');
				$table->string('make_type')->nullable();
				$table->boolean('is_authorized');
				$table->string('dt_created')->nullable();
				$table->string('dt_modify')->nullable();
				$table->boolean('status');
				$table->integer('is_deleted')->nullable();
				$table->string('str_img_src', 512)->nullable();
				$table->string('small_logo_image', 512);
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
		Schema::drop('tbl_make');
	}

}
