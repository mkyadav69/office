<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Owner;
use Carbon\Carbon;
use DataTables;


class CustomerController extends Controller
{
    
    public function showCustomer(){
        
        return view('office.customer.customer');
    }

    public function storeCustomer(Request $request){
        $this->validate($request,[
            'customer_name' => 'required|string|max:255',
            'customer_last_name'=>'required|string|max:255',
        ])->with(['create']);
        $check_status = Customer::insertGetId([
            'st_cust_fname'=>$request->customer_name,
            'st_cust_lname'=>$request->customer_last_name,
            'st_com_name'=>$request->customer_name,
            'st_regions'=>$request->customer_region,
            'st_com_address'=>$request->customer_address,

            'st_con_person1'=>$request->persion1_name,
            'st_con_person1_email'=>$request->persion1_email,
            'st_con_person1_mobile'=>$request->persion1_mobile,

            'st_con_person2'=>$request->persion2_name,
            'st_con_person2_email'=>$request->persion2_email,
            'st_con_person2_mobile'=>$request->persion2_name,

            'st_cust_city'=>$request->customer_city,
            'cust_tin_no'=>$request->customer_name,
            'cust_pin_no'=>$request->gst_no,
            'in_pincode'=>$request->customer_pincode,
            'st_country'=>$request->customer_contry,
            'st_cust_state'=>$request->customer_state,
            'st_cust_mobile'=>$request->customer_mobile,
            'st_cust_email'=>$request->customer_name,
            'st_cust_email_cc'=>$request->customer_name,
            'in_branch'=>$request->branch_name,
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
        $this->validate($request,[
            'update_customer_name' => 'required|string|max:255',
            'update_customer_last_name'=>'required|string|max:255',
        ]);
        
        $check_status = Customer::where('in_cust_id', $id)->update([
            'st_cust_fname'=>$request->update_customer_name,
            'st_cust_lname'=>$request->update_customer_last_name,
            'st_com_name'=>$request->update_customer_name,
            'st_regions'=>$request->update_customer_region,
            'st_com_address'=>$request->update_customer_address,

            'st_con_person1'=>$request->update_persion1_name,
            'st_con_person1_email'=>$request->update_persion1_email,
            'st_con_person1_mobile'=>$request->update_persion1_mobile,

            'st_con_person2'=>$request->update_persion2_name,
            'st_con_person2_email'=>$request->update_persion2_email,
            'st_con_person2_mobile'=>$request->update_persion2_name,

            'st_cust_city'=>$request->update_customer_city,
            'cust_tin_no'=>$request->update_customer_name,
            'cust_pin_no'=>$request->update_gst_no,
            'in_pincode'=>$request->update_customer_pincode,
            'st_country'=>$request->update_customer_contry,
            'st_cust_state'=>$request->update_customer_state,
            'st_cust_mobile'=>$request->update_customer_mobile,
            'st_cust_email'=>$request->update_customer_name,
            'st_cust_email_cc'=>$request->update_customer_name,
            'in_branch'=>$request->update_branch_name,
            'owner_id'=>Auth::user()->id,
            'user_id'=>Auth::user()->id,
            'dt_created'=>Carbon::now(),
            'dt_modify'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
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
        $this->validate($request,[
            'owner_name' => 'required',
            'owner_desciption'=>'required',
        ]);
        $check_status = Owner::insertGetId([
            'owner_name'=>$request->owner_name,
            'owner_desc'=>$request->owner_desciption,
            'dt_created'=>Carbon::now(),
            'dt_modify'=>Carbon::now(),
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
        $this->validate($request,[
            'update_owner_name' => 'required',
            'update_owner_desciption'=>'required',
        ]);
        
        $check_status = Owner::where('id', $id)->update([
            'owner_name'=>$request->update_owner_name,
            'owner_desc'=>$request->update_owner_desciption,
            'dt_modify'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
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

