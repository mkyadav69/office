<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmsPageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('cms_page')) {
			Schema::create('cms_page', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('main_title', 512);
				$table->string('image_name', 128);
				$table->text('image_link', 65535);
				$table->text('page_content', 65535);
				$table->text('meta_title', 65535);
				$table->text('meta_description', 65535);
				$table->text('search_keywords', 65535);
				$table->boolean('status');
				$table->boolean('is_deleted');
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
		Schema::drop('cms_page');
	}

}
