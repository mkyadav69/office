<?php

namespace App\Http\Controllers\Office;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quatation;
use Carbon\Carbon;
use Config;
use DataTables;

class QuatationFormatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showQuatationFormat(){
        $branch_wise = Config::get('constant.branch_wise');
        $swipe_branch = array_flip($branch_wise);
        return view('office.quatation-format.show_quatation', compact('branch_wise', 'swipe_branch'));
    }

    public function storeQuatationFormat(Request $request){
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

    public function getQuatationFormat(Request $request){
        $branch_wise = Config::get('constant.branch_wise');
        $quatation_format = Datatables::of(Quatation::query());
        if(Auth::user()->hasPermission('update_quatation')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_quatation')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_quatation', 'delete_quatation'])){
            $quatation_format->addColumn('actions', function ($quatation_format) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($quatation_format) {
                    return $quatation_format->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }else{
            $quatation_format->addColumn('actions', function ($quatation_format){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
               
            })->setRowAttr([
                'data-id' => function($quatation_format) {
                    return $quatation_format->system_id;
                }
            ])->rawColumns(['actions' => 'actions']);
        }
        $quatation_format->editColumn('int_branch_id', function ($quatation_format) use($branch_wise) {
            $id = $quatation_format['int_branch_id'];
            if(!empty($id)){
                if(isset($branch_wise[$id])){
                    return $branch_wise[$id];
                }
            }
        })->editColumn('dt_created', function ($quatation_format) {
            $date = $quatation_format['dt_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        
        })->make(true);

        return $quatation_format->make(true);
    }

    public function updateQuatationFormat(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_billing_address' => 'required',
            'update_branch_address'=>'required',
            'update_select_branch' => 'required',
            'update_billing_notes'=> 'required',
            'update_add_tin'=>'required',
            'update_mobile_no'=>'required',
            'update_email_address'=>'required',
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
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status == '1')){
            return back()->with([
                'message' => 'Quatation format updated successfully !',
            ]);
        }else{
            return back()->with([
                'message_error' => 'Fail to updated quatation format !',
            ]);
        }
    }

    public function deleteQuatationFormat(Request $request, $id){
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
