<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Owner;
use App\Models\QuatationAdd;
use Carbon\Carbon;
use DataTables;
use Config;

class QuatationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showQuatation(){
        $notify = Notify::get();
        return view('office.quatation.show_quatation', compact('notify'));
    }
    public function addQuatation(){
        $notify = Notify::get();
        $company = Customer::get();
        $product = Product::all('pro_id', 'st_part_No', 'str_igst_rate', 'fl_pro_price', 'in_pro_disc', 'st_pro_desc', 'stn_hsn_no', 'in_pro_qty', 'dt_price_update');
        $customer = $company;
        $currency = Config::get('constant.currency');
        $payment_term = Config::get('constant.payment_term');
        $owner  = Owner::get();
        if(!empty($notify)){
            $notify = collect($notify)->pluck('name', 'id')->toArray();
        }else{
            $notify = '';
        }
        if(!empty($company)){
            $company = collect($company)->pluck('st_com_name', 'in_cust_id')->toArray();
        }else{
            $company = '';
        }
        if(!empty($owner)){
            $owner = collect($owner)->pluck('owner_name', 'id')->toArray();
        }else{
            $owner = '';
        }
        if(!empty($product)){
            $product =$product->toArray();
        }else{
            $product = '';
        }
        $new_product_list = [];
        $dup = [];
        if(!empty($product)){
            foreach($product as $pro){
                if(!isset($new_product[$pro['st_part_No']])){
                    $new_product_list[$pro['st_part_No']] = $pro;
                }else{
                    $dup[$pro['st_part_No']] = $pro;
                }
            }   
        }
        $cust_details = [];
        if(!empty($customer)){
            $company_name = $customer->pluck('st_com_name', 'in_cust_id', )->toArray();
            $c_person_name = $customer->pluck('st_con_person1', 'in_cust_id', )->toArray();
            
            $address = $customer->pluck('st_com_address', 'in_cust_id', )->toArray();
            $state = $customer->pluck('st_cust_state', 'in_cust_id', )->toArray();
            $city = $customer->pluck('st_cust_city', 'in_cust_id', )->toArray();
            $pincode = $customer->pluck('in_pincode', 'in_cust_id', )->toArray();
            $mobile = $customer->pluck('st_cust_mobile', 'in_cust_id', )->toArray();
            $email = $customer->pluck('st_cust_email', 'in_cust_id', )->toArray();
            $land_line = $customer->pluck('st_cust_mobile', 'in_cust_id', )->toArray();

            $cust_details['company_name'] = $company_name;
            $cust_details['c_person_name'] = $c_person_name;
            $cust_details['address'] = $address;
            $cust_details['state'] = $state;
            $cust_details['city'] = $city;
            $cust_details['pincode'] = $pincode;
            $cust_details['mobile'] = $mobile;
            $cust_details['email'] = $email;
            $cust_details['land_line'] = $land_line;

        }else{
            $customer = ''; 
        }
        return view('office.quatation.add_quatation', compact('notify', 'company', 'currency', 'payment_term', 'owner', 'cust_details', 'new_product_list'));
    }

    public function getQuatation(){
        $quatation = QuatationAdd::get();
        $customer  = Customer::get();
        $owner  = Owner::get();
        $branch = Config::get('constant.branch_wise');
        if(!empty($customer)){
            $customer = collect($customer)->pluck('st_cust_fname', 'in_cust_id')->toArray();
        }else{
            $customer = '';
        }

        if(!empty($owner)){
            $owner = collect($owner)->pluck('owner_name', 'id')->toArray();
        }else{
            $owner = '';
        }
        return Datatables::of($quatation)
           ->editColumn('dt_created', function ($quatation){
                $date = $quatation['dt_created'];
                if(!empty($date)){
                    return date('d-m-Y', strtotime($date));
                }
           })->editColumn('in_cust_id', function ($quatation) use($customer){
            if(isset($customer[$quatation['in_cust_id']])){
                return $customer[$quatation['in_cust_id']];
            }
        })->editColumn('owner_id', function ($quatation) use($owner){
            if(isset($owner[$quatation['owner_id']])){
                return $owner[$quatation['owner_id']];
            }
        })->editColumn('in_branch_id', function ($quatation) use($branch){
            if(isset($branch[$quatation['in_branch_id']])){
                return $branch[$quatation['in_branch_id']];
            }
        
        })->make(true);
    }

    public function allProduct(Request $request){
        $query = $request->get('term','');
        $products = Product::where('st_part_No','LIKE','%'.$query.'%')->orWhere('st_pro_desc','LIKE','%'.$query.'%')->get();
        if(!empty($products)){
            $data = collect($products)->pluck('st_part_No')->toArray();
            if(count($data)){
                return $data;
            }else{
                return ['message'=>'No Result Found'];
    
            }
        }else{
            return ['message'=>'No Result Found'];
        }
    }

    public function filterProduct(Request $request){
        if(!empty($request->part_no)){
            return true;
        }

    }
}
