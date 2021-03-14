<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('offer')) {
			Schema::create('offer', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('sequence_number');
				$table->boolean('offer_type')->comment('0=Product; 1=Range; ');
				$table->decimal('price_range_start', 10);
				$table->decimal('price_range_end', 10);
				$table->string('display_name', 256);
				$table->text('offer_description', 65535);
				$table->text('product_variant_id', 65535);
				$table->string('offer_image', 128)->nullable();
				$table->boolean('status');
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
		Schema::drop('offer');
	}

}
