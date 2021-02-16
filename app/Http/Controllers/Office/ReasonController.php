<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reason;
use Carbon\Carbon;
use DataTables;

class ReasonController extends Controller
{
    public function showReason(){
        return view('office.reason.reason');
    }

    public function storeReason(Request $request){
        $this->validate($request,[
            'reason_name' => 'required',
            'select_mode'=>'required',
        ]);
        $check_status = Reason::insertGetId([
            'stn_reasons'=>$request->reason_name,
            'stn_reason_type'=>$request->select_mode,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Reason created successfully !',
            ]);
        }
    }

    public function getReason(Request $request){
        return Datatables::of(Reason::query())->make(true);
    }

    public function updateReason(Request $request, $id){
        $this->validate($request,[
            'reason_name' => 'required',
            'select_mode'=>'required',
        ]);
        $check_status = Reason::where('int_id', $id)->update([
            'stn_reasons'=>$request->reason_name,
            'stn_reason_type'=>$request->select_mode,
            'updated_at'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Reason updated successfully !',
            ]);
        }
    }

    public function deleteReason(Request $request, $id){
        $records = Reason::where('int_id', $id)->delete();
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
