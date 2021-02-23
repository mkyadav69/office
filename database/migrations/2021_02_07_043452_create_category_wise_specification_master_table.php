<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryWiseSpecificationMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_wise_specification_master', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('selected_category_id', 512);
			$table->text('specification_id', 65535);
			$table->boolean('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_wise_specification_master');
	}

}
