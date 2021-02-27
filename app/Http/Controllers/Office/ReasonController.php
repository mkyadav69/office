<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Reason;
use Carbon\Carbon;
use DataTables;

class ReasonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showReason(){
        return view('office.reason.reason');
    }

    public function storeReason(Request $request){
        $validator = Validator::make($request->all(), [
            'reason_name' => 'required',
            'select_mode'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'reason_add')->withInput();
        }

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
        $reason = Reason::get();

        return Datatables::of($reason)
           ->editColumn('stn_reason_type', function ($reason) {
                $data = $reason['stn_reason_type'];
                $msg = null;
                if($data == 1){
                    $msg = 'Pending Order';
                }else{
                    $msg = 'Pending Shipment';
                }
                return $msg;
           })->editColumn('dt_created', function ($reason) {
                $date = $reason['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
            
        })->make(true);
    }

    public function updateReason(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_reason_name' => 'required',
            'update_select_mode'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'reason_update')->withInput();
        }
        $check_status = Reason::where('int_id', $id)->update([
            'stn_reasons'=>$request->update_reason_name,
            'stn_reason_type'=>$request->update_select_mode,
            'dt_modify'=>Carbon::now(),
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
