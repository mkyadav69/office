<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first_name', 256);
			$table->string('last_name', 256);
			$table->string('user_name', 256);
			$table->string('user_unique_slug', 256);
			$table->string('email', 128);
			$table->string('password', 128);
			$table->string('gender', 128);
			$table->date('date_of_birth');
			$table->string('profile_pic', 512);
			$table->string('mobile', 16);
			$table->string('landline_no', 16);
			$table->boolean('mobile_verify');
			$table->boolean('email_verify');
			$table->text('user_details', 65535);
			$table->integer('user_type')->comment('1=admin,2=Buyer,3=Seller,4=subadmin');
			$table->boolean('status')->comment('0=Inactive,1=Active,2=Block');
			$table->text('address1', 65535);
			$table->text('address2', 65535);
			$table->string('landmark', 512);
			$table->integer('city_id');
			$table->integer('state_id');
			$table->integer('country_id');
			$table->string('pincode', 12);
			$table->string('mobile_access_token', 512);
			$table->date('mobile_token_exp_date');
			$table->string('unique_key', 512);
			$table->string('unique_key_forgot_password', 512);
			$table->date('forgot_password_date');
			$table->dateTime('last_login');
			$table->dateTime('registration_date');
			$table->string('fb_id', 64);
			$table->boolean('fb_verify');
			$table->string('google_id', 64);
			$table->boolean('google_verify');
			$table->string('registered_from', 128);
			$table->string('ip_address', 128);
			$table->string('theme_color', 64)->default('teal');
			$table->boolean('theme_layout')->default(1)->comment('1=top_menu;2=side_menu');
			$table->boolean('side_menu_state')->default(1);
			$table->dateTime('created_on');
			$table->dateTime('updated_on');
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
		Schema::drop('user');
	}

}
