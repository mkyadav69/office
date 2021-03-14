<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('user_cart')) {
			Schema::create('user_cart', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('user_id');
				$table->integer('product_id');
				$table->string('quantity', 12);
				$table->decimal('price', 10, 0);
				$table->decimal('mrp', 10, 0);
				$table->date('order_date');
				$table->dateTime('order_date_time');
				$table->integer('address_id')->nullable();
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
		Schema::drop('user_cart');
	}

}
