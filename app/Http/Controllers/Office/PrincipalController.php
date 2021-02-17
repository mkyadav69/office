<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
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
        $this->validate($request,[
            'principal_name' => 'required',
            'select_principal'=>'required',
            'principal_image'=>'required',
        ]);

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
        return Datatables::of(Principal::query())->make(true);
    }

    public function updatePrincipals(Request $request, $id){
        $this->validate($request,[
            'principal_name' => 'required',
            'select_principal'=>'required',
            'principal_image'=>'required',
        ]);
        
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
            'stn_make'=>$request->principal_name,
            'make_type'=>$request->select_principal,
            'is_authorized'=>$is_authorized,
            'small_logo_image'=>$request->principal_image,
            'status'=>$status,
            'dt_modify'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
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
