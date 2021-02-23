<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCustomerCopyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_customer_copy', function(Blueprint $table)
		{
			$table->integer('in_cust_id', true);
			$table->string('st_cust_fname', 250);
			$table->string('st_cust_lname', 250);
			$table->text('st_com_name', 65535);
			$table->string('st_regions', 250)->nullable();
			$table->text('st_com_address', 65535)->nullable();
			$table->string('st_con_person1')->nullable();
			$table->string('st_con_person1_email')->nullable();
			$table->string('st_con_person1_mobile', 15)->nullable();
			$table->string('st_con_person2')->nullable();
			$table->string('st_con_person2_email')->nullable();
			$table->string('st_con_person2_mobile', 15)->nullable();
			$table->string('st_cust_city', 100)->nullable()->default('N/A');
			$table->string('cust_tin_no')->nullable();
			$table->string('cust_pin_no')->nullable();
			$table->integer('in_pincode')->nullable();
			$table->string('st_cust_state', 100)->nullable()->default('N/A');
			$table->string('st_cust_mobile', 15)->nullable()->default('N/A');
			$table->string('st_cust_email', 100)->nullable()->default('N/A');
			$table->text('st_cust_email_cc', 65535)->nullable();
			$table->integer('in_branch')->nullable()->index('in_branch');
			$table->integer('user_id')->nullable();
			$table->dateTime('dt_created')->nullable();
			$table->dateTime('dt_modify')->nullable();
			$table->integer('in_deleted')->nullable()->default(0)->index('in_deleted');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_customer_copy');
	}

}
