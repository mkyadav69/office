<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('tbl_product')){
			Schema::create('tbl_product', function(Blueprint $table)
			{
				$table->integer('pro_id', true);
				$table->string('st_part_No', 250)->nullable()->index('st_part_No');
				$table->string('product_seo_url', 512);
				$table->text('st_pro_desc', 65535)->nullable()->index('st_pro_desc');
				$table->text('extra_desc', 65535)->nullable();
				$table->float('fl_pro_price', 12)->nullable()->default(0.00);
				$table->dateTime('dt_price_update')->nullable();
				$table->dateTime('dt_qty_update')->nullable();
				$table->string('str_net_price', 200)->nullable();
				$table->integer('in_pro_qty')->nullable()->default(0);
				$table->float('in_pro_disc', 10)->nullable()->default(0.00);
				$table->integer('principal_id')->nullable()->index('principal_id');
				$table->string('st_pro_maker', 200)->nullable()->index('st_pro_maker');
				$table->string('related_category_id', 250)->nullable();
				$table->integer('category_id')->nullable()->index('category_id');
				$table->string('in_cat_id', 100)->nullable()->index('in_cat_id');
				$table->string('stn_hsn_no', 50)->nullable();
				$table->string('str_igst_rate', 100)->nullable();
				$table->string('stn_brand', 100)->nullable()->index('stn_brand');
				$table->string('str_usp_phase', 200)->nullable()->index('str_usp_phase');
				$table->string('str_pore_size', 200)->nullable()->index('str_pore_size');
				$table->string('str_columnlenght_mm', 200)->nullable();
				$table->float('str_columnid_mm', 10)->nullable()->default(0.00);
				$table->float('str_film_thikness_mm', 10)->default(0.00)->index('str_film_thikness_mm');
				$table->string('str_volume', 200)->nullable();
				$table->text('st_img_path', 65535)->nullable();
				$table->text('st_img_path_2', 65535)->nullable();
				$table->text('st_img_path_3', 65535)->nullable();
				$table->text('st_img_path_4', 65535)->nullable();
				$table->text('st_img_path_5', 65535)->nullable();
				$table->integer('user_id')->nullable()->default(1);
				$table->dateTime('dt_created')->nullable();
				$table->dateTime('dt_modify')->nullable();
				$table->integer('is_deleted')->nullable()->default(0)->index('is_deleted');
				$table->boolean('status')->default(1);
				$table->string('pack_size', 200)->nullable();
				$table->string('vial_neck', 200)->nullable();
				$table->string('caps_colour', 200)->nullable();
				$table->string('septa_colour', 200)->nullable();
				$table->string('vials_colour', 200)->nullable();
				$table->string('septa_type', 200)->nullable();
				$table->string('septa_make', 200)->nullable();
				$table->string('caps_make', 200)->nullable();
				$table->string('type', 200)->nullable();
				$table->string('bottom', 200)->nullable();
				$table->string('neck', 200)->nullable();
				$table->string('color', 200)->nullable();
				$table->string('volume', 200)->nullable();
				$table->string('caps_type', 200)->nullable();
				$table->string('caps_material', 200)->nullable();
				$table->string('septa_material', 200)->nullable();
				$table->string('cap_septa_features', 200)->nullable();
				$table->string('cap_septa_dimension', 200)->nullable();
				$table->string('syringe_application', 200)->nullable();
				$table->string('general_syringe_type', 200)->nullable();
				$table->string('termination', 200)->nullable();
				$table->string('guage', 200)->nullable();
				$table->string('pointstyle', 200)->nullable();
				$table->string('needle_length', 200)->nullable();
				$table->string('plunger_style', 200)->nullable();
				$table->string('filter_material', 200)->nullable();
				$table->string('membrane', 200)->nullable();
				$table->string('wettability', 200)->nullable();
				$table->string('sterility', 200)->nullable();
				$table->string('diameter', 200)->nullable();
				$table->string('micron_size', 200)->nullable();
				$table->string('capacity', 200)->nullable();
				$table->string('drawers', 200)->nullable();
				$table->string('colours', 200)->nullable();
				$table->string('columns', 200)->nullable();
				$table->index(['pro_id','status'], 'pro_id');
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
		Schema::drop('tbl_product');
	}

}
