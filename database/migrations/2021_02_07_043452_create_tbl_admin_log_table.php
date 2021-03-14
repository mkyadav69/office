<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAdminLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_admin_log')) {
			Schema::create('tbl_admin_log', function(Blueprint $table)
			{
				$table->integer('log_id', true);
				$table->integer('adminlog_id')->nullable();
				$table->string('st_ipaddress', 100)->nullable();
				$table->dateTime('dt_loggedin')->nullable();
				$table->dateTime('dt_logout')->nullable();
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
		Schema::drop('tbl_admin_log');
	}

}
