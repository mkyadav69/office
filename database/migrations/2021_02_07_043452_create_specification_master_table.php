<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecificationMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('specification_master', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('specification_title', 512);
			$table->string('specification_alias', 128);
			$table->boolean('input_type')->comment('0=Input,1=Textarea,2=Select');
			$table->boolean('is_required');
			$table->boolean('is_multiselect');
			$table->text('input_select', 65535);
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
		Schema::drop('specification_master');
	}

}
