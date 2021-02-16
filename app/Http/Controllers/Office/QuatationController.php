<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quatation;
use Carbon\Carbon;
use Config;
use DataTables;

class QuatationController extends Controller
{
    public function showQuatation(){
        $branch_wise = Config::get('constant.branch_wise');
        return view('office.quatation.quatation', compact('branch_wise'));
    }

    public function storeQuatation(Request $request){
        $this->validate($request,[
            'billing_address' => 'required',
            'branch_address'=>'required',
            'select_branch' => 'required',
            'billing_notes'=> 'required',
            'add_tin'=>'required',
            'mobile_no'=>'required',
            'email_address'=>'required',
        ]);
        $check_status = Quatation::insertGetId([
            'stn_bill_add'=>$request->billing_address,
            'stn_branch_add'=>$request->branch_address,
            'str_branch_email'=>$request->email_address,
            'str_branch_phnumber'=>$request->mobile_no,
            'stn_billing_note'=>$request->billing_notes,
            'stn_tin_no'=>$request->add_tin,
            'str_city'=>$request->select_branch,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Quatation format created successfully !',
            ]);
        }
    }

    public function getQuatation(Request $request){
        return Datatables::of(Quatation::query())->make(true);
    }

    public function updateQuatation(Request $request, $id){
        $this->validate($request,[
            'billing_address' => 'required',
            'branch_address'=>'required',
            'select_branch' => 'required',
            'billing_notes'=> 'required',
            'add_tin'=>'required',
            'mobile_no'=>'required',
            'email_address'=>'required',
        ]);
        $check_status = Quatation::where('int_id', $id)->update([
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

    public function deleteQuatation(Request $request, $id){
        $records = Quatation::where('int_id', $id)->delete();
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
