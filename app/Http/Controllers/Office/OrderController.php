<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Notify;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Owner;
use App\Models\Quatation;
use App\Models\QuatationAdd;
use App\Models\Courier;
use Carbon\Carbon;
use DataTables;
use Response;
use Config;
use PDF;
use View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function owner_list(){ 
        $owner = Owner::where('is_deleted', 0)->orderBy('owner_name', 'ASC')->get()->toArray();
		if(!empty($owner)){
            return $owner;
        }
		return false;
	}

    public function get_customer_by_id($id = null){
		$in_branch = \Auth::user()->branch_id;
        $c = Customer::where(['in_cust_id'=>$id, 'in_branch'=>$in_branch])->first();
        if(!empty($c)){
            $c = $c->toArray();
            return $c;
        }
        return false;
	}

    public function get_quotation_details($quotation_id = '', $in_cust_id = '', $in_product_id =''){
        $result = \DB::table('quotation_details')->where(['in_quot_id'=>$quotation_id, 'in_cust_id'=>$in_cust_id]);
		if($in_product_id != ''){
			$result->where('in_product_id', $in_product_id);
		}
		$result->where('flg_is_deleted', 0);
		$query = $result->get()->toArray();
        return $query;
	}

    public function get_product_list(){
        $product = Product::select('pro_id', 'st_part_No', 'st_pro_desc', 'in_pro_disc', 'fl_pro_price', 'in_cat_id', 'in_pro_qty', 'st_pro_maker')->where('is_deleted',0)->orderBy('st_part_No','ASC')->get();
        if(!empty($product)){
            $product  = $product->toArray();
            return $product;
        }
        return false;
	}

    public function get_quotation_by_id($in_quot_id){
        $quote_details = QuatationAdd::where('in_quot_id', $in_quot_id)->first()->toArray();
		if(!empty($quote_details)){
            return $quote_details;
        }
		return false;
	}
    public function updateOrder(Request $request, $in_quot_id){
        if(empty($in_quot_id)){
            return back()->with([
                'message' => 'Invalide Quatation id.',
            ]);
		}
        $existing_quote = QuatationAdd::where('in_quot_id', $in_quot_id)->first()->toArray();
        $in_cust_id_new = $existing_quote;
        $in_cust_id = $in_cust_id_new['in_cust_id'];
        $in_quot_num = $in_cust_id_new['in_quot_num'];
        $in_cust_id = $in_cust_id_new['in_cust_id'];
		$data = [];
		$data['quotation_info']	    =	$this->get_quotation_by_id($in_quot_id);
		$data['product_list']		=	$this->get_product_list();
		$data['quotation_details'] 	= 	$this->get_quotation_details($in_quot_id, $in_cust_id);
		$data['customer_info'] 		= 	$this->get_customer_by_id($in_cust_id);
        $data['owner']              =   $this->owner_list();
        $data['in_quot_id']         =   $in_quot_id;
        $data['in_quot_num']        =   $in_quot_num;
        $data['in_cust_id']         =   $in_cust_id;
        $data['owner_id']           =   $existing_quote['owner_id'];
        $indian_all_states          =   Config::get('constant.indian_all_states');
        $notify = Notify::get();
        $company = Customer::get();
        $product = Product::all('pro_id', 'st_part_No', 'str_igst_rate', 'fl_pro_price', 'in_pro_disc', 'st_pro_desc', 'stn_hsn_no', 'in_pro_qty', 'dt_price_update');
        $customer = $company;
        $currency = Config::get('constant.currency');
        $payment_term = Config::get('constant.payment_term');
        $courier = Courier::get();
        if(!empty($courier)){
            $courier = collect($courier)->pluck('st_courier_name', 'in_courier_id')->toArray();
        }else{
            $courier = '';
        }
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
        return view('office.order.order', compact('courier', 'data', 'notify', 'company', 'currency', 'payment_term', 'owner', 'cust_details', 'new_product_list','indian_all_states'));
    }
}
