<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('user_address')) {
			Schema::create('user_address', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('user_id');
				$table->string('first_name', 256);
				$table->string('last_name', 256);
				$table->string('company', 256);
				$table->string('mobile', 16);
				$table->text('address1', 65535);
				$table->text('address2', 65535);
				$table->string('pincode', 12);
				$table->integer('city_id');
				$table->integer('state_id');
				$table->integer('country_id');
				$table->boolean('is_billing_default');
				$table->boolean('is_shipping_default');
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
		Schema::drop('user_address');
	}

}
