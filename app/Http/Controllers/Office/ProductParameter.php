<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameter;
use Carbon\Carbon;
use DataTables;

class ProductParameter extends Controller
{
    public function showParameter(){
        return view('office.parameter.parameter');
    }

    public function storeParameter(Request $request){
        $this->validate($request,[
            'owner_name' => 'required|string|max:255',
            'owner_desciption'=>'required',
        ]);
        $check_status = Parameter::insertGetId([
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

    public function getParameter(Request $request){
        return Datatables::of(Parameter::query())->make(true);
    }
}
