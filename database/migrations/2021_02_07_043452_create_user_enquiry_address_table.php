<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserEnquiryAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_enquiry_address', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('order_id', 512);
			$table->string('first_name', 256);
			$table->string('last_name', 256);
			$table->string('company', 256);
			$table->string('mobile', 16);
			$table->text('address1', 65535);
			$table->text('address2', 65535);
			$table->string('pincode', 12);
			$table->string('city', 512);
			$table->string('state', 512);
			$table->string('country', 512);
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
		Schema::drop('user_enquiry_address');
	}

}
