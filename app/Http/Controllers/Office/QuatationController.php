<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Owner;
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
		$result = [];
		$this->db->select('*');
		$this->db->from('quotation_details');
		$this->db->where('in_quot_id', $quotation_id);
		$this->db->where('in_cust_id', $in_cust_id);
		if($in_product_id != ''){
			$this->db->where('in_product_id', $in_product_id);
		}
		$this->db->where('flg_is_deleted', 0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}

    public function get_quotation_info($quotation_id = '', $in_cust_id = '', $quotation_unoque_id = ''){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_quotation');
		if($quotation_id != ""){
			$this->db->where('in_quot_id', $quotation_id);
		}
		if($in_cust_id != ""){
			$this->db->where('in_cust_id', $in_cust_id);
		}

		if($quotation_unoque_id != ""){
			$this->db->where('in_quot_num', $quotation_unoque_id);
		}

		$this->db->where('is_deleted', 0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}

    public function get_customer_by_id($id = null){
		$in_branch = $this->session->userdata('in_branch');
		$this->db->select('c.*');
		$this->db->where('c.in_deleted',0);
		if($id != null && $id != ''){ 
			$this->db->where('c.in_cust_id',$id);
		}
		if($in_branch != null && $in_branch != '' && $in_branch != 1 ){
			$this->db->where('c.in_branch',$in_branch);
		}
		$this->db->group_by('c.st_com_name');
		$this->db->order_by('c.st_com_name','ASC');
		$query = $this->db->get('tbl_customer as c');
		if($query->num_rows() > 0){
			if($id != null && $id != '')
			    return $query->row_array();
			else
			    return $query->result_array();

		}
		return false;
	}

    public function get_product_list(){
		$this->db->select('p.pro_id, p.st_part_No , p.st_pro_desc, p.in_pro_disc, p.fl_pro_price, p.in_cat_id, p.in_pro_qty, p.st_pro_maker');/*, c.st_cat_name*/
		$this->db->from('tbl_product p');
		$this->db->where('p.is_deleted',0);
		$this->db->order_by('p.st_part_No','ASC');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return false;
	}

    public function get_notify_users_id($id=null) {
		$this->db->select('*');
		$this->db->where('is_deleted',0);
        if($id != null && $id != ''){ 
            $this->db->where('id',$id);
        } else{
            $this->db->where('branch_id',$this->session->userdata('branchname')); 
        }
		$query = $this->db->get('notify_users');
		if($query->num_rows() > 0) {
            if($id != null && $id != '')
                return $query->row_array();
            else
                return $query->result_array();
		}
		return false;
	}

    public function get_PDF_BillAddress(){
		$this->db->select('stn_branch_add');
		$this->db->where('is_deleted',0);
		$this->db->where('int_branch_id',$this->session->userdata('branchname'));
		$query = $this->db->get('tbl_quot_format');
		if($query->num_rows() > 0) {	
			return $query->row('stn_branch_add');
		}
		return false;
	}

    public function get_PDF_format_by_id($id){
		$this->db->select('*');
		$this->db->where('is_deleted',0);
		$this->db->where('int_branch_id',$id);
		$query = $this->db->get('tbl_quot_format');
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		return false;
	}

    public function owner_list(){ 
		$this->db->select('*');		
		$this->db->where('is_deleted',0);
		$this->db->order_by('owner_name','ASC');
		$query = $this->db->get('tbl_custowner');
		$data	=	array();
		if($query->num_rows() > 0) {
            foreach($query->result_array() as $row) {
                    $data[]= array('id'=>$row['id'], 'owner_name'=>$row['owner_name'] );
            }
		}
		return $data;
	}

    public function get_banks($bank_id = ''){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_bank');
		if($bank_id != '')
		    $this->db->where('in_bank_id', $bank_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){	
			if($bank_id != '')
			    $result = $query->row_array();
			else
			    $result = $query->result_array();
		}
		return $result;
	}

    public function insert_quotation_deatal($insert_array)
	{
		$this->db->insert('quotation_details',$insert_array);
	}

    public function insert_quot_reason($insert_quot_reason){ 
		if($this->db->insert('tbl_pending',$insert_quot_reason))
		{
			return $this->db->insert_id();
		}
		return false;
	}
    public function generate_quot_no($branchname, $in_branch_id,$quotation_create_date, $generate_No_for = ""){
		$initial3latters = substr($branchname, 0, 3);
		$this->db->select('in_quot_id');
		$this->db->from('tbl_quotation');
		$this->db->where('in_branch_id', $in_branch_id);
		$this->db->where('is_deleted', 0);
		$this->db->where('dt_date_created >=', date('Y-m-d 00:00:00',strtotime(str_replace('/', '-', $quotation_create_date))));
		$this->db->where('dt_date_created <=', date('Y-m-d 23:59:59',strtotime(str_replace('/', '-', $quotation_create_date))));
		$query = $this->db->get();
		$flg_type = '';
		if($generate_No_for != ""){
			$flg_type = "order-";
		}
		$date = date('Ymd', strtotime(str_replace('/', '-', $quotation_create_date)));
		if($query->num_rows() > 0){	
			$number = $query->num_rows()+1;
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
        $data['quotation_data'] = View::make("office.quatation.preview_quatation", $result)->render();
        return json_encode($data);
    }

    public function storeQuatation(Request $request){

        # Get Static Data
        $data =	[];
		$data['error_msg'] 		    =   '';	
		$data['card_err']		    =   '';
		$data['product_list']		=	$this->get_product_list();
		$data['customer_info']		=	$this->get_customer_by_id();
        $data['notify_list']        =   $this->get_notify_users_id();
		$data['taxes']			    =	1;
		$data['banks']			    =	$this->get_banks();
		$data['owner']              =   $this->owner_list();
        
        # Get Quotation Data
        $admin_user_id = \Auth::user()->id;
        $quotation_prod_details_arr = [];
        if(!empty($request->sel_prods_details)){
            foreach($request->sel_prods_details as $key => $val ){
                $quotation_prod_details_arr = json_decode($val);
            }
        }
        $pincode = "";
        $addr = "";
        if(!empty($request->quotation_info)){
            $qt_info = $request->quotation_info;
        }
        if(!empty($request->customer_info)){
            $cust_info = $request->customer_info;
        }
        $in_branch_id = 1; //session branch id;
        $branchname = 'Mum'; //session branch name;
        $quotation_create_date = date('Y-m-d', strtotime($request->dt_ref));
        $generate_quot_no =	$this->generate_quot_no('Mum', 1, $quotation_create_date);
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
            'in_tax_branch_id'			=>	trim(!empty($qt_info['bill_add_id']) ? $qt_info['bill_add_id'] : ''),
            'dt_ref'                    =>	$quotation_create_date,
            'in_login_id'				=>	$admin_user_id,
            'in_branch_id'				=>	$in_branch_id,
            'stn_pdf_name'				=>	$pdfFilePath,
            'st_currency_applied'       =>	trim(!empty($qt_info['currency']) ? $qt_info['currency'] : ''),
            'dt_date_created'			=>	$quotation_create_date
        ];
                                
        # Update customer 
        $update_customer_array = [
            'st_com_address'    => 	trim(!empty($qt_info['auto_pop_addr']) ? $qt_info['auto_pop_addr'] : ''),
            'st_cust_city'      => 	trim(!empty($qt_info['auto_pop_city']) ? $qt_info['auto_pop_city'] : ''),
            'st_con_person1'    =>  trim(!empty($qt_info['auto_pop_cust_name']) ? $qt_info['auto_pop_cust_name'] : ''),
            'in_pincode'        => 	trim(!empty($qt_info['auto_pop_pincod']) ? $qt_info['auto_pop_pincod'] : ''),
            'st_cust_state'     => 	trim(!empty($qt_info['auto_pop_state']) ? $qt_info['auto_pop_state'] : ''),
            'st_cust_mobile'    => 	trim(!empty($qt_info['st_cust_mobile']) ? $qt_info['st_cust_mobile'] : ''),
            'st_cust_email'     => 	trim(!empty($qt_info['auto_pop_email']) ? $qt_info['auto_pop_email'] : ''),
        ];
        
        $Customer  = Customer::where('in_cust_id', $cust_info['customer_id'])->update($update_customer_array);
        $inserted_quotation_id = QuatationAdd::insertGetId($quotation_info); 
        $totalproarray = 0;
        
        # Update Reason
        if($inserted_quotation_id != FALSE && $inserted_quotation_id > 0){
            $insert_quot_reason	=	[
                'int_qd_no'		=>	$inserted_quotation_id,
                'stn_qtn_ord_no'=>	$generate_quot_no,
                'stn_amt'		=>	ceil($this->input->post('hid_quotation_sub_total')),
                'dt_date'		=>	date('Y-m-d h:i:s'),
                'int_cust_id'	=>	$cust_info['customer_id'],
                'stn_reason'	=>	'Open',
                'int_reason_mode'	=> 	0,
                'int_branch_id'	=>	'Mumbai', // get branch name from session,
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

            $data['quotation_details'] = $this->get_quotation_details($inserted_quotation_id,$cust_info['customer_id']);
            $data['quotation_info'] = $this->get_quotation_info($inserted_quotation_id, $cust_info['customer_id']);
            $data['customer_info'] = $this->get_customer_by_id($cust_info['customer_id']);
            $data['tax_text'] = $this->input->post('tax_text'); 
            $data['preparing_by'] = trim($cust_info['preparing_by']);
            $data['format']	= $this->get_PDF_format_by_id($qt_info['bill_add_id']);
            $data['BillAddress'] = $this->get_PDF_BillAddress();
   
            # Generate PDF
            $year = date("Y");    
            $path = 'pdf_'.$year;
            if(file_exists($path)==false){
                mkdir($path,0777);
            }
            $path = public_path($path.'/');
            $fileName =  'quotation'.time().'.'. 'pdf' ;
            $html = View::make('email.view_quotenew', $data)->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->setWatermarkImage('http://office.chromatographyworld.com/assets/images/Scan.jpg');
            $pdf->showWatermarkImage = true;
            $pdf->use_kwt = true;
            $pdf->WriteHTML($html);
            $pdf->save($path . '/' . $fileName);
            $pdf = public_path($path.'/'.$fileName);

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

    public function test(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('office/quatation/preview_quatation');
        $pdf->stream();
    }
}
