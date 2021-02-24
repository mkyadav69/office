<?php

namespace App\Http\Controllers\Office;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Owner;
use Carbon\Carbon;
use DataTables;
use Config;


class CustomerController extends Controller
{
    
    public function showCustomer(){
        
        $regions_id = Config::get('constant.regions_id');
        $countries = Config::get('constant.countries');
        $branch_wise = Config::get('constant.branch_wise');
        return view('office.customer.customer', compact('regions_id', 'countries', 'branch_wise'));
    }

    public function storeCustomer(Request $request){
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_last_name' =>  'required',
            'customer_company_name' =>  'required',
            'customer_region' =>  'required',
            'customer_mobile' =>  'required',
            'gst_no' =>  'required',
            'tin_no' =>  'required',
            'customer_email'=> 'required',
            'customer_branch'=> 'required',

            'persion1_name' => 'required',
            'persion1_email' => 'required',
            'persion1_mobile' => 'required',

            'persion2_name' =>  'required',
            'persion2_email' =>  'required',
            'persion2_mobile' =>  'required',

            'customer_address' =>  'required',
            'customer_city' =>  'required',
            'customer_state' =>  'required',
            'customer_pincode' =>  'required',
        ]);



        if ($validator->fails()) {
            return back()->withErrors($validator, 'cutomer_add')->withInput();
        }
        $check_status = Customer::insertGetId([
            'st_cust_fname'=>$request->customer_name,
            'st_cust_lname'=>$request->customer_last_name,
            'st_com_name'=>$request->customer_company_name,
            'st_regions'=>$request->customer_region,
            'st_com_address'=>$request->customer_address,

            'st_con_person1'=>$request->persion1_name,
            'st_con_person1_email'=>$request->persion1_email,
            'st_con_person1_mobile'=>$request->persion1_mobile,

            'st_con_person2'=>$request->persion2_name,
            'st_con_person2_email'=>$request->persion2_email,
            'st_con_person2_mobile'=>$request->persion2_mobile,

            'st_cust_city'=>$request->customer_city,
            'cust_tin_no'=>$request->tin_no,
            'cust_pin_no'=>$request->gst_no,
            'in_pincode'=>$request->customer_pincode,
            'st_cust_state'=>$request->customer_state,
            'st_cust_mobile'=>$request->customer_mobile,
            'st_cust_email'=>$request->customer_email,
            'st_cust_email_cc'=>$request->customer_email,
            'in_branch'=>$request->customer_branch,

            'owner_id'=>Auth::user()->id,
            'user_id'=>Auth::user()->id,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'customer_message' => 'Customer created successfully !',
            ]);
        }
    }

    public function getCustomer(Request $request){
        $customer = Customer::get();
        return Datatables::of($customer)
           ->editColumn('dt_created', function ($customer) {
                $date = $customer['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
           })->make(true);
    }

    public function updateCustomer(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "update_customer_name" => 'required',
            "update_customer_last_name" => 'required',
            "update_customer_company_name" => 'required',
            "update_customer_email" => 'required',
            "update_customer_region" => 'required',
            "update_customer_mobile" => 'required',
            "update_gst_no" => 'required',
            "update_tin_no" => 'required',

            "update_persion1_name" => 'required',
            "update_persion1_email" => 'required',
            "update_persion1_mobile" => 'required',

            "update_persion2_name" => 'required',
            "update_persion2_email" => 'required',
            "update_persion2_mobile" => 'required',

            "update_customer_address" => 'required',
            "update_customer_city" => 'required',
            "update_customer_state" => 'required',
            "update_customer_pincode" => 'required',
            "update_customer_branch" => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'cutomer_update');
        }
        
        $check_status = Customer::where('in_cust_id', $id)->update([
            'st_cust_fname'=>$request->update_customer_name,
            'st_cust_lname'=>$request->update_customer_last_name,
            'st_com_name'=>$request->update_customer_company_name,
            'st_regions'=>$request->update_customer_region,
            'st_com_address'=>$request->update_customer_address,

            'st_con_person1'=>$request->update_persion1_name,
            'st_con_person1_email'=>$request->update_persion1_email,
            'st_con_person1_mobile'=>$request->update_persion1_mobile,

            'st_con_person2'=>$request->update_persion2_name,
            'st_con_person2_email'=>$request->update_persion2_email,
            'st_con_person2_mobile'=>$request->update_persion2_mobile,

            'st_cust_city'=>$request->update_customer_city,
            'cust_tin_no'=>$request->update_tin_no,
            'cust_pin_no'=>$request->update_gst_no,
            'in_pincode'=>$request->update_customer_pincode,
            'st_cust_state'=>$request->update_customer_state,
            'st_cust_mobile'=>$request->update_customer_mobile,
            'st_cust_email'=>$request->update_customer_email,
            'st_cust_email_cc'=>$request->update_customer_email,
            'in_branch'=>$request->update_customer_branch,

            'owner_id'=>Auth::user()->id,
            'user_id'=>Auth::user()->id,
            'dt_modify'=>Carbon::now(),
        ]);
        if(!empty($check_status)){
            return back()->with([
                'customer_message' => 'Customer updated successfully !',
            ]);
        }
    }

    public function deleteCustomer(Request $request, $id){
        $records = Customer::where('in_cust_id', $id)->delete();
        if($records == '1'){
            $message =  'Records deleted successfully !';
        }else{
            $message ='Fail to delete record !';
        }
        return back()->with([
            'customer_message' =>$message
        ]);
    }

    public function showOwner(){
        return view('office.customer.owner');
    }

    public function storeOwner(Request $request){
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'owner_desciption'=>'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'owner_add')->withInput();
        }
        $check_status = Owner::insertGetId([
            'owner_name'=>$request->owner_name,
            'owner_desc'=>$request->owner_desciption,
            'dt_created'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Owner created successfully !',
            ]);
        }
    }

    public function getOwner(Request $request){
        $customer = Owner::get();
        return Datatables::of($customer)
           ->editColumn('dt_created', function ($customer) {
                $date = $customer['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
           })->make(true);
    }

    public function updateOwner(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'update_owner_name' => 'required',
            'update_owner_desciption'=>'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator, 'owner_update')->withInput();
        }

        $check_status = Owner::where('id', $id)->update([
            'owner_name'=>$request->update_owner_name,
            'owner_desc'=>$request->update_owner_desciption,
            'dt_modify'=>Carbon::now(),
        ]);
        
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Customer updated successfully !',
            ]);
        }
    }

    public function deleteOwner(Request $request, $id){
        $records = Owner::where('id', $id)->delete();
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

