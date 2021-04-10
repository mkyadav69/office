@extends('theme.layout.base_layout')
@section('title', 'Update Quotations')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.table-earning thead th {
    background: #333;
    font-size: 16px;
    color: #fff;
    vertical-align: middle;
    font-weight: 400;
    text-transform: capitalize;
    line-height: 1;
    padding-left: 5px;
    padding-right: 5px;
    white-space: nowrap;
}
.table-earning tbody td {
    color: #808080;
    padding: 0px 0px;
    white-space: nowrap;
}
.row_sub_total{
    padding: 4px
}
.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(25%, 0, 0);
    transform: translate3d(25%, 0, 0);
}
.tooltips {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltips .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  transition: opacity 0.3s;
}

.tooltips .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltips:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

.quote-preview {
    max-width: 1065px;
    margin: 1.75rem auto;
}
datepicker,
.table-condensed {
  width: 450px;
  height:250px;
}

.td-limit {
    max-width: 300px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.section__content--p30{
    padding: 0px 0px;
}
</style>
<!-- add records -->
    <div class="col col-md-12">
        @if (session()->has('message'))
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Update Quotations</h5>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Lead & Group</h5>
            </div>
            <form action="" name="quotation_form" id="quotation_form"  role="form">
                    <div class="modal-body">
                        <input type="hidden" name="in_quot_id" id="in_quot_id" value="{{$data['in_quot_id']}}"/>
                        <input type="hidden" name="flg_same_as_bill_add" id="flg_same_as_bill_add" value=""/>
                        <input type="hidden" name="in_quot_num" id="in_quot_num" value="{{$data['in_quot_num']}}"/>
                        <input type="hidden" name="in_cust_id" id="in_cust_id" value="{{$data['in_cust_id']}}"/>
                        <div class="row form-group">
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Quatation Prepared By </label>
                                <input type="text" name="preparing_by" required id="preparing_by" placeholder="Quatation Prepared By" value="{{ old('preparing_by', !empty($data['quotation_info']['preparing_by']) ? $data['quotation_info']['preparing_by'] : '') }}" class="form-control">
                                <b><small class="help-block form-text text-danger" id="error_preparing_by"></small></b>
                            </div>
                            <div class="form-group col-4">
                                <label for="lead_from" class=" form-control-label required">Lead From</label>
                                <input type="text" name="lead_from" required id="lead_from" placeholder="Lead From" value="{{ old('lead_from', !empty($data['quotation_info']['lead_from']) ? $data['quotation_info']['lead_from'] : '') }}" class="form-control">
                                <small class="help-block form-text text-danger" id="error_lead_from"></small>
                            </div>
                            <input type="hidden" name="_token"  id="token" value="{{ csrf_token() }}">
                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Notify Group</label>
                                <select id="notify_group" required name="notify_group" class="form-control">
                                    <option value="">Select Notify Group</option>
                                    @if(!empty($notify))
                                        @foreach($notify as $id=>$name)
                                            <option value="{{$id}}" {{ old('notify_group' , $id) == (!empty($data['quotation_info']['notify_group']) ? $data['quotation_info']['notify_group'] : '' ) ? "selected" : "" }}>{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Notification are not available.</p>
                                    @endif
                                </select>
                                <small class="help-block form-text text-danger" id="error_notify_group"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Customer Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Select Company</label>
                                <select id="customer_id" required name="customer_id" class="form-control">
                                    <option value="">Select Company</option>
                                    @if(!empty($company))
                                        @foreach($company as $id=>$name)
                                            <option value="{{$id}}" {{ old('customer_id' , $id) == (!empty($data['customer_info']['in_cust_id']) ? $data['customer_info']['in_cust_id'] : '' ) ? "selected" : "" }} >{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Company are not available.</p>
                                    @endif
                                </select>
                                <small class="help-block form-text text-danger" id="error_in_cust_id"></small>
                            </div>
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Enq Ref. No. </label>
                                    <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Enq Ref. No." value="{{ old('enq_ref_no', !empty($data['quotation_info']['st_enq_ref_number']) ? $data['quotation_info']['st_enq_ref_number'] : '') }}" class="form-control">
                                    <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Ref. Date </label>
                                <input type="text" name="reference_date" required id="datepicker" class="form-control" value="{{ old('reference_date', date('d-m-Y', strtotime($data['quotation_info']['dt_ref']))) }}" placeholder="DD-MM-YYY" />
                                <small class="help-block form-text text-danger" id="error_dt_ref"></small>
                            </div>

                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Add Customer</label>
                                    <span id="datepicker" class="form-control btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="zmdi zmdi-plus"></i> Add Customer</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Company Name </label>
                                    <input type="text" id="company_name" required name="company_name" placeholder="Company Name" value="{{ old('company_name', !empty($data['customer_info']['st_com_name']) ? $data['customer_info']['st_com_name'] : '') }}" class="form-control auto_pop_company">
                                    <small class="help-block form-text text-danger" id="error_st_com_name"></small>
                            </div>

                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Contact Person</label>
                                    <input type="text" id="auto_pop_cust_name" required name="auto_pop_cust_name" placeholder="Contact Person" value="{{ old('auto_pop_cust_name', !empty($data['customer_info']['st_con_person1']) ? $data['customer_info']['st_con_person1'] : '') }}" class="form-control auto_pop_cust_name">
                                    <small class="help-block form-text text-danger" id="error_auto_pop_cust_name"></small>
                            </div>

                            <div class="form-group col-3" id="owner">

                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Billing / Shipping Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Billing </strong> Details
                                    </div>
                                    <div class="card-body card-block">
                                       
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label required">Address</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea type="text" id="auto_pop_addr" required name="auto_pop_addr" placeholder="Address" class="form-control auto_pop_addr">{{ old('auto_pop_addr', !empty($data['customer_info']['st_com_address']) ? $data['customer_info']['st_com_address'] : '' ) }}</textarea>
                                                <small class="help-block form-text text-danger" id="error_auto_pop_addr"></small>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">State</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="auto_pop_state" required name="auto_pop_state" placeholder="State" value="{{ old('auto_pop_state', !empty($data['customer_info']['st_cust_state']) ? $data['customer_info']['st_cust_state'] : '') }}" class="form-control auto_pop_state">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_state"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">City</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="auto_pop_city" required name="auto_pop_city" placeholder="City" value="{{ old('auto_pop_city', !empty($data['customer_info']['st_cust_city']) ? $data['customer_info']['st_cust_city'] : '') }}" class="form-control auto_pop_city">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_city"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Pin Code</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="auto_pop_pincod" required name="auto_pop_pincod" placeholder="Pin Code" value="{{ old('auto_pop_pincod', !empty($data['customer_info']['in_pincode']) ? $data['customer_info']['in_pincode'] : '') }}" class="form-control auto_pop_pincod">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_pincod"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Mobile No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="auto_pop_phone" required name="auto_pop_phone" placeholder="Mobile No." value="{{ old('auto_pop_phone', !empty($data['customer_info']['st_cust_mobile']) ? $data['customer_info']['st_cust_mobile'] : '') }}" class="form-control auto_pop_phone">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_phone"></small>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Email</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="email" id="auto_pop_email" required name="auto_pop_email" placeholder="Email" value="{{ old('auto_pop_email', !empty($data['customer_info']['st_cust_email']) ? $data['customer_info']['st_cust_email'] : '' ) }}" class="form-control auto_pop_email">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_email"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="auto_pop_landline" required name="auto_pop_landline" value="{{ old('auto_pop_landline', !empty($data['customer_info']['st_cust_mobile']) ? $data['customer_info']['st_cust_mobile'] : '') }}" placeholder="Land-Line No." class="form-control auto_pop_landline">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_landline"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <strong>Shipping </strong> Details
                                            </div>
                                            <div class="col col-md-4">
                                                <input type="checkbox" id="shippingchk" name="shippingchk"> <strong>Same as</strong>  Billing 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body card-block">
                                       
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label required">Address</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea type="text" id="shipping_addr" required name="shipping_addr" placeholder="Address" class="form-control auto_pop_ship_addr">{{ old('shipping_addr', !empty($data['quotation_info']['st_shiping_add']) ? $data['quotation_info']['st_shiping_add'] : '') }}</textarea>
                                                <small class="help-block form-text text-danger" id="error_st_shiping_add"></small>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">State</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                @if(!empty($indian_all_states))
                                                    <select id="shipping_state" required name="shipping_state" class="form-control">
                                                        <option value="">Select State</option>
                                                        @foreach($indian_all_states as $rk=>$rv)
                                                            @if (old('shipping_state', $data['quotation_info']['st_shiping_state']) == $rv)
                                                                <option value="{{$rk}}" selected>{{ $rv }}</option>
                                                            @else
                                                                <option value="{{ $rk }}">{{ $rv }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <small class="help-block form-text text-danger" id="error_st_shiping_state"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">City</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shipping_city" required name="shipping_city" placeholder="City" value="{{ old('shipping_city', !empty($data['quotation_info']['st_shiping_city']) ? $data['quotation_info']['st_shiping_city'] : '') }}" class="form-control">
                                                <small class="help-block form-text text-danger" id="error_st_shiping_city"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Pin Code</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shipping_pincod" required name="shipping_pincod" placeholder="Pin Code" value="{{ old('shipping_pincod', !empty($data['quotation_info']['st_shiping_pincode']) ? $data['quotation_info']['st_shiping_pincode'] : '') }}" class="form-control">
                                                <small class="help-block form-text text-danger" id="error_st_shiping_pincode"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Mobile No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shipping_telephone" required name="shipping_telephone" value="{{ old('shipping_telephone', !empty($data['quotation_info']['st_shipping_phone']) ? $data['quotation_info']['st_shipping_phone'] : '') }}" placeholder="Mobile No." class="form-control">
                                                <small class="help-block form-text text-danger" id="error_st_shipping_phone"></small>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Email</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="email" id="shipping_email" required name="shipping_email" placeholder="Email" value="{{ old('shipping_email', !empty($data['quotation_info']['st_shipping_email']) ? $data['quotation_info']['st_shipping_email'] : '') }}" class="form-control">
                                                <small class="help-block form-text text-danger" id="error_st_shipping_email"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shipping_lanline" required name="shipping_lanline" value="{{ old('shipping_lanline', !empty($data['quotation_info']['st_landline']) ? $data['quotation_info']['st_landline'] : '') }}" placeholder="Land-Line No." class="form-control">
                                                <small class="help-block form-text text-danger" id="error_shipping_lanline"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                   <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Product Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Search Product</label>
                                <input type="text" id="product_search" name="product_search"placeholder="Type part no. / Description name" class="form-control">
                                <small class="help-block form-text text-danger" id="error_product_search"></small>
                                <input type="hidden" id="order_product" value="">
                            </div>
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Qty</label>
                                <input type="text" id="prod_qty" required name="prod_qty[]" maxlength="5" placeholder="Qty" value="1" class="form-control">
                                <small class="help-block form-text text-danger" id="error_prod_qty"></small>
                            </div>
                            <div class="form-group col-2">
                                <label for="vat" class=" form-control-label required">Add Product</label>
                                <span href="" placeholder="Qty" value="1" class="form-control add_prod btn btn-primary"> Add Product</span>
                            </div>
                            <div class="form-group col-2">
                                <label for="vat" class=" form-control-label required">Add New Product</label>
                                <a href="{{route('add_product')}}" style="background:gree" required name="stn_hsn_no" target="_blank" placeholder="Qty" value="1" class="form-control btn btn-primary"><i class="zmdi zmdi-plus"></i> Add New Product</a>
                            </div>
                            <div class="form-group col-2">
                                <label for="vat" class=" form-control-label required">Product Filter</label>
                                <a href="{{route('show_product')}}" style="background:gree" placeholder="Qty" target="_blank" class="form-control btn btn-primary">Product Filter</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Quotation Summary</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Currrency</label>
                                <select id="currency" required name="currency" class="form-control">
                                    @if(!empty($currency))
                                        @foreach($currency as $id=>$cur)
                                            <option value="{{$id}}">{{$cur}}</option>
                                        @endforeach
                                    @else
                                        <p>Currrency are not available.</p>
                                    @endif
                                </select>
                            </div>
                            
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Payment Term</label>
                                <select id="payment_turm" name="payment_turm" class="form-control">
                                    @if(!empty($payment_term))
                                        @foreach($payment_term as $id=>$term)
                                            <option value="{{$id}}">{{$term}}</option>
                                        @endforeach
                                    @else
                                        <p>Currrency are not available.</p>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="company" class="form-control-label required">Extra Comments, If Any </label>
                                <textarea id="ext_note" required name="ext_note"placeholder="Write here . . . !" class="form-control">{{ old('ext_note', $data['quotation_info']['st_ext_note']) }}</textarea>
                                <small class="help-block form-text text-danger" id="error_ext_note"></small>
                            </div>
                            
                            <input type="hidden" name="hid_quotation_sub_total" id="hid_quotation_sub_total" value="0">
                            <input type="hidden" name="order_grand_total" id="order_grand_total" value="0">
                            <input type="hidden" name="order_nego_amount" id="order_nego_amount" value="0">
                            <input type="hidden" name="hid_order_prod_details[]" id="hid_order_prod_details" class="m-wrap span4" value="0">
                            <input type="hidden" name="hid_selprod" id="hid_selprod" class="m-wrap span4" value=""/>
                            <input type="hidden" name="hid_tax_amt" id="hid_tax_amt" value=""/>
                            <input type="hidden" name="bill_add_id" id="bill_add_id" value="<?php //echo //$this->uri->segment(3);?>"/>
                            <input type="hidden" name="hid_appliedCurrency" id="hid_appliedCurrency" value="rupees">
                            <input type="hidden" id="is_submit_quotation" value="0">
                            <div class="col-lg-12">
                              
                                    <table id="tblsummary" class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Part No.</th>
                                                <th>Description</th>
                                                <th>HSN Code</th>
                                                <th >Qty</th>
                                                <th >Instock</th>
                                                <th >Price [<span id="currencysymbol">INR</span>]</th>
                                                <th >Disc %</th>
                                                <th>Net Price</th>
                                                <th>IGST %</th>
                                                <th>Total</th>
                                                <th>Notes</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX classOdd tr-subtotal">
                                                <td colspan="9" ><strong class="pull-right pull-right">Sub Total  &ensp;</strong> </td>
                                                <td id="row_sub_total" style="text-align: left;"><strong class="final_subtotal">0.00</strong></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                               
                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Terms & Conditions</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group col-4">
                                <small> Payment Terms : </small>
                            </div>
                            <div class="form-group col-4">
                                <small> Tax :  </small>
                            </div>
                            <div class="form-group col-4">
                                <small> Quotation is valid for 30 days </small>
                            </div>
                            <div class="form-group col-6">
                                <small> Any Government / Local Body Levies, taxes, Cess, Duties, Octroi will be extra “At Actuals”  </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('show_quatation')}}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" id="is_submit_quotation" value="0">
    @if(Session::has('errors'))
        @if(!empty($errors->cutomer_add->any()))
            <script>
                $(document).ready(function(){
                    $('#addModal').modal({show: true});
                });
            </script>
        @endif
    @endif 
<!-- end add record -->
<script>
$(document).ready(function(){
    var flg_same_as_bill_add  = {!! json_encode(!empty($data['quotation_info']['flg_same_as_bill_add']) ? $data['quotation_info']['flg_same_as_bill_add'] : '') !!};
    if(flg_same_as_bill_add == 1){
        $('#shippingchk').prop('checked', true);
        $('#flg_same_as_bill_add').val(1);
    }else{
        $('#shippingchk').prop('checked', false);
        $('#flg_same_as_bill_add').val(0);
    }
    var product_field = {!! json_encode($data['quotation_details']) !!};
    if (product_field != null && product_field != ''){
        var html = '';
        $.each(product_field, function (key, products) {
            if(products.stn_hsn_no == null){ 
                var hsn = '';
            }else{
                var hsn = products.stn_hsn_no;
            }
            if(products.in_igst_rate == null){ 
                var igst =  '';
            }else{
                var igst = products.in_igst_rate;
            }
            html = html+'<tr id="prod_row_'+products.in_product_id+'" class="prod_row_deatails"><input type="hidden" style="width: 100px;" value="'+products.st_maker+'" name="prod_maker" class="prod_maker"><td class="prod_part_No">'+products.st_part_no+'</td><td  style="word-break:break-all;" class="prod_desc td-limit">'+products.st_product_desc+'</td><td  style="word-break:break-all;" class="prod_hsn">'+hsn+'</td><td style="word-break:break-all;"  class="prod_qty"><input style="width: 35px; box-shadow: 2px 5px #888888;" placeholder="Qty" type="text" class="quentity_changed prodqty_'+products.in_product_id+'" id="'+products.in_product_id+'" value="'+products.in_pro_qty+'" onchange="quentity_changed(this);"></td><td style="word-break:break-all;" >'+products.in_pro_qty+'</td><td style="word-break:break-all;" ><div class="tooltips"><input style="width: 75px; box-shadow: 2px 5px #888888;" type="text" placeholder="Price" class="prod_unit_price prod_unit_price_'+products.in_product_id+'" value="'+products.fl_pro_unitprice+'" onchange="prod_price_changed(this,'+products.in_product_id+');"></div></td><td style="word-break:break-all;" ><input type="text" style="width: 55px; box-shadow: 2px 5px #888888;" placeholder="Disc %" class="prod_disc_price prod_disc_price_'+products.in_product_id+'" value="'+products.fl_discount+'" onchange="prod_discount_price_changed(this,'+products.in_product_id+');"></td><td style="width: 75px; text-align: left;word-break:break-all;"  class="prod_net_price prod_netprice_'+products.in_product_id+'">'+products.fl_net_price+'</td><td style="text-align: left;word-break:break-all;width: 60px;" class=" "><input style="width: 45px; box-shadow: 2px 5px #888888;" type="text" placeholder="IGST" class="prod_igst_rate prod_igst_rate_'+igst+'" id="'+products.in_product_id+'" value="'+igst+'" onchange="igsttaxrate_changed(this);"></td><td style="text-align: left;word-break:break-all;width: 75px;" class="prod_row_total prod_row_total_'+products.in_product_id+'">'+products.fl_row_total+' &ensp;</td><td class="prod_deli_period prod_deli_period_'+products.in_product_id+'" style="word-break:break-all;"><textarea type="text" style="word-break:break-all; width:75px; box-shadow: 2px 5px #888888; background:#FFFFE3;" placeholder="Write . . . !" name="prod_deli_period" id="prod_deli_period_'+products.in_product_id+'" value=""></textarea></td><td><div class="row"><div class="form-group col-2"><a href="javascript:void(0);" title="Add Comments" class="addCF_'+products.in_product_id+' btn" style="float:left;padding:0" onClick=addCF('+products.in_product_id+'); data-id='+products.in_product_id+'><span class="pull-left"> </span>  <i class="fa fa-comment"></i></a></div><div class="form-group col-2"><a href="javascript:void(0);" title="Delete Product" onClick=delete_row('+products.in_product_id+'); class="btn" style="float:left;padding:0"><span class="pull-left"> </span>  <i class="fa fa-trash text-danger"></i></a></div></td></div>\n\</tr>';
        });
        $( html ).insertBefore( "#tblsummary .tr-subtotal" );
    }
    
    $('#quotation_form').submit(function(e){
        sel_prods_details.length = 0;
        $(".prod_row_deatails").each(function(key,obj){
            var prod_comments='';
            if(admin_rights == '1'){
                var prod_part_No = $(this).find('.prod_part_No').val().trim();
            }else{
                var prod_part_No = $(this).find('.prod_part_No').text();
                prod_part_No = prod_part_No.replace('#', '').trim();
            }
            var prod_id = parseInt($(this).attr("id").replace(/[^\d]/g, ''), 10);
            var prod_desc = $(this).find('.prod_desc').text().trim();
            var prod_maker = $(this).find('.prod_maker').val().trim();
            var prod_hsn = $(this).find('.prod_hsn').text().trim();
            var prodqty = $('.prodqty_'+prod_id).val().trim();
            var prod_unit_price     = $(this).find('.prod_unit_price').val().trim();
            var prod_disc_price     = $(this).find('.prod_disc_price').val().trim();
            var prod_deli_period    = $('#prod_deli_period_'+prod_id).val().trim();
            var prod_net_price      = $(this).find('.prod_net_price').text().trim();
            var prod_igst_rate      = $(this).find('.prod_igst_rate ').val().trim();
            var prod_row_total      = $(this).find('.prod_row_total').text().trim();
            if($('#comments_'+prod_id).val() != 'undefined' &&  $('#comments_'+prod_id).val() != '' && $('#comments_'+prod_id).val() != null){
                prod_comments          = $('#comments_'+prod_id).val().trim();
            }
            var customer_id = $( "#customer_id option:selected" ).val();
            sel_prods_details.push({
                'in_cust_id':           customer_id,
                'in_product_id':        prod_id, 
                'st_part_no':           prod_part_No,
                'st_product_desc':      prod_desc,
                'stn_hsn_no':           prod_hsn,
                'st_maker':             prod_maker,
                'in_pro_qty':           prodqty,
                'fl_pro_unitprice':     prod_unit_price,
                'fl_discount':          prod_disc_price,
                'in_pro_deli_period':   prod_deli_period,
                'in_igst_rate':         prod_igst_rate,
                'fl_net_price':         prod_net_price,
                'fl_row_total':         prod_row_total,
                'prod_comments':        prod_comments
            });
        });
        $("#hid_order_prod_details").val(JSON.stringify(sel_prods_details)); 
        $("#hid_quotation_sub_total").val($(".final_subtotal").text());
        $("#order_nego_amount").val($('#prod_grand_total').text().trim());
        if(sel_prods_details.length > 0){ 
            if($("#is_submit_quotation").val() == 0){ 
                var quotation_info = {};
                var customer_info = {};
                quotation_info.length = 0;
                customer_info.length = 0;
                var shipping_addr           = $("#shipping_addr").val();
                var shipping_email          = $("#shipping_email").val();
                var shipping_telephone      = $("#shipping_telephone").val();
                var shipping_lanline        = $("#shipping_lanline").val();
                var shipping_pin_code       = $("#shipping_pincod").val();
                var shipping_state          = $('#shipping_state').val();
                var shipping_city           = $('#shipping_city').val();
                var enq_ref_no              = $('#enq_ref_no').val();
                var dt_ref                  = $('#datepicker').val();
                var fl_fleight_pack_charg   = $('input[name="frieght_pack_charges"]').val();
                var st_tax_text             = $("#prod_tax option:selected" ).text();
                var vat_tax                 = $('#vat_tax').text();
                var fl_nego_amt             = $('.final_subtotal').text();
                var bill_add_id             = $('#bill_add_id').val();
                var preparing_by            = $('#preparing_by').val();
                var lead_from               = $('#lead_from').val();
                var currency  				= $( "#currency option:selected" ).text();
                var auto_pop_landline       = $('#auto_pop_landline').val();
                var payment_turm            = $("#payment_turm option:selected" ).text();
                var notify_group            = $('#notify_group').val();
                var select_owner            = $( "#select_owner option:selected" ).val();
                var auto_pop_addr           = $("#auto_pop_addr").val();
                var auto_pop_state          = $("#auto_pop_state").val();
                var auto_pop_city           = $("#auto_pop_city").val();
                var auto_pop_pincod         = $("#auto_pop_pincod").val();
                var auto_pop_phone          = $('#auto_pop_phone').val();
                var auto_pop_email          = $('#auto_pop_email').val();
                var product_search          = $('#product_search').val();
                var prod_qty                = $('#prod_qty').val();
                var ext_note                = $('#ext_note').val();
                var in_quot_id              = $('#in_quot_id').val();
                var flg_same_as_bill_add    = $('#flg_same_as_bill_add').val();
               
                quotation_info = {
                    'in_quot_id'    : in_quot_id,
                    'st_shiping_add' 	    : shipping_addr,
                    'st_shiping_city' 	    : shipping_city,
                    'st_shiping_state'      : shipping_state,
                    'st_shiping_pincode'    : shipping_pin_code,
                    'st_shipping_email'     : shipping_email,
                    'st_shipping_phone'     : shipping_telephone,
                    'shipping_lanline'      : shipping_lanline,
                    'st_enq_ref_number'     : enq_ref_no,
                    'dt_ref'                : dt_ref,
                    'fl_fleight_pack_charg' : fl_fleight_pack_charg,
                    'st_tax_text' 			: st_tax_text,
                    'fl_sales_tax_amt' 		: vat_tax,
                    'bill_add_id' 			: bill_add_id,
                    'payment_turm'			: payment_turm,
                    'currency'				: currency,
                    'st_landline'			: auto_pop_landline,
                    'fl_nego_amt' 			: fl_nego_amt,
                    'product_search'        : product_search,
                    'prod_qty'              : prod_qty,
                    'flg_same_as_bill_add'  : flg_same_as_bill_add
                };
                var auto_pop_phone = $("#auto_pop_phone").val();
                var auto_pop_company = $(".auto_pop_company").val();
                var auto_pop_cust_name = $("#auto_pop_cust_name").val();
                var auto_pop_state = $("#auto_pop_state").val();
                customer_info = {
                            'st_com_name' 		    : auto_pop_company,
                            'auto_pop_cust_name'	: auto_pop_cust_name,
                            'st_cust_mobile'	    : auto_pop_phone,
                            'auto_pop_state'	    : auto_pop_state,
                            'preparing_by' 		    : preparing_by,
                            'notify_group'          : notify_group,
                            'select_owner'          : select_owner,
                            'auto_pop_addr'         : auto_pop_addr,
                            'auto_pop_state'        : auto_pop_state,
                            'auto_pop_city'         : auto_pop_city,
                            'auto_pop_pincod'       : auto_pop_pincod,
                            'auto_pop_phone'        : auto_pop_phone,
                            'auto_pop_email'        : auto_pop_email,
                            'auto_pop_landline'     : auto_pop_landline,
                            'ext_note'              : ext_note,
                            'lead_from'				: lead_from,

                };
                var filepath = "{{route('preview_quatation')}}"
                $.ajax({
                    url:filepath,
                    target: "_blank",
                    type:'GET',
					async:false,
					dataType: 'json',
                    data: {'sel_prods_details' : sel_prods_details, 'customer_info' : customer_info, 'quotation_info' : quotation_info, "_token": "{{ csrf_token() }}"},
                    success: function(response) {
                        $("#is_submit_quotation").val('1');
						$("#privew-quote").html(response.quotation_data);
                    },error: function(error) {
                        if(error.status == 400){
                            var err = error.responseText;
                            var d = JSON.parse(err);
                            var getError = d.errors;
                            $.each(getError, function (key, field) {
                                $('#error_'+key).html('<b>'+field+'</b>');
                            });
                        }else{
                            console.log("something else !");
                        }
                    }
                });
                $('#quotation-preview-model').modal('show');
            }
        }else{
            $('#minProduct').modal('show');
            return false;
        }
        e.preventDefault();
    });
	$("#currency").on('focus', function () {
        previous = this.value;
    }).change(function() {
            var pastvalue = previous;
            previous = this.value;
            var currencytxt = $( "#currency option:selected" ).text();
            var currval = $( "#currency option:selected" ).val();                    
        if (!confirm('Are sure to change the currency ?')) {
                $("#currencysymbol").text('');
                $('#currency').val(pastvalue);
            return false;
        } else {
            $("#currencysymbol").text(currencytxt);
        }
    });

    $('html').click(function(e) {                    
        if(!$(e.target).hasClass('privew-quote-box') ){
            $("#is_submit_quotation").val("0");                
        }
    }); 

    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('#datepicker').datepicker({
        leftArrow: '&laquo;',
        rightArrow: '&raquo;',
        daysOfWeekHighlighted: "7,0",
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom',
        endDate:'today',
    });

    $('#customer_id').on('change', function(){
        $('#flg_same_as_bill_add').val(0);
        $('#shippingchk').prop('checked', false);
        $('#shipping_addr').val('');
        $('#shipping_state').val('');
        $('#shipping_pincod').val('');
        $('#shipping_city').val('');
        $('#shipping_telephone').val('');
        $('#shipping_email').val('');
        $('#shipping_lanline').val('');

        var c_id = $('#customer_id').val();
        var product_field = {!! json_encode($cust_details) !!};
        // Customer Details
        if(product_field['company_name'][c_id] != 'undefined' && product_field['company_name'][c_id] != ''){
            var company_name = product_field['company_name'][c_id];
            $('#company_name').val(company_name);
        }
        if(product_field['c_person_name'][c_id] != 'undefined' && product_field['c_person_name'][c_id] != ''){
            var c_person_name = product_field['c_person_name'][c_id];
            $('#auto_pop_cust_name').val(c_person_name);
        }
        // Billing Address
        if(product_field['address'][c_id] != 'undefined' && product_field['address'][c_id] != ''){
            var address = product_field['address'][c_id];
            $('#auto_pop_addr').val(address);
        }
        if(product_field['state'][c_id] != 'undefined' && product_field['state'][c_id] != ''){
            var state = product_field['state'][c_id];
            console.log(state);
            $('#auto_pop_state').val(state);
        }
        if(product_field['pincode'][c_id] != 'undefined' && product_field['pincode'][c_id] != ''){
            var pincode = product_field['pincode'][c_id];
            $('#auto_pop_pincod').val(pincode);
        }
        if(product_field['city'][c_id] != 'undefined' && product_field['city'][c_id] != ''){
            var city = product_field['city'][c_id];
            $('#auto_pop_city').val(city);
        }
        if(product_field['mobile'][c_id] != 'undefined' && product_field['mobile'][c_id] != ''){
            var mobile = product_field['mobile'][c_id];
            $('#auto_pop_phone').val(mobile);
        }
        if(product_field['email'][c_id] != 'undefined' && product_field['email'][c_id] != ''){
            var email = product_field['email'][c_id];
            $('#auto_pop_email').val(email);
        }
        if(product_field['land_line'][c_id] != 'undefined' && product_field['land_line'][c_id] != ''){
            var land_line = product_field['land_line'][c_id];
            $('#auto_pop_landline').val(land_line);
        }

        // Owner
        var owner_field = {!! json_encode($owner) !!};
        if(owner_field != null){
            var option = '<option value=""> Select Owner</option>';
            $.each(owner_field, function (key, field) {
                if(key == c_id){
                    option = option +'<option value="'+ key +'" selected >'+ field +'</option>';
                }else{
                    option = option + '<option value="'+ key +'">'+ field +'</option>';
                }
            });
            var sel = '<label for="vat" class=" form-control-label required" id="own_label">Owner</label><select name="select_owner" id="select_owner" class="form-control" required>'+option+'</select><small class="help-block form-text text-danger" id="error_select_owner"></small>';
            $('div #owner').html(sel);
        }
    });
    var owner_field = {!! json_encode($owner) !!};
    var option = '<option value="" > Select Owner</option>';
    var existing_owner = {!! json_encode(!empty($data['owner_id']) ? $data['owner_id'] : '') !!}; 
    $.each(owner_field, function (key, field) {
        if(key == existing_owner){
            option = option + '<option value="'+ key +'" selected>'+ field +'</option>';
        }else{
            option = option + '<option value="'+ key +'">'+ field +'</option>';
        }
    });
    var sel = '<label for="vat" class=" form-control-label required" id="own_label">Owner</label><select name="select_owner" required id="select_owner"  class="form-control">'+option+'</select><small class="help-block form-text text-danger" id="error_select_owner"></small>';
    $('div #owner').html(sel);

    $('#shippingchk').on('click', function(){
        if($("#shippingchk").prop('checked') == true){
            var address = $('#auto_pop_addr').val();
            $('#shipping_addr').val(address);
            $('#flg_same_as_bill_add').val(1);
            var state = $('#auto_pop_state').val();
            $('#shipping_state').val(state);

            var pincode = $('#auto_pop_pincod').val();
            $('#shipping_pincod').val(pincode);

            var city = $('#auto_pop_city').val();
            $('#shipping_city').val(city);

            var mobile = $('#auto_pop_phone').val();
            $('#shipping_telephone').val(mobile);

            var email = $('#auto_pop_email').val();
            $('#shipping_email').val(email);

            var land_line = $('#auto_pop_landline').val();
            $('#shipping_lanline').val(land_line);
        }else{
            // Clear shiping address
            $('#shippingchk').prop('checked', false);
            $('#flg_same_as_bill_add').val(0);
            $('#shipping_addr').val('');
            $('#shipping_state').val('');
            $('#shipping_pincod').val('');
            $('#shipping_city').val('');
            $('#shipping_telephone').val('');
            $('#shipping_email').val('');
            $('#shipping_lanline').val('');
        }
    });

    var sel_prods_details = [];
    $('.add_prod').click(function() {
        var	t = true;
        t = checkfirstprod();
        var html = '';
        if(t == 1){
            var arrprods = [];
            var sel_prods = [];
            var prod_qunt = 0;
            var prod_id = 0; 
            var new_product_list = {!! json_encode($new_product_list) !!};
            var prod_id_exist = 0;
            var str = $('#hid_selprod').val();
            if($('#hid_selprod').val() != ''){
                sel_prods.push( $("#hid_selprod").val());
            }
            prod_id = $('#order_product').val();
            var arr = str.split(',');
            if($.inArray(prod_id,arr) == -1){
                sel_prods.push(prod_id);
            }else{
                prod_id_exist = 1;
            } 
            $('#hid_selprod').val(sel_prods);            
            var html = '';	
            var prodqty = 0;
            var free_prod_qty = 0;
            var free_prod_txt = '';
            var prod_igst_rate = 0.00;
            var prod_part_No = '';
            var prod_desc = '';
            var prod_discount = 0.00;
            var prod_maker = '';
            var prod_price = 0.00;
            var prod_net_price = 0.00;
            var prod_row_total = 0.00;
            var cat_name = '';
            var newprodqty = 0;
            var prod_qty_left = 0;
            var call_sub_total = false;
            var hsn ='HSN Code: Awaited OR Provide Soon';
            var new_product_list = {!! json_encode($new_product_list) !!};
            if( new_product_list[prod_id] !='undefined' && new_product_list[prod_id] !=''){
                var products = new_product_list[prod_id];
                var partNoHtml ='';
                if(products.st_part_No == prod_id && prod_id_exist == 1){ 
                    var prev_prod_qnt = $(".prodqty_"+products.pro_id).val();
                    prodqty = parseInt(parseInt(prev_prod_qnt) + parseInt($('#prod_qty').val()));
                    prod_igst_rate = products.str_igst_rate;
                    prod_price = products.fl_pro_price;
                    prod_discount = products.in_pro_disc;
                    prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
                    hsn = products.stn_hsn_no;
                    
                    if(prod_igst_rate != '' && prod_igst_rate != null){
                        prod_row_total = parseFloat(prod_net_price + parseFloat((prod_net_price*prod_igst_rate)/(100)));
                    }else{ 
                        prod_igst_rate = 0.00;
                        prod_row_total = parseFloat(prod_net_price*prodqty);
                    }
                    $(".prodqty_"+products.pro_id).val(prodqty);
                    $(".prod_disc_price_"+products.pro_id).val(prod_discount);
                    $(".prod_unit_price_"+products.pro_id).html(prod_price);
                    $(".prod_igst_rate_"+products.pro_id).html(prod_igst_rate);
                    $(".prod_netprice_"+products.pro_id).html(prod_net_price);
                    qty_change(products.pro_id, prodqty, prod_net_price, prod_row_total);
                    
                }else if(products.st_part_No == prod_id && prod_id_exist == 0){    
                    call_sub_total = true;
                    prodqty = $('#prod_qty').val();
                    prod_part_No = products.st_part_No;
                    cat_name = products.st_cat_name;
                    hsn = products.stn_hsn_no;
                    if(hsn == null){
                        hsn = '';
                    }
                    prod_price = products.fl_pro_price;
                    prod_desc = products.st_pro_desc;
                    prod_igst_rate = products.str_igst_rate;
                    prod_maker = products.st_pro_maker;
                    prod_discount = products.in_pro_disc;
                    
                    prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
                    var prod_row_without_igst_total = parseFloat(prod_net_price*prodqty);
                    if(prod_igst_rate != '' && prod_igst_rate != null){
                        prod_row_total = parseFloat(prod_row_without_igst_total + parseFloat((prod_row_without_igst_total*prod_igst_rate)/(100)));
                    }else{
                        prod_igst_rate = 0.00;
                        prod_row_total = parseFloat(prod_net_price*prodqty);
                    }
                    prod_qty_left = parseInt(products.in_pro_qty) - parseInt(prodqty);
                    if(admin_rights == '1'){
                        partNoHtml = '<input type="text" style="width: 100px;" value="'+prod_part_No+'" name="prod_part_No" class="prod_part_No">';
                        var classs = '';
                    }else{
                        partNoHtml = prod_part_No;
                        var classs = 'prod_part_No';
                    }
                    html = '<tr id="prod_row_'+products.pro_id+'" class="prod_row_deatails"><input type="hidden" style="width: 100px;" value="'+prod_maker+'" name="prod_maker" class="prod_maker"><td class="'+classs+'">'+partNoHtml+'</td><td  style="word-break:break-all;" class="prod_desc td-limit">'+prod_desc+'</td><td  style="word-break:break-all;" class="prod_hsn">'+hsn+'</td><td style="word-break:break-all;"  class="prod_qty"><input style="width: 35px; box-shadow: 2px 5px #888888;" placeholder="Qty" type="text" class="quentity_changed prodqty_'+products.pro_id+'" id="'+products.pro_id+'" value="'+prodqty+'" onchange="quentity_changed(this);"></td><td style="word-break:break-all;" >'+products.in_pro_qty+'</td><td style="word-break:break-all;" ><div class="tooltips"><input style="width: 75px; box-shadow: 2px 5px #888888;" type="text" placeholder="Price" class="prod_unit_price prod_unit_price_'+products.pro_id+'" value="'+prod_price+'" onchange="prod_price_changed(this,'+products.pro_id+');"></div></td><td style="word-break:break-all;" ><input type="text" style="width: 55px; box-shadow: 2px 5px #888888;" placeholder="Disc %" class="prod_disc_price prod_disc_price_'+products.pro_id+'" value="'+prod_discount+'" onchange="prod_discount_price_changed(this,'+products.pro_id+');"></td><td style="width: 75px; text-align: left;word-break:break-all;"  class="prod_net_price prod_netprice_'+products.pro_id+'">'+prod_net_price+'</td><td style="text-align: left;word-break:break-all;width: 60px;" class=" "><input style="width: 45px; box-shadow: 2px 5px #888888;" type="text" placeholder="IGST" class="prod_igst_rate prod_igst_rate_'+products.pro_id+'" id="'+products.pro_id+'" value="'+prod_igst_rate+'" onchange="igsttaxrate_changed(this);"></td><td style="text-align: left;word-break:break-all;width: 75px;" class="prod_row_total prod_row_total_'+products.pro_id+'">'+prod_row_total+' &ensp;</td><td class="prod_deli_period prod_deli_period_'+products.pro_id+'" style="word-break:break-all;"><textarea type="text" style="word-break:break-all; width:75px; box-shadow: 2px 5px #888888; background:#FFFFE3;" placeholder="Write . . . !" name="prod_deli_period" id="prod_deli_period_'+products.pro_id+'" value=""></textarea></td><td><div class="row"><div class="form-group col-2"><a href="javascript:void(0);" title="Add Comments" class="addCF_'+products.pro_id+' btn" style="float:left;padding:0" onClick=addCF('+products.pro_id+'); data-id='+products.pro_id+'><span class="pull-left"> </span>  <i class="fa fa-comment"></i></a></div><div class="form-group col-2"><a href="javascript:void(0);" title="Delete Product" onClick=delete_row('+products.pro_id+'); class="btn" style="float:left;padding:0"><span class="pull-left"> </span>  <i class="fa fa-trash text-danger"></i></a></div></td></div>\n\</tr>';
                }
                console.log(html);
                $( html ).insertBefore( "#tblsummary .tr-subtotal" );
                if(call_sub_total == true){
                    get_prod_row_sub_total();
                }
            }else{
                html = '<tr id="prod_row" class="prod_row_deatails"><input type="hidden" style="width: 100px;" value="" name="" class=""><td class=""></td></tr>';
                $( html ).insertBefore( "#tblsummary .tr-subtotal" );
            }
        }
    });

    $(".add-quotation").click(function(){
        sel_prods_details.length = 0;
        $(".prod_row_deatails").each(function(key,obj){
            var prod_comments='';
            if(admin_rights == '1'){
                var prod_part_No = $(this).find('.prod_part_No').val().trim();
            }else{
                var prod_part_No = $(this).find('.prod_part_No').text();
                prod_part_No = prod_part_No.replace('#', '').trim();
            }
            var prod_id = parseInt($(this).attr("id").replace(/[^\d]/g, ''), 10);
            var prod_desc = $(this).find('.prod_desc').text().trim();
            var prod_maker = $(this).find('.prod_maker').val().trim();
            var prod_hsn = $(this).find('.prod_hsn').text().trim();
            var prodqty = $('.prodqty_'+prod_id).val().trim();
            var prod_unit_price     = $(this).find('.prod_unit_price').val().trim();
            var prod_disc_price     = $(this).find('.prod_disc_price').val().trim();
            var prod_deli_period    = $('#prod_deli_period_'+prod_id).val().trim();
            var prod_net_price      = $(this).find('.prod_net_price').text().trim();
            var prod_igst_rate      = $(this).find('.prod_igst_rate ').val().trim();
            var prod_row_total      = $(this).find('.prod_row_total').text().trim();
            if($('#comments_'+prod_id).val() != 'undefined' &&  $('#comments_'+prod_id).val() != '' && $('#comments_'+prod_id).val() != null){
                prod_comments          = $('#comments_'+prod_id).val().trim();
            }
            var customer_id = $( "#customer_id option:selected" ).val();
            sel_prods_details.push({
                        'in_cust_id':           customer_id,
                        'in_product_id':        prod_id, 
                        'st_part_no':           prod_part_No,
                        'st_product_desc':      prod_desc,
                        'stn_hsn_no':           prod_hsn,
                        'st_maker':             prod_maker,
                        'in_pro_qty':           prodqty,
                        'fl_pro_unitprice':     prod_unit_price,
                        'fl_discount':          prod_disc_price,
                        'in_pro_deli_period':   30,
                        'in_igst_rate':         prod_igst_rate,
                        'fl_net_price':         prod_net_price,
                        'fl_row_total':         prod_row_total,
                        'prod_comments':        prod_comments
            });
        });
        $("#hid_order_prod_details").val(JSON.stringify(sel_prods_details)); 
        $("#hid_quotation_sub_total").val($(".final_subtotal").text());
        $("#order_nego_amount").val($('#prod_grand_total').text().trim());
        $("#is_submit_quotation").val(0);
        if(sel_prods_details.length > 0){ 
            if($("#is_submit_quotation").val() == 0){ 
                var quotation_info = {};
                var customer_info = {};
                quotation_info.length = 0;
                customer_info.length = 0;
                var shipping_addr           = $("#shipping_addr").val();
                var shipping_email          = $("#shipping_email").val();
                var shipping_telephone      = $("#shipping_telephone").val();
                var shipping_lanline        = $("#shipping_lanline").val();
                var shipping_pin_code       = $("#shipping_pincod").val();
                var shipping_state          = $('#shipping_state').val();
                var shipping_city           = $('#shipping_city').val();
                var enq_ref_no              = $('#enq_ref_no').val();
                var dt_ref                  = $('#datepicker').val();
                var fl_fleight_pack_charg   = $('input[name="frieght_pack_charges"]').val();
                var st_tax_text             = $("#prod_tax option:selected" ).text();
                var vat_tax                 = $('#vat_tax').text();
                var fl_nego_amt             = $('.final_subtotal').text();
                var bill_add_id             = $('#bill_add_id').val();
                var preparing_by            = $('#preparing_by').val();
                var lead_from               = $('#lead_from').val();
                var currency  				= $( "#currency option:selected" ).text();
                var auto_pop_landline       = $('#auto_pop_landline').val();
                var payment_turm            = $("#payment_turm option:selected" ).text();
                var notify_group            = $('#notify_group').val();
                var select_owner            = $( "#select_owner option:selected" ).val();
                var auto_pop_addr           = $("#auto_pop_addr").val();
                var auto_pop_state          = $("#auto_pop_state").val();
                var auto_pop_city           = $("#auto_pop_city").val();
                var auto_pop_pincod         = $("#auto_pop_pincod").val();
                var auto_pop_phone          = $('#auto_pop_phone').val();
                var auto_pop_email          = $('#auto_pop_email').val();
                var product_search          = $('#product_search').val();
                var prod_qty                = $('#prod_qty').val();
                var ext_note                = $('#ext_note').val();
                var in_quot_id              = $('#in_quot_id').val();
                var flg_same_as_bill_add    = $('#flg_same_as_bill_add').val();
                var in_quot_num             = $('#in_quot_num').val();
                var existing_cust_id        = $('#in_cust_id').val();
                var customer_id             = $( "#customer_id option:selected" ).val();

                quotation_info = {
                    'in_quot_id'            : in_quot_id,
                    'in_quot_num'           : in_quot_num,
                    'existing_cust_id'      : existing_cust_id,
                    'st_shiping_add' 	    : shipping_addr,
                    'flg_same_as_bill_add'  : flg_same_as_bill_add,
                    'st_shiping_city' 	    : shipping_city,
                    'st_shiping_state'      : shipping_state,
                    'st_shiping_pincode'    : shipping_pin_code,
                    'st_shipping_email'     : shipping_email,
                    'st_shipping_phone'     : shipping_telephone,
                    'shipping_lanline'      : shipping_lanline,
                    'st_enq_ref_number'     : enq_ref_no,
                    'dt_ref'                : dt_ref,
                    'fl_fleight_pack_charg' : fl_fleight_pack_charg,
                    'st_tax_text' 			: st_tax_text,
                    'fl_sales_tax_amt' 		: vat_tax,
                    'bill_add_id' 			: bill_add_id,
                    'payment_turm'			: payment_turm,
                    'currency'				: currency,
                    'st_landline'			: auto_pop_landline,
                    'fl_nego_amt' 			: fl_nego_amt,
                    'product_search'        : product_search,
                    'prod_qty'               : prod_qty
                };

                var auto_pop_phone = $("#auto_pop_phone").val();
                var auto_pop_company = $(".auto_pop_company").val();
                var auto_pop_cust_name = $("#auto_pop_cust_name").val();
                var auto_pop_state = $("#auto_pop_state").val();
                var customer_id = $( "#customer_id option:selected" ).val();
                customer_info = {
                            'st_com_name' 		    : auto_pop_company,
                            'auto_pop_cust_name'	: auto_pop_cust_name,
                            'st_cust_mobile'	    : auto_pop_phone,
                            'auto_pop_state'	    : auto_pop_state,
                            'preparing_by' 		    : preparing_by,
                            'notify_group'          : notify_group,
                            'select_owner'          : select_owner,
                            'auto_pop_addr'         : auto_pop_addr,
                            'auto_pop_state'        : auto_pop_state,
                            'auto_pop_city'         : auto_pop_city,
                            'auto_pop_pincod'       : auto_pop_pincod,
                            'auto_pop_phone'        : auto_pop_phone,
                            'auto_pop_email'        : auto_pop_email,
                            'auto_pop_landline'     : auto_pop_landline,
                            'ext_note'              : ext_note,
                            'lead_from'				: lead_from,
                            'customer_id'           : customer_id
                };
                var filepath = "{{route('store_update_quatation')}}";
                var home_page = "{{route('show_quatation')}}"; 
                $.ajax({
                    url:filepath,
                    type:'POST',
					async:false,
					dataType: 'json',
                    data: {'sel_prods_details' : sel_prods_details, 'customer_info' : customer_info, 'quotation_info' : quotation_info, "_token": "{{ csrf_token() }}"},
                    success: function(response) {
                        if(response.code == 200){
                            $('div .success-response').html(response.success);
                            $('#quotation-preview-model').modal('hide');
                            $('#quoteUpdate').modal('show');
                        } 
                        setTimeout(function(){ window.location = home_page; }, 2000);
                    },error: function(error) {
                       console.log(error);
                    }
                });
            }else{
                console.log("in else");
            }
        }else{
            $('#minProduct').modal('show');
            return false;
        } 
    });
});

    var admin_rights = '<?php //echo $this->session->userdata('admin_rights');?>';
    var sel_prods_details = [];

    /*To validate first product...*/
    function checkfirstprod(){
        var req = 1;
        var prod_id = $('#order_product').val();
        if($('#order_product').val() =='' && parseInt($('#prod_qty').val()) == ''){
            $('#nameQuantity').modal('show');
            req = 0;			
        }else if( $('#order_product').val() !='' && $('#prod_qty').val()=='') {
            $('#validQuantity').modal('show');
            req = 0;		
        }else if( ($('#order_product').val() !='' && parseInt($('#prod_qty').val())=='')) {
            $('#validQuantity').modal('show');
            req = 0;		
        }else if( ($('#order_product').val() !='' && parseInt($('#prod_qty').val()) <=0)) {
            $('#validQuantity').modal('show');
            req = 0;		
        }else if( ($('#order_product').val() =='' && parseInt($('#prod_qty').val())!='') ) {
            $('#selectProduct').modal('show');
            req = 0;		
        }else if( $('#prod_qty').val()!='' && ($.isNumeric($('#prod_qty').val()) == false || (parseInt($('#prod_qty').val()) <= 0 || $('#prod_qty').val().indexOf('.') !== -1) )){
            $('#validQuantity').modal('show');
            req = 0;			
        }else{
            req = 1;	
        }
        return req;
    }

    function get_cust_prods_qty(prod_id){
        $("#prod-loadimg").removeClass('dnone');
        var result = 0;		
        var filepath = '<?php //echo base_url();?>quotation/ajax_get_cust_prods_qty';
        $.ajax({
            url:filepath,
            type:'POST',
            async:false,
            dataType: 'text',
            data:{prod_id:prod_id},		
            success: function(res) {
                $("#prod-loadimg").addClass('dnone');				
                result = res;
            }
        });
        return result;	
    }

    function qty_change(prod_id ,prodqty, prod_net_price, prod_row_total){
        if((prodqty <= 0) || ($.isNumeric(prodqty) == false)){
            $('#validQuantity').modal('show');
        }else{
            alert(prod_row_total);
            $(".prod_netprice_"+prod_id).html(prod_net_price);
            $(".prod_row_total_"+prod_id).html(prod_row_total.toFixed(2));
            get_prod_row_sub_total();
        }
    }

    function get_prod_row_sub_total(){
        var sub_total_amt = 0.00;
        $(".prod_row_total").each(function(i, obj) {
            var row_price = parseFloat($(this).text());
            sub_total_amt += parseFloat(row_price);
        });
        $("#row_sub_total").html("<strong class='final_subtotal'>"+parseFloat(sub_total_amt).toFixed(2)+"</strong>");
    }

    function delete_row(prod_id){
        var str = $('#hid_selprod').val();
        var arr = str.split(',');
        var itemtoRemove = prod_id;
        arr.splice($.inArray(itemtoRemove, arr),1);
        $('#hid_selprod').val(arr);
        $("#prod_row_"+prod_id).remove();
        $("#prod_row_"+prod_id).remove();
        $("#comment_row_"+prod_id).remove();	
        /* Calculate sub total amt */
        get_prod_row_sub_total();   
    }
    function get_tax_val(obj){
        var tax_value = obj.value.split('_');
        var tax_perc_val = parseFloat(tax_value[1]).toFixed(2); 
        var final_subtotal = parseFloat($(".final_subtotal").text()).toFixed(2);
        var frieght_pack_charges = $("input[name='frieght_pack_charges']").val();
        if(frieght_pack_charges == ""){
            frieght_pack_charges = 0.00;
        }
        var tax_on_total = parseFloat(final_subtotal) + parseFloat(frieght_pack_charges);
        if(tax_perc_val != ""){
            var total_tax_amt = parseFloat((parseFloat(tax_perc_val)*parseFloat(tax_on_total))/100).toFixed(2);
            $("#vat_tax").html(total_tax_amt);
            $("#hid_tax_amt").val(total_tax_amt);
        }else{
            $("#vat_tax").html(0.00);
            $("#hid_tax_amt").val(0.00);
            
        }
    }


    function calc_prod_grand_total(subtotal_amt, tax_amt){
        var prod_grand_total = 0.00;
        var frieght_pack_charges = $("input[name='frieght_pack_charges']").val();
        if(frieght_pack_charges == ""){
            frieght_pack_charges = 0.00;
        }
        prod_grand_total = parseFloat(parseFloat(subtotal_amt)+parseFloat(tax_amt));
        prod_grand_total_new = parseFloat(parseFloat(prod_grand_total) + parseFloat(frieght_pack_charges));
        $("#prod_grand_total").html(prod_grand_total_new).toFixed(2);
        $("#order_grand_total").val(prod_grand_total_new);
        $("#order_nego_amount").val(prod_grand_total_new);
    }

    function igsttaxrate_changed(obj){
        var prod_id = obj.id;
        var prodqty = $(".prodqty_"+prod_id).val();
        var prod_price = $(".prod_unit_price_"+prod_id).val();
        var prod_igstrate = $(".prod_igst_rate_"+prod_id).val();
        var prod_discount = $(".prod_disc_price_"+prod_id).val();
        var prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
        var prod_row_without_igst_total = parseFloat(prod_net_price*prodqty);
        var prod_row_total = parseFloat(prod_row_without_igst_total + parseFloat((prod_row_without_igst_total*prod_igstrate)/(100)));
        qty_change(prod_id, prodqty, prod_row_without_igst_total, prod_row_total);
    }

    function quentity_changed(obj){
        var prod_id = obj.id;
        var prodqty = $(".prodqty_"+prod_id).val();
        var prod_price = $(".prod_unit_price_"+prod_id).val();
        var prod_igst_rate = $(".prod_igst_rate_"+prod_id).val();
        var prod_discount = $(".prod_disc_price_"+prod_id).val();
        var prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
        var prod_row_without_igst_total = parseFloat(prod_net_price*prodqty);
        var prod_row_total = parseFloat(prod_row_without_igst_total + parseFloat((prod_row_without_igst_total*prod_igst_rate)/(100)));
        qty_change(prod_id, prodqty, prod_row_without_igst_total, prod_row_total);
    }

    function prod_price_changed(obj, prod_id){
        var prod_unit_price = obj.value;
        var prodqty = $(".prodqty_"+prod_id).val();				
        var prod_price = prod_unit_price;
        var prod_discount = $(".prod_disc_price_"+prod_id).val();
        var prod_igst_rate = $(".prod_igst_rate_"+prod_id).val();
        var prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
        var prod_row_without_igst_total = parseFloat(prod_net_price*prodqty);
        if(prod_igst_rate != '' || prod_igst_rate != null){
            alert("in if");
            var prod_row_total = parseFloat(x + parseFloat((prod_row_without_igst_total*prod_igst_rate)/(100)));
        }else{
            alert("in ifelse");
            var  prod_row_total = parseFloat(prod_net_price*prodqty);
        }
        qty_change(prod_id, prodqty, prod_row_without_igst_total, prod_row_total);
    }


    function prod_discount_price_changed(obj, prod_id){
        var prod_disc_price = obj.value;
        var prodqty = $(".prodqty_"+prod_id).val();				
        var prod_price = $(".prod_unit_price_"+prod_id).val();
        var prod_igst_rate = $(".prod_igst_rate_"+prod_id).val();
        var prod_discount = prod_disc_price;
        var prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
        var prod_row_without_igst_total = parseFloat(prod_net_price*prodqty);
        if(prod_igst_rate != '' || prod_igst_rate != null){
            var prod_row_total = parseFloat(prod_row_without_igst_total + parseFloat((prod_row_without_igst_total*prod_igst_rate)/(100)));
        }else{
            var  prod_row_total = parseFloat(prod_net_price*prodqty);
        }
        qty_change(prod_id, prodqty, prod_row_without_igst_total, prod_row_total);
    }

    function quotation_submit(){
        $("#tax_text").val($( "#prod_tax option:selected" ).text());
        $("#quotation_form").submit();
    }

    function quotation_edit(){
        $('#quotation-preview-model').modal('hide');
        $("#is_submit_quotation").val("0");
    }

    function addCF(parameters){
        var  htmlcommentd = '<tr id="comment_row_'+parameters+'" valign="top"><td colspan="11"><textarea id="comments_'+parameters+'"  class="comments_'+parameters+' form-control" style="background:#FFFFE3;" name="ext_note" id="ext_note" placeholder="Please add any extra comments if any."></textarea></td><td><a href="javascript:void(0);"  title="Close comment" onClick=remCF('+parameters+'); class="remCF_'+parameters+'"  data-id='+parameters+'><i class="fa fa-trash text-danger"></i></a></td></tr>';
                $( htmlcommentd ).insertAfter( "#tblsummary #prod_row_"+parameters );
                $('.addCF_'+parameters).hide();
                
    }

    function remCF(parameters){
        var str = $('#hid_selprod').val();
        var arr = str.split(',');
        var itemtoRemove = parameters;
        arr.splice($.inArray(itemtoRemove, arr),1);
        $('#hid_selprod').val(arr);
        $("#comment_row_"+parameters).remove();
        $('.addCF_'+parameters).show();
    }
    


$(function(){
    url = "{{ route('all_product') }}";
    $("#product_search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: url,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength:3,   
    });
    $("#product_search").blur(function(){
        var product_search = $(this).val();
        var products = {!! json_encode($new_product_list) !!};
        if( products[product_search] !='undefined' && products[product_search] !=''){
            $("#order_product").val(product_search);
        }
    });
});
</script>
@endsection
@section('addModal')
<!-- add records -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_customer')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Customer Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="customer_name" required placeholder="Name" value="{{old('customer_name')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Last Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="customer_last_name"  required  placeholder="Last name" value="{{old('customer_last_name')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_last_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Company Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="customer_company_name"  required  placeholder="company name" value="{{old('customer_company_name')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_company_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_company_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="customer_email"  required  placeholder="Email" value="{{old('customer_email')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_email') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Select Region</label>
                        </div>
                        <div class="col-12 col-md-8">
                            @if(!empty($regions_id))
                                <select name="customer_region"  required class="form-control">
                                    <option value="">Select Region</option>
                                    @foreach($regions_id as $rk=>$rv)
                                        @if (old('customer_region') == $rk)
                                            <option value="{{$rk}}" selected>{{ $rv }}</option>
                                        @else
                                            <option value="{{ $rk }}">{{ $rv }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->cutomer_add->has('customer_region'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_region') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Mobile No.</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text"  name="customer_mobile"  required  placeholder="Mobile" value="{{old('customer_mobile')}}" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            @if ($errors->cutomer_add->has('customer_mobile'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_mobile') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">GST No.</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text"  name="gst_no"  required  placeholder="GST No." maxlength="15" value="{{old('gst_no')}}" class="form-control" >
                            @if ($errors->cutomer_add->has('gst_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('gst_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Tin No.</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text"  name="tin_no" placeholder="Tin No."  required  maxlength="15" value="{{old('tin_no')}}" class="form-control" >
                            @if ($errors->cutomer_add->has('tin_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('tin_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">First Person Details</label>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="persion1_name"  required  placeholder="Name" value="{{old('persion1_name')}}"  class="form-control">
                                @if ($errors->cutomer_add->has('persion1_name'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->cutomer_add->first('persion1_name') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col col-md-3">
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="persion1_email"  required  placeholder="Email" value="{{old('persion1_email')}}"  class="form-control">
                                @if ($errors->cutomer_add->has('persion1_email'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->cutomer_add->first('persion1_email') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col col-md-3">
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text"  name="persion1_mobile"  required  placeholder="Mobile" value="{{old('persion1_mobile')}}"  class="form-control" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                @if ($errors->cutomer_add->has('persion1_mobile'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->cutomer_add->first('persion1_mobile') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class="form-control-label required">Second Person Details</label>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="persion2_name"  required  placeholder="name" value="{{old('persion2_name')}}" class="form-control">
                                @if ($errors->cutomer_add->has('persion2_name'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->cutomer_add->first('persion2_name') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col col-md-3">
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name= "persion2_email"  required  value="{{old('persion2_email')}}" placeholder="email" class="form-control">
                                @if ($errors->cutomer_add->has('persion2_email'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->cutomer_add->first('persion2_email') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col col-md-3">
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text"  name="persion2_mobile"  required  value="{{old('persion2_mobile')}}" placeholder="Mobile" class="form-control" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                @if ($errors->cutomer_add->has('persion2_mobile'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->cutomer_add->first('persion2_mobile') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Address</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <textarea type="text" name="customer_address"  required  placeholder="Address . . . !" value="{{old('customer_address')}}" class="form-control"></textarea>
                            @if ($errors->cutomer_add->has('customer_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_address') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">City</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name= "customer_city" placeholder="city"  required  value="{{old('customer_city')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_city'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_city') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">State</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text"  name="customer_state" placeholder="State"  required  value="{{old('customer_state')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_state'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_state') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Pin Code</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text"  name="customer_pincode"  required  placeholder="Pin Code" value="{{old('customer_pincode')}}" class="form-control">
                            @if ($errors->cutomer_add->has('customer_pincode'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_pincode') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Select Branch</label>
                        </div>
                        <div class="col-12 col-md-8">
                            @if(!empty($branch_wise))
                                <select name="customer_branch" class="form-control"  required >
                                    <option value="">Select Branch</option>
                                    @foreach($branch_wise as $kb=>$vb)
                                        <option  value="{{$kb}}"  {{ ($kb == old('customer_branch',$vb))?'selected':'' }} >{{$vb}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->cutomer_add->has('customer_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->cutomer_add->first('customer_branch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden"  name="type" value="quatation">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end add records -->
@endsection

@section('minProduct')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="deleteForm">
            @csrf
            <div class="modal-body">
                <p class="text-danger">Minimum one product for quotation is required.</p>
            </div>
            <div class="modal-footer">
                <span  class="btn btn-primary" data-dismiss="modal">Ok</span>
            </div>
        </form>
    </div>
@endsection

@section('nameQuantity')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="deleteForm">
            @csrf
            <div class="modal-body">
                <p class="text-danger">Please select product name and quantity.</p>
            </div>
            <div class="modal-footer">
                <span  class="btn btn-primary" data-dismiss="modal">Ok</span>
            </div>
        </form>
    </div>
@endsection

@section('validQuantity')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="deleteForm">
            @csrf
            <div class="modal-body">
                <p class="text-danger">Please enter valid product quantity.</p>
            </div>
            <div class="modal-footer">
                <span  class="btn btn-primary" data-dismiss="modal">Ok</span>
            </div>
        </form>
    </div>
@endsection

@section('selectProduct')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="deleteForm">
            @csrf
            <div class="modal-body">
                <p class="text-danger">Please select product.</p>
            </div>
            <div class="modal-footer">
                <span  class="btn btn-primary" data-dismiss="modal">Ok</span>
            </div>
        </form>
    </div>
@endsection

@section('quoteUpdate')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Updates</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-success">Quotation updated Successfully. </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
@endsection



<!-- Quatation Preview-->
@section('quotation-preview-model')
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="largeModalLabel">Quotation Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div id="privew-quote" class="privew-quote-box"></div>          
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit</button>
        <button type="button" class="btn btn-primary add-quotation">Update Quotation</button>&nbsp;&nbsp;
    </div>
</div>
@endsection
<!-- End Quatation Preview-->