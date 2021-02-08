<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblOrderDocumentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_order_document', function(Blueprint $table)
		{
			$table->integer('in_doc_id', true);
			$table->integer('in_order_id');
			$table->integer('in_qoute_id');
			$table->string('st_document_name1', 200)->nullable();
			$table->string('st_doc_image1', 200)->nullable();
			$table->string('st_document_name2', 200)->nullable();
			$table->string('st_doc_image2', 200)->nullable();
			$table->string('st_document_name3', 200)->nullable();
			$table->string('st_doc_image3', 200)->nullable();
			$table->string('st_document_name4', 200)->nullable();
			$table->string('st_doc_image4', 200)->nullable();
			$table->dateTime('st_created')->nullable();
			$table->integer('flg_deleted')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_order_document');
	}

}
