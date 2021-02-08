<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('big_image_name', 128);
			$table->string('big_image_name_mobile', 128)->nullable();
			$table->string('main_title', 512);
			$table->text('description', 65535);
			$table->text('image_link', 65535);
			$table->integer('sequence');
			$table->boolean('status');
			$table->boolean('is_deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('slider');
	}

}
