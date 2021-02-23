<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblColumnApprovalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_column_approval', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('unique_key', 512);
			$table->string('sample', 256);
			$table->string('pharmacopoeia', 256);
			$table->string('sales_person', 256);
			$table->string('column_approval_date', 256);
			$table->string('api_intermediate_formulation_other', 256);
			$table->string('matrices', 256);
			$table->text('column_type', 65535)->comment('1=HPLC,2=GC,3=Sample Analysis,4=Column');
			$table->boolean('c_hplc');
			$table->boolean('c_gc');
			$table->boolean('c_sample_analysis');
			$table->boolean('c_column');
			$table->text('organisation', 65535);
			$table->string('customer_location', 256);
			$table->string('customer_department', 256);
			$table->string('customer_name', 256);
			$table->string('customer_designation', 256);
			$table->string('customer_email_fax', 128);
			$table->string('customer_phone', 128);
			$table->text('in_use_column_description', 65535);
			$table->text('required_column_description', 65535);
			$table->text('is_guard_column_being_used', 65535);
			$table->text('details_of_guard_column', 65535);
			$table->text('part_no', 65535);
			$table->text('is_change_of_brand_acceptable_by_customer_their_QA', 65535);
			$table->text('description_of_the_problem_if_any', 65535);
			$table->text('diluents_solvent', 65535);
			$table->text('standard_preparation', 65535);
			$table->text('mobile_phase', 65535);
			$table->text('flow_rate_min', 65535);
			$table->text('gradient_temp_program', 65535);
			$table->text('injection_volume', 65535);
			$table->text('detector', 65535);
			$table->text('detector_settings', 65535);
			$table->text('instrument_used_make_model', 65535);
			$table->text('additional_information', 65535);
			$table->string('expected_column_consumption_if_approved', 256);
			$table->text('attached_type', 65535)->comment('1=Sample analysis Chromatogram,2-Analytical method / Monograph');
			$table->boolean('attached_type1');
			$table->boolean('attached_type2');
			$table->dateTime('created_on');
			$table->dateTime('modified_on');
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
		Schema::drop('tbl_column_approval');
	}

}
