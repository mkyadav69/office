@extends('theme.layout.base_layout')
@section('title', 'Update Partial Orders')
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
                <h5 class="modal-title" id="largeModalLabel">Update Partial Orders</h5>
            </div>
           
            <form action="" name="quotation_form" id="quotation_form"  role="form">
                <input type="hidden" name="flg_same_as_bill_add" id="flg_same_as_bill_add" value=""/>
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Customer Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Quotation No. </label>
                                    <input type="text" id="company_name" required disabled name="quotation_no" placeholder="Quotaion No." value="{{ old('quotation_no', !empty($data['quotaion_no']) ? $data['quotaion_no'] : '') }}" class="form-control">
                                    <small class="help-block form-text text-danger" id="error_st_com_name"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Company Name</label>
                                    <input type="text" id="company_name" disabled required  name="company_name" placeholder="Customer Name" value="{{ old('comapany_name', !empty($data['comapany_name']) ? $data['comapany_name'] : '') }}" class="form-control">
                                    <small class="help-block form-text text-danger" id="comapany_name"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Contact Person</label>
                                <input type="text" id="contact_person" required disabled name="contact_person" placeholder="Contact Person" value="{{ old('contact_person', !empty($data['contact_person']) ? $data['contact_person'] : '') }}" class="form-control contact_person">
                                <small class="help-block form-text text-danger" id="contact_person"></small>
                            </div>
                        </div>
                        <div class="row form-group">
                           
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Order Prepared By </label>
                                <input type="text" name="preparing_by" required id="preparing_by" placeholder="Order Prepared By" value="{{ old('preparing_by') }}" class="form-control">
                                <b><small class="help-block form-text text-danger" id="error_preparing_by"></small></b>
                            </div>
                           
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Customer Order No.</label>
                                    <input type="text" id="customer_order_no" required  name="customer_order_no" value="{{ old('customer_order_no') }}" class="form-control">
                                    <small class="help-block form-text text-danger" id="qoute_no"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Customer Order Date. </label>
                                <input type="text" name="order_date" required id="order_date" class="form-control" value="{{ old('customer_order_date') }}" placeholder="DD-MM-YYY" />
                                <small class="help-block form-text text-danger" id="customer_order_date"></small>
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
                                                <textarea type="text" id="billing_addres" required name="billing_addres" placeholder="Address" class="form-control billing_addres">{{ old('billing_addres', !empty($data['billing_addres']) ? $data['billing_addres'] : '' ) }}</textarea>
                                                <small class="help-block form-text text-danger" id="error_auto_pop_addr"></small>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">State</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="billing_state" required name="billing_state" placeholder="State" value="{{ old('billing_state', !empty($data['billing_state']) ? $data['billing_state'] : '') }}" class="form-control billing_state">
                                                <small class="help-block form-text text-danger" id="billing_state"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">City</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="billing_city" required name="billing_city" placeholder="City" value="{{ old('billing_city', !empty($data['billing_city']) ? $data['billing_city'] : '') }}" class="form-control auto_pop_city">
                                                <small class="help-block form-text text-danger" id="error_auto_pop_city"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Pin Code</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="billing_pincode" required name="billing_pincode" placeholder="Pin Code" value="{{ old('auto_pop_pincod', !empty($data['billing_pincode']) ? $data['billing_pincode'] : '') }}" class="form-control billing_pincode">
                                                <small class="help-block form-text text-danger" id="billing_pincode"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Mobile No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="billing_phone" required name="billing_phone" placeholder="Mobile No." value="{{ old('billing_phone', !empty($data['billing_phone']) ? $data['billing_phone'] : '') }}" class="form-control billing_phone">
                                                <small class="help-block form-text text-danger" id="billing_phone"></small>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Email</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="email" id="billing_email" required name="billing_email" placeholder="Email" value="{{ old('billing_email', !empty($data['billing_email']) ? $data['billing_email'] : '' ) }}" class="form-control billing_email">
                                                <small class="help-block form-text text-danger" id="billing_email"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="billing_landline" required name="billing_landline" value="{{ old('billing_landline', !empty($data['billing_landline']) ? $data['billing_landline'] : '') }}" placeholder="Land-Line No." class="form-control auto_pop_landline">
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
                                                <textarea type="text" id="shiping_addres" required name="shiping_addres" placeholder="Address" class="form-control shiping_addres">{{ old('shiping_addres', !empty($data['shiping_addres']) ? $data['shiping_addres'] : '') }}</textarea>
                                                <small class="help-block form-text text-danger" id="shiping_addres"></small>
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
                                                            @if (old('shipping_state', $data['shiping_state']) == $rv)
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
                                                <input type="text" id="shiping_city" required name="shiping_city" placeholder="City" value="{{ old('shiping_city', !empty($data['shiping_city']) ? $data['shiping_city']: '') }}" class="form-control">
                                                <small class="help-block form-text text-danger" id="shiping_city"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Pin Code</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shiping_pincode" required name="shiping_pincode" placeholder="Pin Code" value="{{ old('shiping_pincode', !empty($data['shiping_pincode']) ? $data['shiping_pincode'] : '') }}" class="form-control">
                                                <small class="help-block form-text text-danger" id="shiping_pincode"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Mobile No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shiping_phone" required name="shiping_phone" value="{{ old('shiping_phone', !empty($data['shiping_phone']) ? $data['shiping_phone']: '') }}" placeholder="Mobile No." class="form-control">
                                                <small class="help-block form-text text-danger" id="shiping_phone"></small>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class="form-control-label required">Email</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="email" id="shiping_email" required name="shipping_email" placeholder="Email" value="{{ old('shiping_email', !empty($data['shiping_email']) ? $data['shiping_email']: '') }}" class="form-control">
                                                <small class="help-block form-text text-danger" id="shiping_email"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="shiping_landline" required name="shiping_landline" value="{{ old('shiping_landline', !empty($data['shiping_landline']) ? $data['shiping_landline'] : '') }}" placeholder="Land-Line No." class="form-control">
                                                <small class="help-block form-text text-danger" id="shiping_landline"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                   
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Order Summary</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <table id="tblsummary" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Part No.</th>
                                            <th>Description</th>
                                            <th >Qty</th>
                                            <th>Sent Qty</th>
                                            <th>Balance Qty</th>
                                            <th>Unit Price [<span id="currencysymbol">INR</span>]</th>
                                            <th>Discount (in %)</th>
                                            <th>IGST Rate (in %)</th>
                                            <th>Net Price</th>
                                            <th>Total</th>
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
                            <div class="row form-group">
                            </div>
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Preferred Courier</label>
                                <select id="courier" required name="courier" class="form-control">
                                    @if(!empty($courier))
                                            <option value="">Select Courier</option>
                                        @foreach($courier as $id=>$cur)
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
                                <textarea id="ext_note" required name="ext_note"placeholder="Write here . . . !" class="form-control"></textarea>
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
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('#order_date').datepicker({
        leftArrow: '&laquo;',
        rightArrow: '&raquo;',
        daysOfWeekHighlighted: "7,0",
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom',
        endDate:'today',
    });

    var flg_same_as_bill_add  = {!! json_encode(!empty($data['flag_same_as']) ? $data['flag_same_as'] : '') !!};
    if(flg_same_as_bill_add == 1){
        $('#shippingchk').prop('checked', true);
        $('#flg_same_as_bill_add').val(1);
    }else{
        $('#shippingchk').prop('checked', false);
        $('#flg_same_as_bill_add').val(0);
    }

    $('#shippingchk').on('click', function(){
        if($("#shippingchk").prop('checked') == true){
            var all_state = {!! json_encode($flip_indian_all_states) !!}; 
            var address = $('#billing_addres').val();
            $('#shiping_addres').val(address);
            $('#flg_same_as_bill_add').val(1);
            var state = $('#billing_state').val();
            $('#shipping_state').val(all_state[state]);

            var pincode = $('#billing_pincode').val();
            $('#shiping_pincode').val(pincode);

            var city = $('#billing_city').val();
            $('#shiping_city').val(city);

            var mobile = $('#billing_phone').val();
            $('#shiping_phone').val(mobile);

            var email = $('#billing_email').val();
            $('#shiping_email').val(email);

            var land_line = $('#billing_landline').val();
            $('#shiping_landline').val(land_line);
        }else{
            // Clear shiping address
            $('#shippingchk').prop('checked', false);
            $('#flg_same_as_bill_add').val(0);
            $('#shiping_addres').val('');
            $('#shipping_state').val('');
            $('#shiping_pincode').val('');
            $('#shiping_city').val('');
            $('#shiping_phone').val('');
            $('#shiping_email').val('');
            $('#shiping_landline').val('');
        }
    });

    var order_details = {!! json_encode($order_details) !!};
        var html = '';
        $.each(order_details, function (key, products) {
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
            html = html+'<tr id="prod_row_'+products.in_product_id+'" class="prod_row_deatails"><input type="hidden" style="width: 100px;" value="'+products.st_maker+'" name="prod_maker" class="prod_maker"><td class="prod_part_No"><input type="checkbox" value="" id="select_prod" checked name="select_prod"></td><td class="prod_part_No">'+products.st_part_no+'</td><td  style="word-break:break-all;" class="prod_desc td-limit">'+products.st_product_desc+'</td><td  style="word-break:break-all;" class="prod_hsn">'+hsn+'</td><td style="word-break:break-all;"  class="prod_qty"><input style="width: 35px; box-shadow: 2px 5px #888888;" placeholder="Qty" type="text" class="quentity_changed prodqty_'+products.in_product_id+'" id="'+products.in_product_id+'" value="'+products.in_pro_qty+'" onchange="quentity_changed(this);"></td><td style="word-break:break-all;" >'+products.in_pro_qty+'</td><td style="word-break:break-all;" ><div class="tooltips"><input style="width: 75px; box-shadow: 2px 5px #888888;" type="text" placeholder="Price" class="prod_unit_price prod_unit_price_'+products.in_product_id+'" value="'+products.fl_pro_unitprice+'" onchange="prod_price_changed(this,'+products.in_product_id+');"></div></td><td style="word-break:break-all;" ><input type="text" style="width: 55px; box-shadow: 2px 5px #888888;" placeholder="Disc %" class="prod_disc_price prod_disc_price_'+products.in_product_id+'" value="'+products.fl_discount+'" onchange="prod_discount_price_changed(this,'+products.in_product_id+');"></td><td style="width: 75px; text-align: left;word-break:break-all;"  class="prod_net_price prod_netprice_'+products.in_product_id+'">'+products.fl_net_price+'</td><td style="text-align: left;word-break:break-all;width: 60px;" class=" "><input style="width: 45px; box-shadow: 2px 5px #888888;" type="text" placeholder="IGST" class="prod_igst_rate prod_igst_rate_'+igst+'" id="'+products.in_product_id+'" value="'+igst+'" onchange="igsttaxrate_changed(this);"></td><td style="text-align: left;word-break:break-all;width: 75px;" class="prod_row_total prod_row_total_'+products.in_product_id+'">'+products.fl_row_total+' &ensp;</td><td class="prod_deli_period prod_deli_period_'+products.in_product_id+'" style="word-break:break-all;"><textarea type="text" style="word-break:break-all; width:75px; box-shadow: 2px 5px #888888; background:#FFFFE3;" placeholder="Write . . . !" name="prod_deli_period" id="prod_deli_period_'+products.in_product_id+'" value=""></textarea></td><td><div class="row"><div class="form-group col-2"><a href="javascript:void(0);" title="Add Comments" class="addCF_'+products.in_product_id+' btn" style="float:left;padding:0" onClick=addCF('+products.in_product_id+'); data-id='+products.in_product_id+'><span class="pull-left"> </span>  <i class="fa fa-comment"></i></a></div><div class="form-group col-2"><a href="javascript:void(0);" title="Delete Product" onClick=delete_row('+products.in_product_id+'); class="btn" style="float:left;padding:0"><span class="pull-left"> </span>  <i class="fa fa-trash text-danger"></i></a></div></td></div>\n\</tr>';
        });
        $( html ).insertBefore( "#tblsummary .tr-subtotal" );

    // if (order_details != null && order_details != ''){
    //     var sel_prods_details = [];
    //     sel_prods_details.length = 0;
    //     $(".prod_row_deatails").each(function(key,obj){
    //         var prod_part_No = $(this).find('.prod_part_No').text();
    //         prod_part_No = prod_part_No.replace('#', '').trim();
    //         var prod_id = parseInt($(this).attr("id").replace(/[^\d]/g, ''), 10);
    //         var prod_desc = $(this).find('.prod_desc').text().trim();
    //         var in_balance_pro_qty = $('.prodqty_'+prod_id).val().trim();
    //         var prod_request_qty = $(".prod_request_qty_"+prod_id).val().trim();
    //         var prod_sent_qty = $('.product_sent_quentity_'+prod_id).val().trim();
    //         var prod_unit_price = $(this).find('.prod_unit_price').val().trim();
    //         var prod_disc_price = $(this).find('.prod_disc_price').val().trim();
    //         var prod_deli_period = "";
            
    //         var prod_net_price = $(this).find('.prod_net_price').text().trim();
    //         var prod_row_total = $(this).find('.prod_row_total').text().trim();
    //         var final_subtotal   = $('.final_subtotal').text().trim();
    //         var prod_grand_total  = $('#prod_grand_total').text().trim();
    //         var ischcked = $(".partial-order-chbox-"+prod_id).is(':checked');
        
    //     if(ischcked){
    //         sel_prods_details.push({
    //             'in_ord_detail_id': prod_id, 
    //             'st_part_no':  prod_part_No,
    //             'in_ord_pro_desc':  prod_desc,
    //             'st_maker':  "",
    //             'in_partlyord_pro_qty' : prod_request_qty,
    //             'in_sent_pro_qty':  prod_sent_qty,
    //             'in_balance_pro_qty' : in_balance_pro_qty,
    //             'flt_ord_pro_price':  prod_unit_price,
    //             'flt_ord_pro_disct':  prod_disc_price,
    //             'in_ord_delivery_period':  prod_deli_period,
    //             'flt_ord_pro_net_price':  prod_net_price,
    //             'flt_ord_pro_row_total':  prod_row_total
    //         });
    //     }
    //     $("#hid_order_sub_total").val(final_subtotal);
    //     $("#order_grand_total").val(prod_grand_total);
            
    // });


    
    // }
        

});
</script>
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

@section('orderUpdate')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Updates</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-success">Order generated Successfully. </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
@endsection



<!-- order Preview-->
@section('order-preview-model')
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
        <button type="button" class="btn btn-primary add-order">Generate Order</button>&nbsp;&nbsp;
    </div>
</div>
@endsection
<!-- End Quatation Preview-->