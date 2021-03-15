<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use DataTables;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function showBrand(){
        return view('office.brand.brand');
    }

    public function storeBrand(Request $request){
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'brand_add')->withInput();
        }
        $check_status = Brand::insertGetId([
            'brand_name'=>$request->brand_name,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Brand created successfully !',
            ]);
        }
    }

    public function getBrand(Request $request){
        $brand = Brand::get();
        return Datatables::of($brand)
           ->editColumn('dt_created', function ($brand) {
                $date = $brand['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
           })->make(true);
    }

    public function updateBrand(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_brand_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'brand_update')->withInput();
        }

        $check_status = Brand::where('id', $id)->update([
            'brand_name'=>$request->update_brand_name,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Brand updated successfully !',
            ]);
        }
    }

    public function deleteBrand(Request $request, $id){
        $records = Brand::where('id', $id)->delete();
        if($records == '1'){
            $message =  'Records deleted successfully !';
        }else{
            $message ='Fail to delete record !';
        }
        return back()->with([
            'message' =>$message
        ]);
    }
}