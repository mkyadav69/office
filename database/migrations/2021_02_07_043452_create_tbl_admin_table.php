<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tbl_admin')) {
			Schema::create('tbl_admin', function(Blueprint $table)
			{
				$table->integer('admin_id', true);
				$table->string('st_admin_fname', 100)->nullable();
				$table->string('st_admin_lname', 100)->nullable();
				$table->string('st_username', 250)->nullable();
				$table->string('st_password', 25)->nullable();
				$table->string('st_email', 100)->nullable();
				$table->string('st_branchname', 250)->nullable();
				$table->text('st_cc_email', 65535)->nullable();
				$table->integer('in_admin_rights')->nullable();
				$table->string('st_access_module', 250)->nullable();
				$table->dateTime('dt_created')->nullable();
				$table->integer('in_deleted')->nullable()->default(0);
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
		Schema::drop('tbl_admin');
	}

}
