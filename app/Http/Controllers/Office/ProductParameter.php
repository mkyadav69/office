<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameter;
use Carbon\Carbon;
use DataTables;
use Log;

class ProductParameter extends Controller
{
    public function showParameter(Request $request){
        return view('office.parameter.parameter');
    }

    public function storeParameter(Request $request){
        $this->validate($request,[
            'parameter_name' => 'required',
            'column_name'=>'required',
        ]);
        $check_status = Parameter::insertGetId([
            'p_name'=>$request->parameter_name,
            'column_name'=>$request->column_name,
            'dt_created'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Product parameter created successfully !',
            ]);
        }
    }

    public function getParameter(Request $request){
        return Datatables::of(Parameter::query())->make(true);
    }

    public function updateParameter(Request $request, $id){
        $this->validate($request,[
            'parameter_name' => 'required',
            'column_name'=>'required',
        ]);
        $check_status = Parameter::where('id', $id)->update([
            'p_name'=>$request->parameter_name,
            'column_name'=>$request->column_name,
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Product parameter updated successfully !',
            ]);
        }
    }

    public function deleteParameter(Request $request, $id){
        $records = Parameter::where('id', $id)->get()->first();
        if($records){
            $records->delete();
            $message =  'Records deleted successfully !';
        }else{
            $message ='Fail to successfully !';
        }
        return back()->with([
            'message' =>$message
        ]);
    }
}
