<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Principal;
use Carbon\Carbon;
use DataTables;

class CourierController extends Controller
{
    public function showCourier(){
        return view('office.courier.courier');
    }

    public function storeCourier(Request $request){
        $this->validate($request,[
            'owner_name' => 'required|string|max:255',
            'owner_desciption'=>'required',
        ]);
        $check_status = Principal::insertGetId([
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

    public function getCourier(Request $request){
        return Datatables::of(Principal::query())->make(true);
    }
}
