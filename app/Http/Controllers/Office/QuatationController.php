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
            'int_branch_id'=>$request->select_branch,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Quatation format created successfully !',
            ]);
        }
    }

    public function getQuatation(Request $request){
        $quatation = Quatation::get();
        $branch_wise = Config::get('constant.branch_wise');
        return Datatables::of($quatation)
           ->editColumn('int_branch_id', function ($quatation) use($branch_wise) {
                $id = $quatation['int_branch_id'];
                if(!empty($id)){
                    if(isset($branch_wise[$id])){
                        return $branch_wise[$id];
                    }
                }
           })->editColumn('dt_created', function ($reason) {
                $date = $reason['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
            
        })->make(true);
        return Datatables::of(Quatation::query())->make(true);
    }

    public function updateQuatation(Request $request, $id){
        $this->validate($request,[
            'update_billing_address' => 'required',
            'update_branch_address'=>'required',
            'update_select_branch' => 'required',
            'update_billing_notes'=> 'required',
            'update_add_tin'=>'required',
            'update_mobile_no'=>'required',
            'update_email_address'=>'required',
        ]);

        $check_status = Quatation::where('int_quotformat_id', $id)->update([
            'stn_bill_add'=>$request->update_billing_address,
            'stn_branch_add'=>$request->update_branch_address,
            'str_branch_email'=>$request->update_email_address,
            'str_branch_phnumber'=>$request->update_mobile_no,
            'stn_billing_note'=>$request->update_billing_notes,
            'stn_tin_no'=>$request->update_add_tin,
            'int_branch_id'=>$request->update_select_branch,
            'updated_at'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Quatation format updated successfully !',
            ]);
        }
    }

    public function deleteQuatation(Request $request, $id){
        $records = Quatation::where('int_quotformat_id', $id)->delete();
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
