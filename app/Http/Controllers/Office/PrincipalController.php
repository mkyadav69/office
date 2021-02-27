<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Principal;
use Carbon\Carbon;
use DataTables;

class PrincipalController extends Controller
{
    public function showPrincipal(){
        return view('office.principal.principal');
    }

    public function storePrincipal(Request $request){
        $validator = Validator::make($request->all(), [
            'principal_name' => 'required',
            'select_principal'=>'required',
            'principal_image'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'principal_add')->withInput();
        }

        $is_authorized = null;
        $status = null;
        if($request->select_principal == 'Authorised'){
           $is_authorized = 1;
           $status = 1;
        }else{
            $is_authorized = 0;
            $status = 0;
        }
        $check_status = Principal::insertGetId([
            'stn_make'=>$request->principal_name,
            'make_type'=>$request->select_principal,
            'is_authorized'=>$is_authorized,
            'small_logo_image'=>$request->principal_image,
            'status'=>$status,
            'dt_created'=>Carbon::now(),
        ]);

        if(!empty($check_status)){
            return back()->with([
                'message' => 'Pricipal created successfully !',
            ]);
        }
    }

    public function getPrincipal(Request $request){
        $principal = Principal::get();
        return Datatables::of($principal)
           ->editColumn('dt_created', function ($principal) {
                $date = $principal['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
           })->make(true);
    }

    public function updatePrincipals(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_principal_name' => 'required',
            'update_select_principal'=>'required',
            'update_principal_image'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'principal_update')->withInput();
        }
        
        $is_authorized = null;
        $status = null;
        if($request->select_principal == 'Authorised'){
           $is_authorized = 1;
           $status = 1;
        }else{
            $is_authorized = 0;
            $status = 0;
        }
        $check_status = Principal::where('in_make_id', $id)->update([
            'stn_make'=>$request->update_principal_name,
            'make_type'=>$request->update_select_principal,
            'is_authorized'=>$is_authorized,
            'small_logo_image'=>$request->update_principal_image,
            'status'=>$status,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Principal updated successfully !',
            ]);
        }
    }

    public function deletePrincipals(Request $request, $id){
        $records = Principal::where('in_make_id', $id)->delete();
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
