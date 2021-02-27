<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Quatation;
use Carbon\Carbon;
use Config;
use DataTables;

class QuatationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showQuatation(){
        $branch_wise = Config::get('constant.branch_wise');
        $swipe_branch = array_flip($branch_wise);
        return view('office.quatation.quatation', compact('branch_wise', 'swipe_branch'));
    }

    public function storeQuatation(Request $request){
        $validator = Validator::make($request->all(), [
            'billing_address' => 'required',
            'branch_address'=>'required',
            'select_branch' => 'required',
            'billing_notes'=> 'required',
            'add_tin'=>'required',
            'mobile_no'=>'required',
            'email_address'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'quatation_add')->withInput();
        }
        $quatation = $request->select_branch;
        if(!empty($quatation)){
            $branch_id = explode('_', $quatation)[0];
            $branch_name = explode('_', $quatation)[1];
        }else{
            $branch_id = null;
            $branch_name = null;
        }   
        $check_status = Quatation::insertGetId([
            'stn_bill_add'=>$request->billing_address,
            'stn_branch_add'=>$request->branch_address,
            'str_branch_email'=>$request->email_address,
            'str_branch_phnumber'=>$request->mobile_no,
            'stn_billing_note'=>$request->billing_notes,
            'stn_tin_no'=>$request->add_tin,
            'int_branch_id'=>$request->branch_id,
            'str_city'=>$request->branch_name,
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
        $validator = Validator::make($request->all(), [
            'update_billing_address' => 'required',
            'update_branch_address'=>'required',
            'update_select_branch' => 'required',
            'update_billing_notes'=> 'required',
            'update_add_tin'=>'required',
            'update_mobile_no'=>'required',
            'update_email_address'=>'required',
            'dt_modify'=>Carbon::now(),
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'quatation_update')->withInput();
        }

        $check_status = Quatation::where('int_quotformat_id', $id)->update([
            'stn_bill_add'=>$request->update_billing_address,
            'stn_branch_add'=>$request->update_branch_address,
            'str_branch_email'=>$request->update_email_address,
            'str_branch_phnumber'=>$request->update_mobile_no,
            'stn_billing_note'=>$request->update_billing_notes,
            'stn_tin_no'=>$request->update_add_tin,
            'int_branch_id'=>$request->update_select_branch,
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
