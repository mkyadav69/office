<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Owner;
use Carbon\Carbon;
use DataTables;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    public function showCustomer(){
        return view('office.customer.customer');
    }

    public function storeCustomer(Request $request){
        $this->validate($request,[
            'customer_name' => 'required|string|max:255',
            'customer_last_name'=>'required|string|max:255',
        ]);
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
            'cust_pin_no'=>$request->customer_pincode,
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
            'dt_modify'=>Carbon::now(),
        ]);

       
        if(!empty($check_status)){
            return back()->with([
                'message' => 'Customer created successfully !',
            ]);
        }
    }

    public function getCustomer(Request $request){
        return Datatables::of(Customer::query())->make(true);
    }


    public function showOwner(){
        return view('office.customer.owner');
    }

    public function storeOwner(Request $request){
        $this->validate($request,[
            'owner_name' => 'required|string|max:255',
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
        return Datatables::of(Owner::query())->make(true);
    }


}

