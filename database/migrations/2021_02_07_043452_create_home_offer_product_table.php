<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomeOfferProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('home_offer_product', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('main_title', 512);
			$table->text('product_id', 65535);
			$table->string('offer_image_mobile', 128)->nullable();
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
		Schema::drop('home_offer_product');
	}

}
