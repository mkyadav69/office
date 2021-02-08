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
            'owner_name' => 'required|string|max:255',
            'owner_desciption'=>'required',
        ]);
        $check_status = Quatation::insertGetId([
            'owner_name'=>$request->owner_name,
            'owner_desc'=>$request->owner_desciption,
            'dt_created'=>Carbon::now(),
            'dt_modify'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Pricipal created successfully !',
            ]);
        }
    }

    public function getBrand(Request $request){
        return Datatables::of(Brand::query())->make(true);
    }
}