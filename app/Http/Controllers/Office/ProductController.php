<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Principal;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;
use DataTables;
use Config;

class ProductController extends Controller
{
    public function showProduct(){
        return view('office.product.show_product');
    }

    public function addProduct(){
        $regions_id = Config::get('constant.regions_id');
        $countries = Config::get('constant.countries');
        $branch_wise = Config::get('constant.branch_wise');
        $principal = Principal::get()->toArray();
        $category = Category::get()->toArray();
        $brand = Brand::get()->toArray();

        if(!empty($principal)){
            $principal = collect($principal)->pluck('stn_make', 'in_make_id')->toArray();
        }else{
            $principal = '';
        }

        if(!empty($category)){
            $category = collect($category)->pluck('st_product_fields', 'st_cat_name')->toArray();
        }else{
            $category = '';
        }

        if(!empty($brand)){
            $brand = collect($brand)->pluck('brand_name', 'id')->toArray();
        }else{
            $brand = '';
        }
        return view('office.product.add_product', compact('principal', 'category', 'brand'));
    }

    public function storeProduct(Request $request){
        $this->validate($request,[
            'st_part_No'=>'required',
            'stn_hsn_no'=>'required',
            'principal_id'=>'required',
            'in_cat_id'=>'required',
            'stn_brand'=>'required',
            'fl_pro_price'=>'required',
            'str_igst_rate'=>'required',
            'in_pro_disc'=>'required',
            'in_pro_qty'=>'required',
            // 'st_img_path'=>'required',
            'st_pro_desc'=>'required',
            'extra_desc'=>'required',
        ]);
        $principal_id = $request->principal_id;
        if(!empty($principal_id)){
            $sep_name_id = explode("_", $principal_id);
            $st_pro_maker = ['st_pro_maker'=>$sep_name_id[0]];
            $p_id = ['principal_id'=>$sep_name_id[1]];
        }else{
            $st_pro_maker = [];
            $p_id = [];
        }
        $all_filed = $request->all();
        unset($all_filed['_token']);
        unset($all_filed['principal_id']);
        if(!empty($all_filed)){
            $new_arr = [];
            foreach($all_filed as $ky=>$fld){
                $new_arr[$ky] = $request->$ky;
            }
            $x = $new_arr+['dt_created'=>Carbon::now()]+$st_pro_maker+$p_id;
            $check_status = Product::insertGetId($x);
            if(!empty($check_status)){
                return back()->with([
                    'message' => 'Product created successfully !',
                ]);
            }

        }
    }

    public function getProduct(Request $request){
        $product = Product::get();
        return Datatables::of($product)
           ->editColumn('dt_created', function ($product) {
                $date = $product['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
           })->make(true);
    }
}
