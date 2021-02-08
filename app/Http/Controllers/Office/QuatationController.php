<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quatation;
use Carbon\Carbon;
use DataTables;

class QuatationController extends Controller
{
    public function showQuatation(){
        return view('office.quatation.quatation');
    }

    public function storeQuatation(Request $request){
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

    public function getQuatation(Request $request){
        return Datatables::of(Quatation::query())->make(true);
    }
}
