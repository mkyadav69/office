<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Owner;
use App\Models\Quatation;
use App\Models\QuatationAdd;
use Carbon\Carbon;
use DataTables;
use Response;
use Config;
use PDF;
use View;

class QuatationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_quotation_details($quotation_id = '', $in_cust_id = '', $in_product_id =''){
        $result = \DB::table('quotation_details')->where(['in_quot_id'=>$quotation_id, 'in_cust_id'=>$in_cust_id]);
		if($in_product_id != ''){
			$result->where('in_product_id', $in_product_id);
		}
		$result->where('flg_is_deleted', 0);
		$query = $result->get();
        return $query;
	}

    public function get_quotation_info($quotation_id = '', $in_cust_id = '', $quotation_unoque_id = ''){
		$result = \DB::table('tbl_quotation');
        $c = QuatationAdd::where(['in_quot_id'=>$quotation_id, 'in_cust_id'=>$in_cust_id])->first();
        if(!empty($c)){
            $c = $c->toArray();
            return $c;
        }
        return false;
	}

    public function get_customer_by_id($id = null){
		$in_branch = 7; //$this->session->userdata('in_branch');
        $c = Customer::where(['in_cust_id'=>$id, 'in_branch'=>$in_branch])->first();
        if(!empty($c)){
            $c = $c->toArray();
            return $c;
        }
        return false;
	}

    public function get_product_list(){
        $product = Product::select('pro_id', 'st_part_No', 'st_pro_desc', 'in_pro_disc', 'fl_pro_price', 'in_cat_id', 'in_pro_qty', 'st_pro_maker')->where('is_deleted',0)->orderBy('st_part_No','ASC')->get();
        if(!empty($product)){
            $product  = $product->toArray();
            return $product;
        }
        return false;
	}

    public function get_notify_users_id($id=null) {
        $notify_users = Notify::where('is_deleted', 0);
        if($id != null && $id != ''){ 
            $notify_users->where('id',$id);
        } else{
            $notify_users->where('branch_id',1); 
            // $notify_users->where('branch_id',$this->session->userdata('branchname')); 
            return $notify_users = $notify_users->get()->toArray();
        }
		return false;
	}

    public function get_PDF_BillAddress(){
        $result = Quatation::select('stn_branch_add')->where(['is_deleted'=>0, 'int_branch_id'=>1 /* get from session*/ ])->first();
		$query = $result;
        if(!empty($query)){
            return $query;
        }
		return false;
	}

    public function get_PDF_format_by_id($id){
        $result = \DB::table('tbl_quot_format')->where(['is_deleted'=>0, 'int_branch_id'=>$id /* get from session*/ ])->get();
		if(!empty($result)){
			return $result;
		}
		return false;
	}

    public function owner_list(){ 
        $owner = Owner::where('is_deleted', 0)->orderBy('owner_name', 'ASC')->get()->toArray();
		if(!empty($owner)){
            return $owner;
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

    public function get_banks($bank_id = ''){
        $result = \DB::table('tbl_bank');
		if($bank_id != '')
		    $result->where('in_bank_id', $bank_id);
		$query = $result->get();
		if(!empty($query)){	
			if($bank_id != '')
			    $result = $query->toArray();
			else
			    $result = $query;
		}
		return $result;
	}

    public function insert_quotation_deatal($insert_array){
		return \DB::table('quotation_details')->insert($insert_array);
	}

    public function insert_quot_reason($insert_quot_reason){ 
        $res = \DB::table('tbl_pending')->insert($insert_quot_reason);
        if(!empty($res)){
            return $res ;
        }
		return false;
	}

    public function generate_quot_no($branchname, $in_branch_id,$quotation_create_date, $generate_No_for = ""){
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

    public function showQuatation(){
        $notify = Notify::get();
        return view('office.quatation.show_quatation', compact('notify'));
    }

    public function addQuatation(){
        $indian_all_states = Config::get('constant.indian_all_states');
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
        return view('office.quatation.add_quatation', compact('notify', 'company', 'currency', 'payment_term', 'owner', 'cust_details', 'new_product_list','indian_all_states'));
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
           ->editColumn('dt_date_created', function ($quatation){
                $date = $quatation['dt_date_created'];
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

    public function previewQuatation(Request $request){
        $pdf = \App::make('dompdf.wrapper');
        $sel_prods_details = $request->sel_prods_details;
        if(!empty($sel_prods_details)){
            $validator = Validator::make($sel_prods_details[0], [
                'in_cust_id' => 'required',
            ]);
        }
        $msg1 = $validator->getMessageBag()->toArray();
        $quotation_info = $request->quotation_info;
        if(!empty($quotation_info)){
            $validator1 = Validator::make($quotation_info, [
                "st_shiping_add" => 'required',
                "st_shiping_city" =>'required',
                "st_shiping_state" => 'required',
                "st_shiping_pincode" => 'required',
                "st_shipping_email" =>'required',
                "st_shipping_phone" => 'required',
                "st_enq_ref_number" => 'required',
                'shipping_lanline' => 'required',
                "dt_ref" => 'required',
                "st_landline" => 'required',
                'product_search' => 'required',
                'prod_qty' => 'required',
            ]);

        }
        $msg2 = $validator1->getMessageBag()->toArray();
        $customer_info = $request->customer_info;
        if(!empty($customer_info)){
            $validator2 = Validator::make($customer_info, [
                "st_com_name" => 'required',
                "auto_pop_cust_name" => 'required',
                "st_cust_mobile" => 'required',
                "auto_pop_state" => 'required',
                "preparing_by" => 'required',
                "lead_from" => 'required',
                'notify_group' => 'required',
                'select_owner' =>'required',
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
        if ($validator->fails() || $validator1->fails() || $validator2->fails()) {
            $msg = $msg1+$msg2+$msg3;
            return Response::json(array(
                'success' => false,
                'errors' => $msg
            ), 400);
        }
        $result = [];
        $billing_address  = $request->quotation_info;
        $format = $billing_address['bill_add_id'];
        $result['quotation_details']    = $request->sel_prods_details;
		$result['customer_info'] 		= $request->customer_info;
		$result['quotation_info'] 		= $request->quotation_info;
		$result['format']				= $format;
		$result['BillAddress']			= "adress";
        $cur = Config::get('constant.currency');
        $qt_info = $request->quotation_info;
        $c_format = $qt_info['currency'];
        $result['currency']  = $cur[$c_format];
        $data['quotation_data'] = View::make("office.quatation.preview_quatation", $result)->render();
        return json_encode($data);
    }

    public function storeQuatation(Request $request){
        # Get Static Data
        $data =	[];
		$data['error_msg'] 		    =   '';	
		$data['card_err']		    =   '';
		$data['taxes']			    =	1;
		$data['banks']			    =	null;
        
        # Get Quotation Data
        $admin_user_id = \Auth::user()->id;
        $quotation_prod_details_arr = $request->sel_prods_details;
        if(!empty($request->quotation_info)){
            $qt_info = $request->quotation_info;
        }
        if(!empty($request->customer_info)){
            $cust_info = $request->customer_info;
        }
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $in_branch_id = 1; //session branch id;
        $branchname = substr(str_shuffle(str_repeat($pool, 5)), 0, 3); //session branch name;
        $quotation_create_date = date('Y-m-d', strtotime($qt_info['dt_ref']));
        $generate_quot_no =	$this->generate_quot_no($branchname, $in_branch_id, $quotation_create_date);
        $pdfFilePath = "quotation_".time()."_".date('dmy').".pdf";
        $quotation_info	=	[
            'in_quot_num'				=>	$generate_quot_no,
            'in_cust_id'				=>	trim(!empty($cust_info['customer_id']) ? $cust_info['customer_id'] : ''),
            'st_shiping_add'			=>	!empty($qt_info['st_shiping_add']) ? $qt_info['st_shiping_add'] : '',
            'st_shiping_city'			=>	trim(!empty($qt_info['st_shiping_city']) ? $qt_info['st_shiping_city'] : ''),
            'st_shiping_state'			=>	trim(!empty($qt_info['st_shiping_state']) ? $qt_info['st_shiping_state'] : ''),
            'st_shiping_pincode'        =>	!empty($qt_info['st_shiping_pincode']) ? $qt_info['st_shiping_pincode'] : '',
            'flg_same_as_bill_add'      =>	trim(!empty($qt_info['st_shiping_pincode']) ? $qt_info['st_shiping_pincode'] : ''),
            'st_shipping_phone'			=>	trim(!empty($qt_info['st_shipping_phone']) ? $qt_info['st_shipping_phone'] : ''), 
            'st_shipping_email'			=>	trim(!empty($qt_info['st_shipping_email']) ? $qt_info['st_shipping_email'] : ''),
            'st_landline'				=>	trim(!empty($qt_info['shipping_lanline']) ? $qt_info['shipping_lanline'] : ''),
            'st_enq_ref_number'			=>	trim(!empty($qt_info['st_enq_ref_number']) ? $qt_info['st_enq_ref_number'] : ''),
            'st_tin_number'				=>	'27700707469',
            'st_pay_turm'				=>	trim(!empty($qt_info['payment_turm']) ? $qt_info['payment_turm'] : ''),
            'st_ext_note'				=>	trim(!empty($cust_info['ext_note']) ? $cust_info['ext_note'] : ''),
            'fl_sub_total'				=>  trim(!empty($qt_info['fl_nego_amt']) ? $qt_info['fl_nego_amt'] : ''),
            'fl_sales_tax'				=>	0,
            'fl_sales_tax_amt'			=>	0,
            'in_sal_tax_id'				=>	0,
            'final_amount'				=>	trim(!empty($qt_info['fl_nego_amt']) ? $qt_info['fl_nego_amt'] : ''),
            'fl_nego_amt'				=>	trim(!empty($qt_info['fl_nego_amt']) ? $qt_info['fl_nego_amt'] : ''),
            'in_deliv_priod'			=>	30,
            'st_ref_through'			=>	$qt_info['st_enq_ref_number'],
            'lead_from'                 =>	trim(!empty($cust_info['lead_from']) ? $cust_info['lead_from'] : ''),
            'notify_group'              =>	trim(!empty($cust_info['notify_group']) ? $cust_info['notify_group'] : ''),
            'owner_id'                  =>	trim(!empty($cust_info['select_owner']) ? $cust_info['select_owner'] : ''),
            'in_tax_branch_id'			=>	1, //trim(!empty($qt_info['bill_add_id']) ? $qt_info['bill_add_id'] : ''),
            'dt_ref'                    =>	$quotation_create_date,
            'in_login_id'				=>	$admin_user_id,
            'in_branch_id'				=>	$in_branch_id,
            'stn_pdf_name'				=>	$pdfFilePath,
            'st_currency_applied'       =>	trim(!empty($qt_info['currency']) ? $qt_info['currency'] : ''),
            'dt_date_created'			=>	Carbon::now(),
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
        $Customer  = Customer::where('in_cust_id', $cust_info['customer_id'])->update($update_customer_array);
        $inserted_quotation_id = QuatationAdd::insertGetId($quotation_info); 
        $totalproarray = 0;
        
        # Update Reason
        if($inserted_quotation_id != FALSE && $inserted_quotation_id > 0){
            $insert_quot_reason	=	[
                'int_qd_no'		=>	$inserted_quotation_id,
                'stn_qtn_ord_no'=>	$generate_quot_no,
                'stn_amt'		=>	ceil(trim(!empty($qt_info['fl_nego_amt']) ? $qt_info['fl_nego_amt'] : '')),
                'dt_date'		=>	date('Y-m-d h:i:s'),
                'int_cust_id'	=>	$cust_info['customer_id'],
                'stn_reason'	=>	'Open',
                'int_reason_mode'	=> 	0,
                'int_branch_id'	=>	1, // get branch name from session,
                'user_id'		=>	\Auth::user()->id,
                'notify_group'  =>  trim(!empty($cust_info['notify_group']) ? $cust_info['notify_group'] : ''),
                'dt_created'	=>	$quotation_create_date, 
                'dt_modify'		=>	$quotation_create_date 
            ];        
            $this->insert_quot_reason($insert_quot_reason);
            $quotation_details_arr = [
                'in_cust_id' => trim($cust_info['customer_id']),
                'in_quot_id' => $inserted_quotation_id
            ];
            foreach($quotation_prod_details_arr as $key => $val_arr) {
                foreach($val_arr as $val_arr_key => $val_arr_val) {
                    $quotation_details_arr[$val_arr_key] = $val_arr_val;
                }
                $inserted_quotation_detail_id = $this->insert_quotation_deatal($quotation_details_arr);
            }
            $data['quotation_details'] = $this->get_quotation_details($inserted_quotation_id, $cust_info['customer_id']);
            $data['quotation_info'] = $this->get_quotation_info($inserted_quotation_id, $cust_info['customer_id']);
            $data['customer_info'] = $this->get_customer_by_id($cust_info['customer_id']);
            $data['tax_text'] = 0; 
            $data['preparing_by'] = trim($cust_info['preparing_by']);
            $data['format']	= $this->get_PDF_format_by_id($qt_info['bill_add_id']);
            dd($data['format']);
            $data['BillAddress'] = $this->get_PDF_BillAddress();
            $cur = Config::get('constant.currency');
            $qt_info = $request->quotation_info;
            $c_format = $qt_info['currency'];
            $data['currency']  = $cur[$c_format];
            # Generate PDF
            $year = date("Y");    
            $path = 'pdf_'.$year;
            if(file_exists($path)==false){
                mkdir($path,0777);
            }
            $path = public_path($path.'/');
            $pdf = PDF::loadView('email.view_quotenew', $data)->setPaper('a4', 'landscape');
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
            return response()->json(['code'=>200, 'success' => 'Quotation added successfully.']);
        }else{
            return response()->json(['code'=>400, 'error' => 'Something went wrong while adding quotation, please try again.']);
        }			
    }

    public function updateQuatation(Request $request, $in_quot_id){
        if(empty($in_quot_id)){
            return back()->with([
                'message' => 'Invalide Quatation id.',
            ]);
		}

        $in_cust_id = QuatationAdd::where('in_quot_id', $in_quot_id)->first()->toArray();
        $in_cust_id = $in_cust_id['in_cust_id'];
		$data = [];
		$data['tab']				= 	'quotation';
		$data['subtab']				= 	'quotation';
        $data['in_quot_id'] 		= 	$in_quot_id;
        $data['in_cust_id'] 		= 	$in_cust_id;
        $data['notify_list']        =   $this->get_notify_users_id();
		$data['quotation_info']	    =	$this->get_quotation_by_id($in_quot_id);
		$data['product_list']		=	$this->get_product_list();
		$data['quotation_details'] 	= 	$this->get_quotation_details($in_quot_id, $in_cust_id);
		$data['customer_info'] 		= 	$this->get_customer_by_id($in_cust_id);
		$data['banks_info']			=	$this->get_banks();
		$data['banks']				=	$this->get_banks($data['quotation_info']['in_bank_id']);
        $data['owner']              =   $this->owner_list();

		if($data['quotation_info']['in_tax_branch_id'] == ''){ 
            $taxes_id = 1;
        }else { 
            $taxes_id = $data['quotation_info']['in_tax_branch_id']; 
        }
		
		// $data['taxes']				=	$this->quotation_model->get_taxes($taxes_id);
		// $data['taxes_by_id']			=	$this->quotation_model->get_taxes_by_id($taxes_id);
		
		if($this->input->post()){ 
				$pincode = "";
				$addr = "";
				if($this->input->post('shipping_pincod') != "")
				{
					$pincode = $this->input->post('shipping_pincod');
					$addr = $this->input->post('shipping_addr');
				}
				else
				{
					$addr_break = explode(", Pin Code ",$this->input->post('shipping_addr'));
					$pincode = isset($addr_break[1]) ? $addr_break[1] : '';
					$addr = isset($addr_break[0]) ? $addr_break[0] : '';
				}

				//Validation rules are here
                $req_fields = array(	
                                    array('field'   => 'shipping_addr',		'label'  => 'Shipping Address',		'rules' => 'required|trim'),

                                    array('field'   => 'shipping_state', 	'label'  => 'Shipping State', 		'rules' => 'required|trim'),

                                    array('field'   => 'shipping_city',		'label'  => 'Shipping City',		'rules' => 'required|trim'),

                                    //array('field'   => 'shipping_telephone', 'label'  => 'Shipping Telephone', 	'rules' => 'required|trim'),

                                    // array('field'   => 'reference',			'label'  => 'Reference',			'rules' => 'required|trim'),

                                    array('field'   => 'reference_date', 	'label'  => 'Reference Date', 		'rules' => 'required|trim'),

                                    array('field'   => 'shipping_email',	'label'  => 'Shipping Email',		'rules' => 'required|trim|valid_email'),

                                    array('field'   => 'enq_ref_no', 		'label'  => 'Enq. Ref. No.', 		'rules' => 'required|trim')

                                    // array('field'   => 'tin_no',	'label'  => 'Tin No.',	'rules' => 'required|trim'),

                                    //array('field'   => 'bank_details', 		'label'  => 'Bank Details', 		'rules' => 'required|trim')

                                    //array('field'   => 'payment_turm', 		'label'  => 'Payment Terms', 		'rules' => 'required|trim')
                );
	
				$this->form_validation->set_rules($req_fields);
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
				$pdfFilePath = "quotation_".time()."_".date('dmy').".pdf";
		 		
				$update_quotation_info	=	array(
									'st_shiping_add'			=>	$addr,
									'st_shiping_city'			=>	trim($this->input->post('shipping_city')),
									'st_shiping_state'			=>	trim($this->input->post('shipping_state')),
									'st_shiping_pincode'        =>	$pincode,
									'flg_same_as_bill_add'      =>	trim($this->input->post('shippingchk')),
									'st_shipping_phone'			=>	trim($this->input->post('shipping_telephone')),
									'st_shipping_email'			=>	trim($this->input->post('shipping_email')),
									'st_enq_ref_number'			=>	trim($this->input->post('enq_ref_no')),
									'st_ref_through'			=>	trim($this->input->post('reference')),
									'stn_pdf_name'				=>	$pdfFilePath,
                                     'lead_from'                =>	trim($this->input->post('lead_from')),
                                    'notify_group'         		=>	trim($this->input->post('notify_group')),
									'owner_id'                  =>	trim($this->input->post('select_owner')),
									'st_currency_applied'       =>	trim($this->input->post('currency')),
                                    'dt_ref'				=>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('reference_date')))),
									'st_tin_number'				=>	'27700707469',
									//'in_bank_id'				=>	trim($this->input->post('bank_details')),
									'st_pay_turm'				=>	trim($this->input->post('payment_turm')),
									'st_landline'				=>	trim($this->input->post('auto_pop_landline')),
									'st_ext_note'				=>	trim($this->input->post('ext_note')),
									'dt_date_modified'			=>	date('Y-m-d h:i:s')
									);
									
							
				if ($this->form_validation->run() == FALSE)
				{
					// Validation error				
					$data['error_msg'] = validation_errors();	
					//$newArray = array_merge($customer_info, $array);
									
					$this->session->set_flashdata($update_quotation_info);
					$this->session->set_flashdata('errmessage', $data['error_msg']);
				}
				else
				{ 
					/* Update customer address*/
					$update_customer_array = array(
								'st_com_address'	=> $this->input->post('auto_pop_addr'),
								'st_cust_city'		=> trim($this->input->post('auto_pop_city')),
								'in_pincode'		=> trim($this->input->post('auto_pop_pincod')),
								'st_cust_state'		=> trim($this->input->post('auto_pop_state')),
								'st_cust_mobile'	=> trim($this->input->post('auto_pop_phone')),
								'st_cust_email'		=> trim($this->input->post('auto_pop_email')));
					$this->customer_model->update_customer($in_cust_id, $update_customer_array);
					

					if($this->quotation_model->update_quotation($in_quot_id,$update_quotation_info)) {
						
                                            $update_quot_reason	=	array(
										
                                                        'int_branch_id'		=>	$this->session->userdata('branchname'),
                                                        'user_id'		=>	$this->session->userdata('user_id'),
                                                        'notify_group'		=>	trim($this->input->post('notify_group')),
                                                        'dt_modify'		=>	date('Y-m-d h:i:s')
                                                        );
                                        $this->quotation_model->update_quot_reason($data['quotation_info']['in_quot_num'],$update_quot_reason);
                                            
                                            
									$data['quotation_details'] 	= $this->quotation_model->get_quotation_details($in_quot_id,$in_cust_id);
									$data['quotation_info'] 	= $this->quotation_model->get_quotation_info($in_quot_id, $in_cust_id);
									$data['customer_info'] 		= $this->customer_model->get_customer_by_id($in_cust_id);
									$data['taxes_by_id']		= $this->quotation_model->get_taxes_by_id($data['quotation_info']['in_sal_tax_id']);
									$data['preparing_by'] 		= trim($this->input->post('quot_pre_by'));
									$data['tax_text']			= $this->input->post('tax_text');
									$data['format']				= $this->quotation_model->get_PDF_format_by_id($data['quotation_info']['in_tax_branch_id']);
									$data['BillAddress']		= $this->quotation_model->get_PDF_BillAddress();
									$emailto                    = $data['customer_info']['st_cust_email'];
                                                                        
									if(trim($this->input->post('shipping_email')) != trim($data['customer_info']['st_cust_email'])){
										$emailto = $this->input->post('shipping_email') .",".$this->input->post('auto_pop_email');
									}
									
									//this data will be passed on to the view
									//$data['the_content']='mPDF and CodeIgniter are cool!';

									//load the view, pass the variable and do not show it but "save" the output into $html variable
									$html= $this->load->view('email/view-quotenew',$data,true); 
									
									//this the the PDF filename that user will get to download
									
									//print_r($html);exit;
									//load mPDF library
									$this->load->library('m_pdf');
									
									//actually, you can pass mPDF parameter on this load() function
									$pdf = $this->m_pdf->load();
									$pdf->SetWatermarkImage('http://office.chromatographyworld.com/assets/images/Scan.jpg');
									$pdf->showWatermarkImage = true;
									$pdf->use_kwt = true;
									$pdf->addPage('L'); //generate the Lanscap view PDF!
									//generate the PDF!
									$pdf->WriteHTML($html);
									//offer it to user via browser download! (The PDF won't be saved on your server HDD)
									// $pdf->Output($pdfFilePath, "D");
									$pdf->Output('quotationpdf/'.$pdfFilePath,'F');
									
									// $this->mpdf->Output($_SERVER['DOCUMENT_ROOT']."quotationpdf/".$pdfFilePath,'F');
                                                                        
									$cc_cust_emails = explode("," , $data['customer_info']['st_cust_email_cc']);
									$cc_admin_emails = explode("," , $this->session->userdata('st_cc_email'));
									$this->email->from('speed@chromatographyworld.com', 'Quotation Attached');
									//$this->email->to($emailto);
									$this->email->to($this->session->userdata('st_admin_email'));
									//$this->email->cc($cc_cust_emails);
									$this->email->cc($cc_admin_emails);
									// $this->email->bcc($cc_admin_emails);
									//$this->email->bcc($cc_admin_emails);
									$this->email->subject('Quotation Attached ');
									// $emailbody = $this->load->view('email/view-quote',$data,true);
									$emailbody = "Dear Sir/Madam,<br><br>";
									$emailbody .= "We thank you for your valuable enquiry.<br><br>";
									$emailbody .= "Please find an attached Quotation in response to your enquiry. <br><br>";
									$emailbody .= "While we assure you of our best services, we look forward to your  valuable  order.<br><br>";
									$emailbody .= "Thank You.<br><br>";
									$this->email->message($emailbody);
									$this->email->attach("quotationpdf/".$pdfFilePath);
									$this->email->send();
						
						$this->session->set_flashdata('editquotation_msg_succ', 'Quotation has been updated successfully.');
					} else {
						$this->session->set_flashdata('editquotation_msg_err', 'Something went wrong while updating quotation information, please try again.');
					}
					redirect(base_url('quotation/view_quotation'));
				}			
		}
		$this->load->view('edit-quotation',$data);
    }

    public function test(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('office/quatation/test');
        $pdf->stream();
    }
}
