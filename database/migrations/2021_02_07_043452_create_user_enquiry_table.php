<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserEnquiryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_enquiry', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('product_id');
			$table->decimal('price', 20);
			$table->decimal('mrp', 20);
			$table->string('quantity', 12);
			$table->string('order_id', 32);
			$table->string('order_unique_key', 512);
			$table->string('product_unique_key', 512);
			$table->boolean('order_status')->comment('0=New order,1=To-be-Picked,2=Dispatch,3=To handover,4=In-Transit,5=Manual,6=Delivered,7=Return,8=Rejected,9=Cancel by Buyer,10=Undelivered');
			$table->date('order_date');
			$table->dateTime('order_date_time');
			$table->integer('order_address_id');
			$table->text('seller_note', 65535);
			$table->dateTime('modified_on');
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
		Schema::drop('user_enquiry');
	}

}
