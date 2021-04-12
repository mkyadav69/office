<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QoutationDetails;
use App\Models\Notify;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Owner;
use App\Models\Quatation;
use App\Models\QuatationAdd;
use App\Models\PendingQuotation;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Courier;
use Carbon\Carbon;
use DataTables;
use Response;
use Config;
use PDF;
use View;

class PartialOrderController extends Controller
{
    public function viewPartialOrder(Request $request, $in_order_id){
        if(empty($in_order_id)){
            return back()->with([
                'message' => 'Invalide order id.',
            ]);
		}
        $data = [];
        $existing_order = Order::where('in_order_id', $in_order_id)->first()->toArray();
        $data['quotaion_no'] = $existing_order['in_qoute_uniqu_id'];
        $data['contact_person'] = $existing_order['st_cont_person_for_payment'];
        $customer = Customer::where('in_cust_id', $existing_order['in_cust_id'])->first();
        if(!empty($customer)){
            $customer = $customer->toArray();
            $data['customer_id']        =  $customer['in_cust_id'];
            $data['customer_name']      =  $customer['st_cust_fname'];
            $data['comapany_name']      =  $customer['st_com_name'];
        }
       
        $check_address_as_same = $existing_order['flg_same_as_bill_add'];
        $data['shiping_addres']     = $existing_order['st_ord_ship_adds'];
        $data['shiping_state']      = $existing_order['st_ord_ship_state'];
        $data['shiping_city']       = $existing_order['st_ord_ship_city'];
        $data['shiping_pincode']    = $existing_order['st_ord_ship_pincode'];
        $data['shiping_phone']      = $existing_order['in_ord_ship_tel'];
        $data['shiping_landline']   = $existing_order['st_landline'];
        $data['shiping_email']   = $existing_order['st_ord_ship_email'];
        if($check_address_as_same == 1){
            $data['billing_addres']     =   $data['shiping_addres'];
            $data['billing_state']      =   $data['shiping_state'];  
            $data['billing_city']       =   $data['shiping_city']; 
            $data['billing_pincode']    =   $data['shiping_pincode'];
            $data['billing_phone']      =   $data['shiping_phone'];
            $data['billing_landline']   =   $data['shiping_landline'];
            $data['billing_email']      =   $data['shiping_email'];
        }else{
            $get_billing_add_details = $customer->toArray();
            $data['billing_addres']     = $get_billing_add_details['st_com_address'];
            $data['billing_state']      = $get_billing_add_details['st_cust_state'];
            $data['billing_city']       = $get_billing_add_details['st_cust_city'];
            $data['billing_pincode']    = $get_billing_add_details['in_pincode'];
            $data['billing_phone']      = $get_billing_add_details['st_cust_mobile'];
            $data['billing_landline']   = $get_billing_add_details['st_cust_mobile'];
            $data['billing_email']      = $get_billing_add_details['st_cust_email'];
        }
        $data['flag_same_as']   = $existing_order['flg_same_as_bill_add'];
        $order_details = OrderDetails::where('in_order_id', $in_order_id)->get();
        if($order_details){
            $order_details = $order_details->toArray();
          
        }
        $indian_all_states      =   Config::get('constant.indian_all_states');
        $payment_term = Config::get('constant.payment_term');
        $flip_indian_all_states = array_flip($indian_all_states);
        $courier = Courier::get();
        if(!empty($courier)){
            $courier = collect($courier)->pluck('st_courier_name', 'in_courier_id')->toArray();
        }else{
            $courier = '';
        }
        return view('office.order.partial_order', compact('data', 'order_details', 'indian_all_states', 'flip_indian_all_states', 'payment_term', 'courier'));
    }
}
