<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use DataTables;

class BrandController extends Controller
{
    public function showBrand(){
        return view('office.brand.brand');
    }

    public function storeBrand(Request $request){
        $this->validate($request,[
            'brand_name' => 'required',
        ]);
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
        return Datatables::of(Brand::query())->make(true);
    }

    public function updateBrand(Request $request, $id){

        $this->validate($request,[
            'update_brand_name' => 'required',
        ]);

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