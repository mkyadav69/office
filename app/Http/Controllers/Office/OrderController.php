<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\QoutationDetails;
use Illuminate\Http\Request;
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

    public function delete_pending_quotation($id){
        $update_pending_infog  = PendingQuotation::where('stn_qtn_ord_no', $id)->update(['is_deleted'=>1]);
		if(!empty($update_pending_infog)){
            return true;
        }
		return false;
	}

    public function update_pending_order($id){
        $update_pending_status  = QuatationAdd::where('in_quot_num', $id)->update(['is_order_pending'=>1]);
		if(!empty($update_pending_status)){
            return true;
        }
		return false;
	}

    public function get_order_details($order_id){
        $get_order_details = OrderDetails::where(['in_order_id'=>$order_id, 'flg_deleted'=>0])->get();
        if(!empty($get_order_details)){
           return $get_order_details = $get_order_details->toArray();
        }
	}

    public function get_order_info($order_id, $in_cust_id){
        $get_order = Order::where(['in_order_id'=>$order_id, 'in_cust_id'=>$in_cust_id, 'flg_deleted'=>0])->first();
        if(!empty($get_order)){
           return $get_order = $get_order->toArray();
        }
    }


    public function generate_order_no($branchname, $in_branch_id,$quotation_create_date, $generate_No_for = ""){
        $initial3latters = substr($branchname, 0, 3);
        $quote_no = QuatationAdd::where(['in_branch_id'=>$in_branch_id , 'is_deleted'=>0, 'dt_date_created'=>date('Y-m-d 00:00:00',strtotime($quotation_create_date)), 'dt_date_created'=>date('Y-m-d 23:59:59',strtotime($quotation_create_date))])->get();
		$flg_type = '';
		if($generate_No_for != ""){
			$flg_type = "order-";
		}
     
		$date = date('Ymd', strtotime($quotation_create_date));
		if(!empty($quote_no)){	
			$number = count($quote_no)+1;
			$unique_quote_no = $initial3latters."/".$date."/".$flg_type.$number;
		}else{
			$unique_quote_no = $initial3latters."/".$date."/".$flg_type."1";
		}
		return $unique_quote_no;
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

    public function get_PDF_BillAddress(){
        $result = Quatation::select('stn_branch_add')->where(['is_deleted'=>0, 'int_branch_id'=> \Auth::user()->branch_id])->first();
		$query = $result;
        if(!empty($query)){
            return $query;
        }
		return false;
	}

    public function get_PDF_format_by_id(){
        $in_branch = \Auth::user()->branch_id;
        $result = \DB::table('tbl_quot_format')->where(['is_deleted'=>0, 'int_branch_id'=>$in_branch])->get();
		if(!empty($result)){
			return $result;
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

    public function showOrder(Request $request){
        $customer  = Customer::get()->toArray();
        if(!empty($customer)){
            $customer = collect($customer)->pluck('st_com_name', 'in_cust_id')->toArray();
        }else{
            $customer = [];
        }
        return view('office.order.show_order', compact('customer'));
    }
    public function getOrder(Request $request){
        $customer  = Customer::get()->toArray();
        if(!empty($customer)){
            $customer = collect($customer)->pluck('st_com_name', 'in_cust_id')->toArray();
        }else{
            $customer = '';
        }
        $orders = Datatables::of(Order::query()->take(1000));
        if(Auth::user()->hasPermission('update_quatationadd')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button></div>';
        }
        
        if(Auth::user()->hasPermission('delete_quatationadd')){
            $action_btn[] = '<div class="table-data-feature"><button row-id="" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>';
        }

        if(Auth::user()->hasPermission(['update_quatationadd', 'delete_quatationadd'])){
            $orders->addColumn('actions', function ($orders) use($action_btn){
                return '<div class="table-data-feature">'.implode('', $action_btn).'</div>';
               
            })->setRowAttr([
                'data-id' => function($orders) {
                    return $orders->system_id;
                }
            ]);
        }else{
            $orders->addColumn('actions', function ($orders){
                return '<div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></button></div>';
            })->setRowAttr([
                'data-id' => function($orders) {
                    return $orders->system_id;
                }
            ]);
        }
        $orders->addColumn('reason', function ($orders) use($action_btn){
            return '<div class="table-data-feature"><div class="table-data-feature text-secondary view">View<button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye text-secondary"></i></button></div><div class="table-data-feature add text-warning"> &nbsp <b> <h4>/</h4> </b> &nbsp Add More</div> <div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="Add More"><i class="fa fa-box text-warning"></i></button></div></div>';
        })->setRowAttr([
            'data-id' => function($orders) {
                return $orders->system_id;
            }
        ])->addColumn('status', function ($orders) use($action_btn){
            if($orders['is_order_pending'] == 0){
                return '<div class="table-data-feature text-primary generate_order">Generate Order<button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="Generate Order"><i class="fa fa-shopping-cart text-primary"></i></button></div>';
            }
            if($orders['is_order_pending'] == 1){
                return '<div class="table-data-feature" style="color: brown">Order Generated<button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="Generate Order"><i class="fa fa-shopping-cart" style="color: brown"></i></button></div>';
            }

        })->setRowAttr([
            'data-id' => function($orders) {
                return $orders->system_id;
            }
        ])->addColumn('reason', function ($orders) use($action_btn){
            return '<div class="table-data-feature"><div class="table-data-feature add text-warning">Add Reason</div> <div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="Add More"><i class="fa fa-box text-warning"></i></button></div></div>';
        })->setRowAttr([
            'data-id' => function($orders) {
                return $orders->system_id;
            }
        ])->rawColumns(['actions' => 'actions', 'reason' => 'reason', 'status'=>'status']);

        $orders->editColumn('dt_date_created', function ($orders) {
            $date = $orders['dt_date_created'];
            if(!empty($date)){
                return date('d-m-Y', strtotime($date));
            }
        })->editColumn('in_cust_id', function ($orders) use($customer){
            if(isset($customer[$orders['in_cust_id']])){
                    return $customer[$orders['in_cust_id']];
                }
        })->make(true);
        

        return $orders->make(true);
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
        $data['currency']           =  $existing_quote['st_currency_applied'];
        $data['st_enq_ref_number']   =  $existing_quote['st_enq_ref_number'];
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

    public function orderPreview(Request $request){
        $pdf = \App::make('dompdf.wrapper');
        $sel_prods_details = $request->sel_prods_details;
        $quotation_info = $request->quotation_info;
        if(!empty($quotation_info)){
            $val = [
                "st_shiping_add" => 'required',
                "st_shiping_city" =>'required',
                "st_shiping_state" => 'required',
                "st_shiping_pincode" => 'required',
                "st_shipping_email" =>'required',
                "st_shipping_phone" => 'required',
                "st_enq_ref_number" => 'required',
                'shipping_lanline' => 'required',
                "st_landline" => 'required',
                'product_search' => 'required',
                'prod_qty' => 'required',
            ];
            if(isset($quotation_info['in_quot_id']) && !empty($quotation_info['in_quot_id'])){
                unset($val['product_search']);
            }
            $validator1 = Validator::make($quotation_info, $val);

        }
        $msg2 = $validator1->getMessageBag()->toArray();
        $customer_info = $request->customer_info;
        if(!empty($customer_info)){
            $validator2 = Validator::make($customer_info, [
                "st_com_name" => 'required',
                'order_no' => 'required',
                'order_date' => 'required',
                "auto_pop_cust_name" => 'required',
                "st_cust_mobile" => 'required',
                "auto_pop_state" => 'required',
                "preparing_by" => 'required',
                "lead_from" => 'required',
                'auto_pop_addr' =>'required',  
                'auto_pop_state' =>'required',  
                'auto_pop_city'   =>'required',
                'auto_pop_pincod' =>'required',
                'auto_pop_phone'   =>'required',
                'auto_pop_email'   =>'required',
                'auto_pop_landline' =>'required',
                'ext_note' =>'required'
            ]);
        }
        $msg3 = $validator2->getMessageBag()->toArray();
        if ($validator1->fails() || $validator2->fails()) {
            $msg = $msg2+$msg3;
            return Response::json(array(
                'success' => false,
                'errors' => $msg
            ), 400);
        }
        $result = [];
        $billing_address  = $request->quotation_info;
        $format = $billing_address['bill_add_id'];
        $result['order_details']    = $request->sel_prods_details;
		$result['customer_info'] 		= $request->customer_info;
		$result['order_info'] 		    = $request->quotation_info;
		$result['format']				= $format;
		$result['BillAddress']			= "adress";
        $cur = Config::get('constant.currency');
        $currencyCodes = Config::get('constant.currencyCodes');
        $qt_info = $request->quotation_info;
        $c_format = $qt_info['currency'];
        $result['currency']  = $currencyCodes[$cur[$c_format]];
        $data['order_data'] = View::make("office.order.preview_order", compact('result'))->render();
        return json_encode($data);
    }

    public function storeUpdatedOrder(Request $request){
        $order_data = $request->all();
        $data =	[];
        $admin_user_id = \Auth::user()->id;
        $quotation_prod_details_arr = $request->sel_prods_details;
        if(!empty($request->quotation_info)){
            $qt_info = $request->quotation_info;
        }
        if(!empty($request->customer_info)){
            $cust_info = $request->customer_info;
        }

        # Genarate Order id
        $branch = Config::get('constant.branch_wise');
        $state = Config::get('constant.indian_all_states');
        
        $in_branch_id = \Auth::user()->branch_id;
        $branchname = substr(str_shuffle(str_repeat($branch[$in_branch_id], 5)), 0, 3); 
        $quotation_create_date = date('Y-m-d', strtotime($cust_info['order_date']));
        $generate_no =	$this->generate_order_no($branchname, $in_branch_id, $quotation_create_date);
        $pdfFilePath = "order_".time()."_".date('dmy').".pdf";
       

        $order_info	=	[
            'in_uniq_order_id'	        =>	$generate_no,
            'in_qoute_uniqu_id'         =>	trim(!empty($qt_info['in_quot_num']) ? $qt_info['in_quot_num'] : ''),
            'in_cust_id'                =>  $cust_info['cust_id'],
            'st_cust_order_num'         =>  !empty($cust_info['order_no'])  ? $cust_info['order_no'] : '' ,
            'dt_cust_order_date'        =>   date('Y-m-d', strtotime($cust_info['order_date'])),
            'st_ord_ship_adds'          =>  !empty($qt_info['st_shiping_add']) ? $qt_info['st_shiping_add'] : '',
            'st_ord_ship_state'         =>  !empty($qt_info['st_shiping_state']) ? $state[$qt_info['st_shiping_state']] : '',
            'st_ord_ship_pincode'       =>  !empty($qt_info['st_shiping_pincode']) ? $qt_info['st_shiping_pincode'] : '',
            'st_ord_ship_city'          =>  !empty($qt_info['st_shiping_city']) ? $qt_info['st_shiping_city'] : '',
            'in_ord_ship_tel'           =>  !empty($qt_info['st_shipping_phone']) ? $qt_info['st_shipping_phone'] : '',
            'st_landline'               =>  !empty($qt_info['shipping_lanline']) ? $qt_info['shipping_lanline'] : '',
            'st_ord_ship_email'         =>  !empty($qt_info['st_shipping_email']) ? $qt_info['st_shipping_email'] : '',
            'flg_same_as_bill_add'      =>  !empty($qt_info['flg_same_as_bill_add']) ? $qt_info['flg_same_as_bill_add'] : '',
            'st_qoute_enq_no'           =>  !empty($qt_info['st_enq_ref_number']) ? $qt_info['st_enq_ref_number'] : '',
            'st_cont_person_for_payment'=>  trim(!empty($cust_info['auto_pop_cust_name']) ? $cust_info['auto_pop_cust_name'] : ''),
            'int_cont_num_for_payment'  =>  !empty($qt_info['st_shipping_phone']) ? $qt_info['st_shipping_phone'] : '',
            'flt_ord_net_total' 		=>  !empty($qt_info['fl_nego_amt']) ? $qt_info['fl_nego_amt'] : 0,
            'flt_ord_saletax_id' 		=>  0,
            'flt_ord_saletax_amt' 		=>  !empty($qt_info['fl_sales_tax_amt']) ? $qt_info['fl_sales_tax_amt'] : 0,
            'flt_ord_frig_pack' 		=>  0,
            'flt_ord_total' 		    =>  ceil(!empty($qt_info['fl_nego_amt']) ? $qt_info['fl_nego_amt'] : 0),
            'in_del_period' 		    =>  30 ,// static,
            'st_currency_applied' 		=>  !empty($qt_info['currency']) ? $qt_info['currency'] : 0,
            'int_ord_status' 		    =>  0,
            'log_in_id'			        =>  $admin_user_id,
            'stn_pdf_name'               => $pdfFilePath,
            'in_branch_id'              =>  $in_branch_id,
            'lead_from' 			    =>  !empty($cust_info['lead_from'])  ? $cust_info['lead_from'] : '' ,
            'dt_modify' 			    =>  Carbon::now(),
            'dt_created'                =>  Carbon::now(),
        ];
                                
        # Update customer 
        $update_customer_array = [
            'st_com_address'    => 	trim(!empty($cust_info['auto_pop_addr']) ? $cust_info['auto_pop_addr'] : ''),
            'st_cust_city'      => 	trim(!empty($cust_info['auto_pop_city']) ? $cust_info['auto_pop_city'] : ''),
            'st_con_person1'    =>  trim(!empty($cust_info['auto_pop_cust_name']) ? $cust_info['auto_pop_cust_name'] : ''),
            'in_pincode'        => 	trim(!empty($cust_info['auto_pop_pincod']) ? $cust_info['auto_pop_pincod'] : ''),
            'st_cust_state'     => 	trim(!empty($cust_info['auto_pop_state']) ? $cust_info['auto_pop_state'] : ''),
            'st_cust_mobile'    => 	trim(!empty($cust_info['st_cust_mobile']) ? $cust_info['st_cust_mobile'] : ''),
            'st_cust_email'     => 	trim(!empty($cust_info['auto_pop_email']) ? $cust_info['auto_pop_email'] : ''),
        ];
        $Customer  = Customer::where('in_cust_id', $cust_info['cust_id'])->update($update_customer_array);
        $inserted_order_id = Order::insertGetId($order_info); 
        $this->delete_pending_quotation($qt_info['in_quot_num']);
        $this->update_pending_order($qt_info['in_quot_num']);
        $totalproarray = 0;
        
        if($inserted_order_id > 0){
            foreach($quotation_prod_details_arr as $quotation_details_k => $quotation_details_v){
                $quotation_details_v['in_quot_id'] = $qt_info['in_quot_id'];
                $quotation_details_v['in_cust_id'] = $cust_info['cust_id'];
                # Quotation details
                $qoute_details[$quotation_details_k] = $quotation_details_v;
                # Order details
                $insert_order_detail_arr = [
                    'in_order_id'		    => $inserted_order_id,
                    'in_ord_prod_id'	    => $quotation_details_v['in_product_id'],
                    'in_ord_pro_desc'	    => $quotation_details_v['st_product_desc'],
                    'in_ord_pro_maker'	    => $quotation_details_v['st_maker'],
                    'in_ord_pro_qty'	    => $quotation_details_v['in_pro_qty'],
                    'flt_ord_pro_price'     => $quotation_details_v['fl_pro_unitprice'],
                    'flt_ord_pro_disct'     => $quotation_details_v['fl_discount'],
                    'flt_ord_pro_net_price' => $quotation_details_v['fl_net_price'],
                    'flt_ord_pro_row_total' => $quotation_details_v['fl_row_total'],
                    'in_ord_pro_bal_qty'    => $quotation_details_v['in_pro_qty'],
                    'is_order_type'         => 1,
                    'st_part_no'		    => $quotation_details_v['st_part_no'],
                    'in_ord_delivery_period'=> $quotation_details_v['in_pro_deli_period'],
                    'in_igst_rate'          => $quotation_details_v['in_igst_rate'],
                    'in_ord_pro_status'     => 0,
                    'flg_partord_status'    => 0,
                ];
                $inserted_orders_details = OrderDetails::insert($insert_order_detail_arr);
			}
            $status = QoutationDetails::where(['in_quot_id'=> $qt_info['in_quot_id'], 'in_cust_id'=> $cust_info['cust_id']])->delete();
            if($status == true){
                $add_qoute_info = QoutationDetails::insert($qoute_details);
            }

            $cc_cust_emails = array();
            $data['order_details'] 		= $this->get_order_details($inserted_order_id);
            $data['order_info']			= $this->get_order_info($inserted_order_id, $cust_info['cust_id']);
            $data['customer_info'] 		= $this->get_customer_by_id($cust_info['cust_id']);
            $data['format']				= $this->get_PDF_format_by_id();
            $data['BillAddress']		= $this->get_PDF_BillAddress();
            $date['orderCreateDate']    = date('d-m-Y', strtotime(str_replace('/', '-', Carbon::now())));
            $data['preparing_by']       =  $cust_info['preparing_by'];
            $cur = Config::get('constant.currency');
            $currencyCodes = Config::get('constant.currencyCodes');
            $c_format = $qt_info['currency'];
            if(!empty($c_format)){
                $data['currency']  = $currencyCodes[$cur[$c_format]];
            }else{
                $data['currency'] = '';
            }

            # Generate PDF
            $year = date("Y");    
            $path = 'pdf_'.$year;
            if(file_exists($path)==false){
                mkdir($path,0777);
            }
            $path = public_path($path.'/');
            $pdf = PDF::loadView('email.view_order_pdf', compact('data'))->setPaper('a4', 'landscape');
            $pdf->save($path.$pdfFilePath);
            $pdf = public_path($path.$pdfFilePath);
            # Send Mail
            // $cc_cust_emails = [];
            // $cc_cust_emails = explode("," , $data['customer_info']['st_cust_email_cc']);
            // $cc_admin_emails = explode("," , $this->session->userdata('st_cc_email'));
            // $this->email->from('speed@chromatographyworld.com', 'Quotation Attached');
            // $this->email->to($this->session->userdata('st_admin_email'));
            // $this->email->cc($cc_admin_emails);
            // $this->email->bcc($cc_admin_emails);
            // $this->email->subject('Quotation Attached ');
            // $emailbody = "Dear Sir/Madam,<br><br>";
            // $emailbody .= "We thank you for your valuable enquiry.<br><br>";
            // $emailbody .= "Please find an attached Quotation in response to your enquiry. <br><br>";
            // $emailbody .= "While we assure you of our best services, we look forward to your  valuable  order.<br><br>";
            // $emailbody .= "Thank You.<br><br>";
            // $this->email->message($emailbody);
            // $this->email->attach("quotationpdf/".$pdfFilePath);
            // $this->email->send();
            return response()->json(['code'=>200, 'success' => 'Order generated successfully.']);
        }else{
            return response()->json(['code'=>400, 'error' => 'Something went wrong while adding quotation, please try again.']);
        }			
    }
}
