<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_category', function(Blueprint $table)
		{
			$table->integer('cat_id', true);
			$table->string('st_cat_name', 200)->nullable();
			$table->text('st_cat_disc', 65535)->nullable();
			$table->string('category_slug', 250)->nullable();
			$table->string('st_product_fields')->nullable();
			$table->integer('branch_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->dateTime('dt_modify')->nullable();
			$table->boolean('status');
			$table->integer('is_deleted')->nullable();
			$table->string('str_img_src', 512)->nullable();
			$table->string('category_banner_image', 512);
			$table->string('category_small_banner_image', 512);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_category');
	}

}
