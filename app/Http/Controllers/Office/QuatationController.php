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
        $data =	[];
		$data['error_msg'] 		= '';	
		$data['card_err']		= '';
		// $data['product_list']		=	$this->quotation_model->get_product_list();
		// $data['customer_info']		=	$this->customer_model->get_customer_by_id();
        // $data['notify_list']        =   $this->notification_model->get_notify_users_id();
		// $data['taxes']			=	1;
		// $data['banks']			=	$this->quotation_model->get_banks();
		// $data['owner']          =   $this->owner_model->owner_list();
        
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
            $info = $request->quotation_info;
            $pincode = !empty($info['st_shiping_pincode']) ? $info['st_shiping_pincode'] : '';
            $addr = !empty($info['st_shiping_add']) ? $info['st_shiping_add'] : '';
        }

        //here
        $in_branch_id = $this->session->userdata('branchname');
        $branchname = '';
        foreach($this->common_function->branch_id as $branch_k => $branch_v){
            if($branch_k == $this->session->userdata('branchname')){
                $branchname = $branch_v;
            }
        }
      
        $quotation_create_date = date('Y-m-d', strtotime($request->dt_ref));
        $generate_quot_no =	$this->quotation_model->generate_quot_no($branchname, $in_branch_id,$quotation_create_date);
        $pdfFilePath = "quotation_".time()."_".date('dmy').".pdf";
        $quotation_info	=	[
            'in_quot_num'				=>	$generate_quot_no,
            'in_cust_id'				=>	trim($this->input->post('customer_id')),
            'st_shiping_add'			=>	$addr,
            'st_shiping_city'			=>	trim($this->input->post('shipping_city')),
            'st_shiping_state'			=>	trim($this->input->post('shipping_state')),
            'st_shiping_pincode'        =>	$pincode,
            'flg_same_as_bill_add'      =>	trim($this->input->post('shippingchk')),
            'st_shipping_phone'			=>	trim($this->input->post('shipping_telephone')),
            'st_shipping_email'			=>	trim($this->input->post('shipping_email')),
            'st_landline'				=>	trim($this->input->post('shipping_lanline')),
            'st_enq_ref_number'			=>	trim($this->input->post('enq_ref_no')),
            'st_tin_number'				=>	'27700707469',
            'st_pay_turm'				=>	trim($this->input->post('payment_turm')),
            'st_ext_note'				=>	trim($this->input->post('ext_note')),
            'fl_sub_total'				=>	trim($this->input->post('hid_quotation_sub_total')),
            'fl_sales_tax'				=>	$prod_tax_value,
            'fl_sales_tax_amt'			=>	trim($this->input->post('hid_tax_amt')),
            'in_sal_tax_id'				=>	$prod_tax_id,
            'fl_fleight_pack_charg'     =>	0, 
            'final_amount'				=>	ceil($this->input->post('hid_quotation_sub_total')), 
            'fl_nego_amt'				=>	ceil($this->input->post('hid_quotation_sub_total')),
            'in_deliv_priod'			=>	30,
            'st_ref_through'			=>	"",
            'lead_from'                 =>	trim($this->input->post('lead_from')),
            'notify_group'              =>	trim($this->input->post('notify_group')),
            'owner_id'                  =>	trim($this->input->post('select_owner')),
            'in_tax_branch_id'			=>	trim($this->input->post('bill_add_id')),
            'dt_ref'                    =>	date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('reference_date')))),
            'in_login_id'				=>	$admin_user_id,
            'in_branch_id'				=>	$in_branch_id,
            'stn_pdf_name'				=>	$pdfFilePath,
            'st_currency_applied'       =>	trim($this->input->post('currency')),
            'dt_date_created'			=>	$quotation_create_date
        ];
                                
        /* Update customer address*/
        $update_customer_array = [
            'st_com_address'    => 	$this->input->post('auto_pop_addr'),
            'st_cust_city'      => 	trim($this->input->post('auto_pop_city')),
            'st_con_person1'    =>  trim($this->input->post('auto_pop_cust_name')),
            'in_pincode'        => 	trim($this->input->post('auto_pop_pincod')),
            'st_cust_state'     => 	trim($this->input->post('auto_pop_state')),
            'st_cust_mobile'    => 	trim($this->input->post('auto_pop_phone')),
            'st_cust_email'     => 	trim($this->input->post('auto_pop_email'))
        ];
            
        $this->customer_model->update_customer($this->input->post('customer_id'),$update_customer_array);
        $totalproarray=0;
        $inserted_quotation_id = $this->quotation_model->insert_quotation($quotation_info);
        if($inserted_quotation_id != FALSE && $inserted_quotation_id > 0){
            $insert_quot_reason	=	[
                'int_qd_no'		=>	$inserted_quotation_id,
                'stn_qtn_ord_no'	=>	$generate_quot_no,
                'stn_amt'		=>	ceil($this->input->post('hid_quotation_sub_total')),
                'dt_date'		=>	date('Y-m-d h:i:s'),
                'int_cust_id'	=>	$this->input->post('customer_id'),
                'stn_reason'		=>	'Open',
                'int_reason_mode'	=> 	0,
                'int_branch_id'	=>	trim($this->session->userdata('branchname')),
                'user_id'		=>	$this->session->userdata('user_id'),
                'notify_group'       =>      trim($this->input->post('notify_group')),
                'dt_created'		=>	$quotation_create_date, 
                'dt_modify'		=>	$quotation_create_date 
            ];        
            $this->quotation_model->insert_quot_reason($insert_quot_reason);
            $quotation_details_arr = [
                'in_cust_id' => trim($this->input->post('customer_id')),
                'in_quot_id' => $inserted_quotation_id
            ];
            foreach($quotation_prod_details_arr as $key => $val_arr) {
                foreach($val_arr as $val_arr_key => $val_arr_val) {
                    $quotation_details_arr[$val_arr_key] = $val_arr_val;
                }
                $inserted_quotation_detail_id = $this->quotation_model->insert_quotation_deatal($quotation_details_arr);
            }			
            $cc_cust_emails =array();
            $data['quotation_details'] = $this->quotation_model->get_quotation_details($inserted_quotation_id,$this->input->post('customer_id'));
            $data['quotation_info'] = $this->quotation_model->get_quotation_info($inserted_quotation_id, $this->input->post('customer_id'));
            $data['customer_info'] = $this->customer_model->get_customer_by_id($this->input->post('customer_id'));
            $data['tax_text'] = $this->input->post('tax_text'); 
            $data['preparing_by'] = trim($this->input->post('preparing_by'));
            $data['format']	= $this->quotation_model->get_PDF_format_by_id($this->input->post('bill_add_id'));
            $data['BillAddress'] = $this->quotation_model->get_PDF_BillAddress();
            $emailto = $data['customer_info']['st_cust_email'];
            
            if(trim($this->input->post('shipping_email')) != trim($data['customer_info']['st_cust_email'])){
                $emailto = $this->input->post('shipping_email') .",".$this->input->post('auto_pop_email');
            }        
            //load the view, pass the variable and do not show it but "save" the output into $html variable
            $html= $this->load->view('email/view-quotenew',$data,true); 
            //load mPDF library
            $this->load->library('m_pdf');
            //actually, you can pass mPDF parameter on this load() function
            $pdf = $this->m_pdf->load();
            //$pdf->AddPage();
            $pdf->use_kwt = true;
            $pdf->addPage('L'); //generate the Lanscap view PDF!
            //generate the Watermark Image!
            $pdf->SetWatermarkImage('http://office.chromatographyworld.com/assets/images/Scan.jpg');
            $pdf->showWatermarkImage = true;
            $pdf->WriteHTML($html);
            $pdf->Output('quotationpdf/'.$pdfFilePath,'F');
            $cc_cust_emails = explode("," , $data['customer_info']['st_cust_email_cc']);
            $cc_admin_emails = explode("," , $this->session->userdata('st_cc_email'));
            $this->email->from('speed@chromatographyworld.com', 'Quotation Attached');
            $this->email->to($this->session->userdata('st_admin_email'));
            $this->email->cc($cc_admin_emails);
            $this->email->bcc($cc_admin_emails);
            $this->email->subject('Quotation Attached ');
            $emailbody = "Dear Sir/Madam,<br><br>";
            $emailbody .= "We thank you for your valuable enquiry.<br><br>";
            $emailbody .= "Please find an attached Quotation in response to your enquiry. <br><br>";
            $emailbody .= "While we assure you of our best services, we look forward to your  valuable  order.<br><br>";
            $emailbody .= "Thank You.<br><br>";
            $this->email->message($emailbody);
            $this->email->attach("quotationpdf/".$pdfFilePath);
            $this->email->send();
            $this->session->set_flashdata('editquotation_msg_succ', 'Quotation added successfully.');
            redirect(base_url('quotation/view_quotation'));
            $this->session->set_flashdata('editquotation_msg_err', 'Something went wrong while adding quotation, please try again.');
        }			
    }

    public function test(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('office/quatation/preview_quatation');
        $pdf->stream();
    }
}
