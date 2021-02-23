<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Principal;
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
            'part_no' => 'required',
            'hsn_no'=>'required',
            'select_principal'=>'required',
            'select_category'=>'required',
            'select_brand'=>'required',
            'price'=>'required',
            'igst'=>'required',
            'discount'=>'required',
            'qty'=>'required',
            'principal_image'=>'required',
            'decription'=>'required',
            'add_decription'=>'required',
        ]);
    }
}
