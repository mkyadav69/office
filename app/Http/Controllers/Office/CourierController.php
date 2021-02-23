<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courier;
use Carbon\Carbon;
use Config;
use DataTables;

class CourierController extends Controller
{
    public function showCourier(){
        $branch_wise = Config::get('constant.branch_wise');
        return view('office.courier.courier', compact('branch_wise'));
    }

    public function storeCourier(Request $request){
        $branch_wise = Config::get('constant.branch_wise');
        if(!empty($request->select_branch)){
            $branch_name = $branch_wise[$request->select_branch];
        }
        $this->validate($request,[
            'courier_name' => 'required',
            'select_branch'=>'required',
        ]);
        $check_status = Courier::insertGetId([
            'st_courier_name'=>$request->courier_name,
            'in_branch_id'=>$request->select_branch,
            'st_branch_name'=>$branch_name,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Courier created successfully !',
            ]);
        }
    }

    public function getCourier(Request $request){
        return Datatables::of(Courier::query())->make(true);
    }

    public function updateCourier(Request $request, $id){

        $this->validate($request,[
            'update_courier_name' => 'required',
            'update_select_branch'=> 'required',
        ]);
        
        $branch_wise = Config::get('constant.branch_wise');
        
        if(!empty($request->update_select_branch)){
            $branch_name = $branch_wise[$request->update_select_branch];
        }
        $check_status = Courier::where('in_courier_id', $id)->update([
            'st_courier_name'=>$request->update_courier_name,
            'in_branch_id'=>$request->update_select_branch,
            'st_branch_name'=>$branch_name,
            'dt_modified'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Courier updated successfully !',
            ]);
        }
    }

    public function deleteCourier(Request $request, $id){
        $records = Courier::where('in_courier_id', $id)->delete();
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
