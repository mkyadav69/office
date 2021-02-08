<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('pg_charges', 12, 0);
			$table->integer('local_shipping');
			$table->boolean('lazy_loading_catalog')->nullable();
			$table->string('company_title', 512);
			$table->text('about_company', 65535);
			$table->text('address_1', 65535);
			$table->text('address_2', 65535);
			$table->string('country', 128);
			$table->string('state', 128);
			$table->string('city', 128);
			$table->string('pincode', 16);
			$table->string('phone', 32)->nullable();
			$table->string('email', 64)->nullable();
			$table->text('default_map', 65535)->nullable();
			$table->text('facebook_link', 65535)->nullable();
			$table->text('google_plus_link', 65535)->nullable();
			$table->text('instagram_link', 65535)->nullable();
			$table->text('pinterest_link', 65535)->nullable();
			$table->string('youtube_link', 128)->nullable();
			$table->text('twitter_link', 65535)->nullable();
			$table->text('linkedin_link', 65535);
			$table->string('theme1_color', 256);
			$table->string('theme2_color', 256);
			$table->string('theme1_font', 256);
			$table->string('theme2_font', 256);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master_settings');
	}

}
