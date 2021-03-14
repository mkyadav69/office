<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAdvbannerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_advbanner')) {
			Schema::create('tbl_advbanner', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('slider_title', 250)->nullable();
				$table->string('small_content', 250)->nullable();
				$table->text('know_more', 65535)->nullable();
				$table->string('slider_img', 250)->nullable();
				$table->string('branch_id', 250)->nullable();
				$table->integer('user_id')->nullable();
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
		Schema::drop('tbl_advbanner');
	}

}
