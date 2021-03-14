<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_news')) {
			Schema::create('tbl_news', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('str_title', 200)->nullable();
				$table->text('str_text', 65535)->nullable();
				$table->string('news_img', 200)->nullable();
				$table->integer('branch_id')->nullable();
				$table->integer('user_id')->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->boolean('is_deleted')->default(0);
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
		Schema::drop('tbl_news');
	}

}
