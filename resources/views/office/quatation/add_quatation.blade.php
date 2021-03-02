@extends('theme.layout.base_layout')
@section('title', 'Add Quatation')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
datepicker,
.table-condensed {
  width: 450px;
  height:250px;
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
                <h5 class="modal-title" id="largeModalLabel">Lead & Group</h5>
            </div>
            <form action="{{route('store_product')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row form-group">
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Quatation Prepared By </label>
                                <input type="text" id="st_part_No" required name="quatation_prepare" id="quatation_prepare" placeholder="Quatation Prepared By" class="form-control">
                                @if ($errors->has('quatation_prepare'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('quatation_prepare') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Lead From</label>
                                <input type="text" required name="lead_from" id="lead_from" placeholder="Lead From" class="form-control">
                                @if ($errors->has('lead_from'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('lead_from') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Notify Group</label>
                                <select id="notify" required name="notify" class="form-control">
                                    <option value="">Select Notify Group</option>
                                    @if(!empty($notify))
                                        @foreach($notify as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Notification are not available.</p>
                                    @endif
                                </select>
                                @if ($errors->has('notify'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('notify') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                <select id="select_company" required name="select_company" class="form-control">
                                    <option value="">Select Company</option>
                                    @if(!empty($company))
                                        @foreach($company as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Company are not available.</p>
                                    @endif
                                </select>
                                @if ($errors->has('select_company'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('select_company') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Enq Ref. No. </label>
                                    <input type="text" id="enq_ref" required name="enq_ref" placeholder="Enq Ref. No." class="form-control">
                                @if ($errors->has('enq_ref'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('enq_ref') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Date </label>
                                <input type="text" name="datepicker" id="datepicker" class="form-control" placeholder="DD-MM-YYY" readonly />
                                @if ($errors->has('datepicker'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('datepicker') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Add Customer</label>
                                    <span id="datepicker" class="form-control btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="zmdi zmdi-plus"></i> Add Customer</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Company Name </label>
                                    <input type="text" id="company_name" required name="company_name" placeholder="Company Name" class="form-control">
                                @if ($errors->has('company_name'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('company_name') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Contact Person</label>
                                    <input type="text" id="c_person_name" required name="c_person_name" placeholder="Contact Person" class="form-control">
                                @if ($errors->has('c_person_name'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('c_person_name') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-3" id="owner">
                                @if ($errors->has('owner'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('owner') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label required">Address</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea type="text" id="b_address" name="b_address" placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class="form-control-label required">State</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="b_state" name="b_state" placeholder="State" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">City</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="b_city" name="b_city" placeholder="City" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Pin Code</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="b_pin_code" name="b_pin_code" placeholder="Pin Code" class="form-control">
                                                </div>
                                            </div>

                                            

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class="form-control-label required">Mobile No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="b_mobile" name="b_mobile" placeholder="Mobile No." class="form-control">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class="form-control-label required">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="b_email" name="b_email" placeholder="Email" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="b_land_line" name="b_land_line" placeholder="Land-Line No." class="form-control">
                                                </div>
                                            </div>
                                        </form>
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
                                                <input type="checkbox" id="same_as" name="shiping_address"> <strong>Same as</strong>  Billing 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label required">Address</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea type="text" id="s_address" name="s_address" placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class="form-control-label required">State</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="s_state" name="s_state" placeholder="State" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">City</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="s_city" name="s_city" placeholder="City" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Pin Code</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="s_pin_code" name="s_pin_code" placeholder="Pin Code" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class="form-control-label required">Mobile No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="s_mobile" name="s_mobile" placeholder="Mobile No." class="form-control">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class="form-control-label required">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="s_email" name="s_email" placeholder="Email" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="s_land_line" name="s_land_line" placeholder="Land-Line No." class="form-control">
                                                </div>
                                            </div>
                                        </form>
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
                                <input type="text" id="st_part_No" required name="st_part_No"placeholder="Type part no. / Description name" class="form-control">
                                @if ($errors->has('st_part_No'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('st_part_No') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Qty</label>
                                <input type="text" id="stn_hsn_no" required name="stn_hsn_no" placeholder="Qty" value="1" class="form-control">
                                @if ($errors->has('stn_hsn_no'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('stn_hsn_no') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-2">
                                <label for="vat" class=" form-control-label required">Add Product</label>
                                <span href="" id="stn_hsn_no" required name="stn_hsn_no" placeholder="Qty" value="1" class="form-control btn btn-primary"> Add Product</span>
                                @if ($errors->has('stn_hsn_no'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('stn_hsn_no') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-2">
                                <label for="vat" class=" form-control-label required">Add New Product</label>
                                <a href="{{route('add_product')}}" style="background:gree" id="stn_hsn_no" required name="stn_hsn_no" placeholder="Qty" value="1" class="form-control btn btn-primary"><i class="zmdi zmdi-plus"></i> Add New Product</a>
                                @if ($errors->has('stn_hsn_no'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('stn_hsn_no') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-2">
                                <label for="vat" class=" form-control-label required">Product Filter</label>
                                <a href="{{route('show_product')}}" style="background:gree" id="stn_hsn_no" required name="stn_hsn_no" placeholder="Qty" value="1" class="form-control btn btn-primary">Product Filter</a>
                                @if ($errors->has('stn_hsn_no'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('stn_hsn_no') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                <select id="principal_id" required name="principal_id" class="form-control">
                                    @if(!empty($currency))
                                        @foreach($currency as $id=>$cur)
                                            <option value="{{$id}}">{{$cur}}</option>
                                        @endforeach
                                    @else
                                        <p>Currrency are not available.</p>
                                    @endif
                                </select>
                                @if ($errors->has('principal_id'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('principal_id') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Payment Term</label>
                                <select id="principal_id" required name="principal_id" class="form-control">
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
                                <textarea id="st_part_No" required name="st_part_No"placeholder="Write here . . . !" class="form-control"></textarea>
                                @if ($errors->has('st_part_No'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('st_part_No') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <input type="hidden" name="hid_quotation_sub_total" id="hid_quotation_sub_total" value="0">
                            <input type="hidden" name="order_grand_total" id="order_grand_total" value="0">
                            <input type="hidden" name="order_nego_amount" id="order_nego_amount" value="0">
                            <input type="hidden" name="hid_order_prod_details[]" id="hid_order_prod_details" class="m-wrap span4" value="0">
                            <input type="hidden" name="hid_selprod" id="hid_selprod" class="m-wrap span4" value=""/>
                            <input type="hidden" name="hid_tax_amt" id="hid_tax_amt" value=""/>
                            <input type="hidden" name="bill_add_id" id="bill_add_id" value="<?php echo $this->uri->segment(3);?>"/>
                            <input type="hidden" name="hid_appliedCurrency" id="hid_appliedCurrency" value="rupees">
                            <input type="hidden" id="is_submit_quotation" value="0">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-15">
                                    <table id="tblsummary" class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Part No.</th>
                                                <th>Description</th>
                                                <th>HSN Code</th>
                                                <th >Qty</th>
                                                <th >Instock</th>
                                                <th >Price</th>
                                                <th >Disc %</th>
                                                <th>Net Price</th>
                                                <th>IGST %</th>
                                                <th>Total</th>
                                                <th>Notes</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>part346456451233</td>
                                                <td>KETEYEYEYY</td>
                                                <td>4</td>
                                                <td>45</td>
                                                <td>878</td>
                                                <td>5</td>
                                                <td>58</td>
                                                <td>555</td>
                                                <td>900</td>
                                                <td>34</td>
                                                <td>12</td>
                                                <td>5656</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
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
$.fn.datepicker.defaults.format = "mm-dd-yyyy";
$('#datepicker').datepicker({
    leftArrow: '&laquo;',
    rightArrow: '&raquo;',
    daysOfWeekHighlighted: "7,0",
    autoclose: true,
    todayHighlight: true,
    orientation: 'bottom'
    // endDate:'today',
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
<script>
$(document).ready(function(){
        $('#select_company').on('change', function(){
            // Clear shiping address
            $('#same_as').prop('checked', false);
            $('#s_address').val('');
            $('#s_state').val('');
            $('#s_pin_code').val('');
            $('#s_city').val('');
            $('#s_mobile').val('');
            $('#s_email').val('');
            $('#s_land_line').val('');

            var c_id = $('#select_company').val();
            var product_field = {!! json_encode($cust_details) !!};
            
            // Customer Details
            if(product_field['company_name'][c_id] != 'undefined' && product_field['company_name'][c_id] != ''){
                var company_name = product_field['company_name'][c_id];
                $('#company_name').val(company_name);
            }

            if(product_field['c_person_name'][c_id] != 'undefined' && product_field['c_person_name'][c_id] != ''){
                var c_person_name = product_field['c_person_name'][c_id];
                $('#c_person_name').val(c_person_name);
            }

            // Billing Address

            if(product_field['address'][c_id] != 'undefined' && product_field['address'][c_id] != ''){
                var address = product_field['address'][c_id];
                $('#b_address').val(address);
            }
            if(product_field['state'][c_id] != 'undefined' && product_field['state'][c_id] != ''){
                var state = product_field['state'][c_id];
                console.log(state);
                $('#b_state').val(state);
            }
            if(product_field['pincode'][c_id] != 'undefined' && product_field['pincode'][c_id] != ''){
                var pincode = product_field['pincode'][c_id];
                $('#b_pin_code').val(pincode);
            }
            if(product_field['city'][c_id] != 'undefined' && product_field['city'][c_id] != ''){
                var city = product_field['city'][c_id];
                $('#b_city').val(city);
            }
            if(product_field['mobile'][c_id] != 'undefined' && product_field['mobile'][c_id] != ''){
                var mobile = product_field['mobile'][c_id];
                $('#b_mobile').val(mobile);
            }
            if(product_field['email'][c_id] != 'undefined' && product_field['email'][c_id] != ''){
                var email = product_field['email'][c_id];
                $('#b_email').val(email);
            }
            if(product_field['land_line'][c_id] != 'undefined' && product_field['land_line'][c_id] != ''){
                var land_line = product_field['land_line'][c_id];
                $('#b_land_line').val(land_line);
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
                var sel = '<label for="vat" class=" form-control-label required" id="own_label">Owner</label><select name="owner" required class="form-control">'+option+'</select>';
                $('div #owner').html(sel);
            }else{
                
            }
        });
        var owner_field = {!! json_encode($owner) !!};
        var option = '<option value="" > Select Owner</option>';
        $.each(owner_field, function (key, field) {
           option = option + '<option value="'+ key +'">'+ field +'</option>';
        });
        var sel = '<label for="vat" class=" form-control-label required" id="own_label">Owner</label><select name="owner" required class="form-control">'+option+'</select>';
        $('div #owner').html(sel);
    });

    $('#same_as').on('click', function(){
        if($("#same_as").prop('checked') == true){
            var address = $('#b_address').val();
            $('#s_address').val(address);

            var state = $('#b_state').val();
            $('#s_state').val(state);

            var pincode = $('#b_pin_code').val();
            $('#s_pin_code').val(pincode);

            var city = $('#b_city').val();
            $('#s_city').val(city);

            var mobile = $('#b_mobile').val();
            $('#s_mobile').val(mobile);

            var email = $('#b_email').val();
            $('#s_email').val(email);

            var land_line = $('#b_land_line').val();
            $('#s_land_line').val(land_line);
        }else{
            // Clear shiping address
            $('#same_as').prop('checked', false);
            $('#s_address').val('');
            $('#s_state').val('');
            $('#s_pin_code').val('');
            $('#s_city').val('');
            $('#s_mobile').val('');
            $('#s_email').val('');
            $('#s_land_line').val('');

        }
    });

    $(window).load(function(){
            $('#editquotation_msg_err').modal('show');
    });
    var admin_rights = '<?php echo $this->session->userdata('admin_rights');?>';
    var sel_prods_details = [];

    function get_cust_add_details(cust_id){
        var filepath = '<?php echo base_url();?>quotation/ajax_get_cust_address_details';
        $.ajax({
            url:filepath,
            type:'POST',
            async:false,
            dataType: "json",
            data: {'cust_id':cust_id.value},		
            success: function(res) {
                if(res.length != 0){
                    $('#auto_pop_cust_name').val(res.st_con_person1);
                    $('#auto_pop_addr').val(res.st_com_address);
                    $('#auto_pop_state').val(res.st_cust_state);
                    $('#auto_pop_city').val(res.st_cust_city);
                    $('#auto_pop_pincod').val(res.in_pincode);
                    $('#auto_pop_phone').val(res.st_con_person1_mobile);
                    $('#auto_pop_email').val(res.st_con_person1_email);
                    $('#auto_pop_landline').val(res.st_cust_mobile);
                    $('.auto_pop_company').html(res.st_com_name);
                    $('select[name^="select_owner"] option[value='+res.owner_id+']').attr("selected","selected");
                }else{
                    $('.auto_pop_cust_name').html('&nbsp;&nbsp;');
                    $('#auto_pop_addr').val('');
                    $('#auto_pop_state').val('');
                    $('#auto_pop_city').val('');
                    $('#auto_pop_pincod').val('');
                    $('#auto_pop_phone').val('');
                    $('#auto_pop_email').val('');
                    $('#auto_pop_landline').val('');
                    $('.auto_pop_company').html('&nbsp;&nbsp;');
                    $("#shippingchk").attr("checked", false);
                    $("#shippingchk").val(0);
                    $("#shipping_addr").val('');
                    $("#shipping_telephone").val('');
                    $("#shipping_email").val('');
                    var filepath = '<?php echo base_url();?>quotation/ajax_get_shiping_state_and_city_dropdown';
                    $.ajax({
                        url:filepath,
                        type:'POST',
                        async:false,
                        dataType: 'json',
                        data: {'action': 'get_state_city_dropdown'},		
                        success: function(res) {
                            $("#shippingchk-state-n-city").html(res.shiping_address);
                        }
                    });
                }
            }
        });
    }

/*To validate first product...*/
function checkfirstprod(){
	var req = 1;
	var prod_id = $('#order_product').val();
	/*Get product qty from database*/
	prod_qty = get_cust_prods_qty(prod_id);
	if($('#order_product').val() =='' && parseInt($('#prod_qty').val()) == ''){
		alert("Please select product name and quantity");
		req = 0;			
	}else if( $('#order_product').val() !='' && $('#prod_qty').val()=='') {
		alert("Please enter valid product quantity.");
		req = 0;		
	}else if( ($('#order_product').val() !='' && parseInt($('#prod_qty').val())=='')) {
		alert("Please enter valid product quantity.");
		req = 0;		
	}else if( ($('#order_product').val() !='' && parseInt($('#prod_qty').val()) <=0)) {
		alert("Please enter valid product quantity");
		req = 0;		
	}else if( ($('#order_product').val() =='' && parseInt($('#prod_qty').val())!='') ) {
		alert("Please select product.")
		req = 0;		
	}else if( $('#prod_qty').val()!='' && ($.isNumeric($('#prod_qty').val()) == false || (parseInt($('#prod_qty').val()) <= 0 || $('#prod_qty').val().indexOf('.') !== -1) )){
		alert("Please enter valid product quantity");
		req = 0;			
	}else{
		req = 1;	
	}
	return req;
}

function get_cust_prods_qty(prod_id){
	$("#prod-loadimg").removeClass('dnone');
	var result = 0;		
	var filepath = '<?php echo base_url();?>quotation/ajax_get_cust_prods_qty';
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
		alert("Pleas enter a valid quantity.");
	}else{
		$(".prod_netprice_"+prod_id).html(prod_net_price);
		$(".prod_row_total_"+prod_id).html(prod_row_total.toFixed(2));
		get_prod_row_sub_total();
		/* Calculate all data on changing any one amount */
		alter_all_data();
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
	/* Calculate all data on changing any one amount */
	alter_all_data();

	
}

function alter_all_data(){
	/* Calculate net sub total amount */
	get_prod_row_sub_total();
    /* change tax value after row delete if applicable */
	var tax_perc_val = $('select[name=prod_tax]').val().split('_');
	var final_subtotal = $(".final_subtotal").text();
	var frieght_pack_charges = $("input[name='frieght_pack_charges']").val();
	if(frieght_pack_charges == ""){
		frieght_pack_charges = 0.00;
	}
	var tax_on_total = parseFloat(parseFloat(final_subtotal) + parseFloat(frieght_pack_charges)).toFixed(2);
	var total_tax_amt = parseFloat((parseFloat(tax_perc_val[1])*parseFloat(tax_on_total))/100).toFixed(2);
	
	if(tax_perc_val != ""){
		$("#vat_tax").html(total_tax_amt);
		$("#hid_tax_amt").val(total_tax_amt);
	}else{
		total_tax_amt = 0.00;
		$("#hid_tax_amt").val(0.00);
	}
	/* Calculate total Grand amount */
	calc_prod_grand_total(final_subtotal, total_tax_amt);
	
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
	alter_all_data();
}

function get_bank_detial(obj){
	var bank_id = obj.value;
	if(bank_id != ''){
		var filepath = '<?php echo base_url();?>quotation/ajax_get_bank_details';
		$.ajax({
			url:filepath,
			type:'POST',
			async:false,
			dataType: 'json',
			data: {'bank_id': bank_id},		
			success: function(res) {
				$(".bank-name").html(res.st_bank_name);
				$(".bank-branch").html("Branch : "+res.st_bank_branch);
				$(".bank-ifsc-code").html("IFSC Code : "+res.st_bank_IFSC_code);
				$(".bank-acc-no").html("A/c No. "+res.st_bank_acc_no);
			}
		});
	}else{
		$(".bank-name").html("&nbsp;");
		$(".bank-branch").html("&nbsp;");
		$(".bank-ifsc-code").html("&nbsp;");
		$(".bank-acc-no").html("&nbsp;");
		alert("Please select a bank.");
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
        var prod_row_total = parseFloat(prod_row_without_igst_total + parseFloat((prod_row_without_igst_total*prod_igst_rate)/(100)));
    }else{
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

$(function() {
        jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 && 
        phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        }, "Please specify a valid phone number");
        $("#quotation_form").validate({
                rules: {
                    customer_id: "required",
                    shipping_addr: "required",
                    com_name: "required",
                    preparing_by: "required",
                    shipping_state: "required",
                    shipping_city: "required",
                    reference: "required",
                    reference_date: "required",
                    quotation_date:"required",
                    notify_group:"required",
                    select_owner:"required",
                    auto_pop_pincod:{number: true,},
                    shipping_pincod:{
                    number: true,
                },
                auto_pop_phone:{
                    number: true
                },
                shipping_telephone:{
                    number: true
                },
                shipping_email: {
                    required: true,
                    email: true
                },
                auto_pop_email: {
                    required: true,
                    email: true
                },
                
                enq_ref_no: "required",
                payment_turm: "required"
            },
            // Specify the validation error messages
            messages: {
                customer_id: "Please select a customer",
                preparing_by: "Please enter preparing qoutation person name",
                shipping_addr: "Please enter shipping address",
                shipping_state: "Please enter shipping state",
                shipping_city: "Please enter shipping city",
                shipping_pincod: "Please enter Pin Code",
                auto_pop_pincod: "Please enter Pin Code",
                shipping_telephone: "Please enter phone number",
                reference: "Please select a reference",
                reference_date: "Please enter reference date",
                quotation_date: "Please select Quotation Create Date",
                notify_group: "Please select Notification Group",
                select_owner: "Please select Customer Owner",
                shipping_email: "Please enter a valid email address ",
                auto_pop_email: "Please enter a valid email address ",
                enq_ref_no: "Please enter a enq. ref. No. ",
                //bank_details: "Please select a bank",
                payment_turm: "Please select payment turm"
            
            },
            submitHandler: function(form) {
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
                        if($('#comments_'+prod_id).val()){
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
                        quotation_info = {
                                    'st_shiping_add' 	: shipping_addr,
                                    'st_shiping_city' 	: shipping_city,
                                    'st_shiping_state'      : shipping_state,
                                    'st_shiping_pincode'    : shipping_pin_code,
                                    'st_shipping_email'     : shipping_email,
                                    'st_shipping_phone'     : shipping_telephone,
                                    'st_enq_ref_number'     : enq_ref_no,
                                    'dt_ref'                : dt_ref,
                                    'fl_fleight_pack_charg' : fl_fleight_pack_charg,
                                    'st_tax_text' 			: st_tax_text,
                                    'fl_sales_tax_amt' 		: vat_tax,
                                    'bill_add_id' 			: bill_add_id,
                                    'payment_turm'			: payment_turm,
                                    'lead_from'				: lead_from,
                                    'currency'				: currency,
                                    'st_landline'			: auto_pop_landline,
                                    'fl_nego_amt' 			: fl_nego_amt
                        };

                        var auto_pop_phone = $("#auto_pop_phone").val();
                        var auto_pop_company = $(".auto_pop_company").text();
                        var auto_pop_cust_name = $("#auto_pop_cust_name").val();
                        var auto_pop_state = $("#auto_pop_state").val();
                        customer_info = {
                                    'st_com_name' 		: auto_pop_company,
                                    'auto_pop_cust_name'	: auto_pop_cust_name,
                                    'st_cust_mobile'	: auto_pop_phone,
                                    'auto_pop_state'	: auto_pop_state,
                                    'preparing_by' 		: preparing_by
                        };

                        var filepath = '<?php echo base_url();?>quotation/ajax_get_quote_preview';
                        $.ajax({
                            url:filepath,
                            type:'POST',
                            beforeSend: function() {
                                $("body").addClass("loading");
                            },
                            complete: function() {
                                $("body").removeClass("loading");
                            },
                            async:false,
                            dataType: 'json',
                            data: {'sel_prods_details' : sel_prods_details, 'customer_info' : customer_info, 'quotation_info' : quotation_info},		
                            success: function(res) {
                                $("#is_submit_quotation").val('1');
                                $("#privew-quote").html(res.quotation_data);

                            }
                        });
                        $('#quotation-preview-model').modal('show');
                    }else{	
                        form.submit();
                    }
                }else{
                    alert("Minimum one product for quotation is required.");
                    return false;
                }
            }
        });
});

function quotation_submit(){
	$("#tax_text").val($( "#prod_tax option:selected" ).text());
	$("#quotation_form").submit();
}

function quotation_edit(){
	$('#quotation-preview-model').modal('hide');
	$("#is_submit_quotation").val("0");
}

function addCF(parameters){
       var  htmlcommentd = '<tr id="comment_row_'+parameters+'" valign="top"><td colspan="11"><textarea id="comments_'+parameters+'"  class="comments_'+parameters+' form-control" style="background:#FFFFE3;" name="ext_note" id="ext_note" placeholder="Please add any extra comments if any."></textarea></td><td><a href="javascript:void(0);"  onClick=remCF('+parameters+'); class="remCF_'+parameters+'"  data-id='+parameters+'><i class="fa fa-trash-o"></i></a></td></tr>';
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
 
$(document).ready(function(){
	$("#currency").on('focus', function () {
		previous = this.value;
	}).change(function() {
			var pastvalue = previous;
			previous = this.value;
			var currencytxt = $( "#currency option:selected" ).text();
			var currval = $( "#currency option:selected" ).val();                    
		if (!confirm('Are you sure, you want to cahnge currency?')) {
                $("#currencysymbol").text('');
			    $('#currency').val(pastvalue);
			return false;
		} else {
            $("#currencysymbol").text(currencytxt);
        }
	});

	$('html').click(function(e) {                    
	   if(!$(e.target).hasClass('privew-quote-box') )
	   {
		   $("#is_submit_quotation").val("0");                
	   }
	}); 

	$("#shippingchk").change(function() {
		if(this.checked) {
			var customer_id = $( "#customer_id option:selected" ).val();
			if(customer_id != ""){
				$(this).val(1);
				var shipping_addr = $('#auto_pop_addr').val();
				var shipping_state = $('#auto_pop_state').val();
				var shipping_city = $('#auto_pop_city').val();
				var shipping_pin_code = $('#auto_pop_pincod').val();
				var shipping_telephone = $('#auto_pop_phone').val();
				var shipping_email = $('#auto_pop_email').val();
				
				$("#shipping_addr").val(shipping_addr);
				$("#shipping_telephone").val(shipping_telephone);
				$("#shipping_email").val(shipping_email);
				$("#shipping_pincod").val(shipping_pin_code);

				$("#shippingchk-state-n-city").html('<label class="col-md-9 no-padding-left"><input type="text" value="'+shipping_state+'" class="form-control" name="shipping_state" id="shipping_state"></label><label class="col-md-3">  <strong> City : </strong></label><label class="col-md-9 no-padding-left"><input type="text" value="'+shipping_city+'" class="form-control" name="shipping_city" id="shipping_city"></label><label class="col-md-3">  <strong> Pin Code : </strong></label><label class=" col-md-9 no-padding-left"><input type="text" value="'+shipping_pin_code+'" class="form-control" name="shipping_pincod" id="shipping_pincod"></label>');
			}else{
				$("#shippingchk").attr("checked", false);
				$(this).val(0);
				alert("Please select a customer.");
			}
		}else{
			$(this).val(0);
			$("#shipping_addr").val('');
			$("#shipping_telephone").val('');
			$("#shipping_email").val('');
			var filepath = '<?php echo base_url();?>quotation/ajax_get_shiping_state_and_city_dropdown';
			$.ajax({
				url:filepath,
				type:'POST',
				async:false,
				dataType: 'json',
				data: {'action': 'get_state_city_dropdown'},		
				success: function(res) {
					$("#shippingchk-state-n-city").html(res.shiping_address);
				}
			});
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
		var prod_id_exist = 0;
		var str = $('#hid_selprod').val();
		if($('#hid_selprod').val() != ''){
			sel_prods.push( $("#hid_selprod").val() );
		}
		prod_id = $('#order_product').val();	
		var arr = str.split(',');
		
		if($.inArray(prod_id,arr) == -1){
			sel_prods.push(prod_id);
			
		}else 
			prod_id_exist = 1;
		$('#hid_selprod').val(sel_prods);
		
		var products = <?php echo json_encode($product_list); ?>;
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
		
		
		var partNoHtml ='';
		$.each(products,function(k,v){
			if(v.pro_id == prod_id && prod_id_exist == 1){ 
				var prev_prod_qnt = $(".prodqty_"+v.pro_id).val();
				prodqty = parseInt(parseInt(prev_prod_qnt) + parseInt($('#prod_qty').val()));
				prod_igst_rate = v.str_igst_rate;
				prod_price = v.fl_pro_price;
				prod_discount = v.in_pro_disc;
				prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
                hsn = v.stn_hsn_no;
                if(prod_igst_rate != '' && prod_igst_rate != null)
                {
                    prod_row_total = parseFloat(prod_net_price + parseFloat((prod_net_price*prod_igst_rate)/(100)));
                }else{ 
                    prod_igst_rate = 0.00;
                    prod_row_total = parseFloat(prod_net_price*prodqty);
                }
                                   
				
                $(".prodqty_"+v.pro_id).val(prodqty);
                $(".prod_disc_price_"+v.pro_id).val(prod_discount);
                $(".prod_unit_price_"+v.pro_id).html(prod_price);
                $(".prod_igst_rate_"+v.pro_id).html(prod_igst_rate);
                $(".prod_netprice_"+v.pro_id).html(prod_net_price);
                qty_change(v.pro_id, prodqty, prod_net_price, prod_row_total);
				
			}else if(v.pro_id == prod_id && prod_id_exist == 0){       
				call_sub_total = true;
				prodqty = $('#prod_qty').val();
				prod_part_No = v.st_part_No;
				cat_name = v.st_cat_name;
                hsn = v.stn_hsn_no;
				prod_price = v.fl_pro_price;
				prod_desc = v.st_pro_desc;
				prod_igst_rate = v.str_igst_rate;
				prod_maker = v.st_pro_maker;
				prod_discount = v.in_pro_disc;
				
				prod_net_price = parseFloat(prod_price - parseFloat((prod_price*prod_discount)/(100)));
                var prod_row_without_igst_total = parseFloat(prod_net_price*prodqty);
                if(prod_igst_rate != '' && prod_igst_rate != null){
                    prod_row_total = parseFloat(prod_row_without_igst_total + parseFloat((prod_row_without_igst_total*prod_igst_rate)/(100)));
                        
                }else{
                    prod_igst_rate = 0.00;
                    prod_row_total = parseFloat(prod_net_price*prodqty);
                }
				prod_qty_left = parseInt(v.in_pro_qty) - parseInt(prodqty);
				
				if(admin_rights == '1'){
					partNoHtml = '<input type="text" style="width: 100px;" value="'+prod_part_No+'" name="prod_part_No" class="prod_part_No">';
					var classs = '';
				}else{
					partNoHtml = prod_part_No;
					var classs = 'prod_part_No';
				}
				html = '<tr id="prod_row_'+v.pro_id+'" class="prod_row_deatails"><input type="hidden" style="width: 100px;" value="'+prod_maker+'" name="prod_maker" class="prod_maker"><td class="'+classs+'">'+partNoHtml+'</td><td  style="word-break:break-all;" class="prod_desc">'+prod_desc+'</td><td  style="word-break:break-all;" class="prod_hsn">'+hsn+'</td><td style="word-break:break-all;"  class="prod_qty"><input style="width: 35px;" type="text" class="quentity_changed prodqty_'+v.pro_id+'" id="'+v.pro_id+'" value="'+prodqty+'" onchange="quentity_changed(this);"></td><td style="word-break:break-all;" >'+v.in_pro_qty+'</td><td style="word-break:break-all;" ><div class="tooltips"><input style="width: 75px;" type="text" class="prod_unit_price prod_unit_price_'+v.pro_id+'" value="'+prod_price+'" onchange="prod_price_changed(this,'+v.pro_id+');"><span class="tooltiptext">'+ formatDate(v.dt_price_update) +'</span></div></td><td style="word-break:break-all;" ><input type="text" style="width: 55px;" class="prod_disc_price prod_disc_price_'+v.pro_id+'" value="'+prod_discount+'" onchange="prod_discount_price_changed(this,'+v.pro_id+');"></td><td style="width: 75px; text-align: left;word-break:break-all;"  class="prod_net_price prod_netprice_'+v.pro_id+'">'+prod_net_price+'</td><td style="text-align: left;word-break:break-all;width: 60px;" class=" "><input style="width: 45px;" type="text" class="prod_igst_rate prod_igst_rate_'+v.pro_id+'" id="'+v.pro_id+'" value="'+prod_igst_rate+'" onchange="igsttaxrate_changed(this);"></td><td style="text-align: left;word-break:break-all;width: 75px;" class="prod_row_total prod_row_total_'+v.pro_id+'">'+prod_row_total+'</td><td class="prod_deli_period prod_deli_period_'+v.pro_id+'" style="word-break:break-all;"><input type="text" style="word-break:break-all; width:75px"  name="prod_deli_period" id="prod_deli_period_'+v.pro_id+'" value=""></td><td><a href="javascript:void(0);" onClick=delete_row('+v.pro_id+'); class="btn" style="float:left;padding:0"><span class="pull-left"> </span>  <i class="fa fa-times-circle"></i></a><a href="javascript:void(0);"  class="addCF_'+v.pro_id+' btn" style="float:left;padding:0" onClick=addCF('+v.pro_id+'); data-id='+v.pro_id+'><span class="pull-left"> </span>  <i class="fa fa-comment"></i></a></td>\n\</tr>';
			}
		});
		
		$( html ).insertBefore( "#tblsummary .tr-subtotal" );
		if(call_sub_total == true){
			get_prod_row_sub_total();
			alter_all_data();
		}
	}
});

function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;
     return [day, month, year].join('-');
}

$(".add-quotation").click(function(){ 
	 $(".prod_row_deatails").each(function(key,obj){
        var prod_comments='';
        var prod_part_No = $(this).find('.prod_part_No').text();
        prod_part_No = prod_part_No.replace('#', '').trim();
        var prod_id = parseInt($(this).attr("id").replace(/[^\d]/g, ''), 10);
        var prod_desc = $(this).find('.prod_desc').text().trim();
        var prod_maker = $(this).find('.prod_maker').val().trim();
        var prodqty            = $('.prodqty_'+prod_id).val().trim();
        var prod_unit_price 	= $(this).find('.prod_unit_price').val().trim();
        var prod_disc_price 	= $(this).find('.prod_disc_price').val().trim();
        var prod_deli_period 	= $(this).find('.prod_deli_period').val().trim();
        var prod_net_price 	= $(this).find('.prod_net_price').text().trim();
        var prod_igst_rate 	= $(this).find('.prod_igst_rate ').val().trim();
        var prod_row_total 	= $(this).find('.prod_row_total').text().trim();
        var prod_hsn   	= $(this).find('.prod_hsn').text().trim();
        prod_comments          = $('#comments_'+prod_id).val().trim();
		var customer_id = $( "#customer_id option:selected" ).val();
		 sel_prods_details.push({
					'in_cust_id': 		customer_id,
					'in_product_id': 	prod_id, 
					'st_part_no':  		prod_part_No,
					'st_product_desc':      prod_desc,
					'st_maker':  		prod_maker,
					'in_pro_qty':  		prodqty,
					'fl_pro_unitprice':     prod_unit_price,
					'fl_discount':  	prod_disc_price,
					'in_pro_deli_period':   prod_deli_period,
					'fl_net_price':  	prod_net_price,
                    'in_igst_rate':         prod_igst_rate,
					'fl_row_total':  	prod_row_total,
					'stn_hsn_no':  		prod_hsn,
                    'prod_comments':  	prod_comments,
		});
	});

	$("#hid_order_prod_details").val(JSON.stringify(sel_prods_details));
	$("#hid_quotation_sub_total").val($(".final_subtotal").text());
	if(sel_prods_details.length > 0){
		$( "#quotation_form" ).submit();
	}else{
		alert("Minimum one product for quotation is required.");
	}		
});

$("input[name='frieght_pack_charges']").blur(function(){
		var frieght_pack_charges = $("input[name='frieght_pack_charges']").val();
		var frieght_include_tax = '';
		var frieght_pack_charges_include_tax = '';
		if($.isNumeric(frieght_pack_charges) == false){
			alert("Please enter a valid number.");
		}else{
			var prod_grand_total = $("#prod_grand_total").text();
			frieght_include_tax = parseFloat((parseFloat(18)*parseFloat(frieght_pack_charges))/100).toFixed(2); //frieght_pack_charges;
			/*Add tax 18% in frieght charges */
			frieght_pack_charges_include_tax = parseFloat(parseFloat(frieght_include_tax) + parseFloat(frieght_pack_charges));
			var prod_final_grand_total = parseFloat(parseFloat(prod_grand_total) + parseFloat(frieght_pack_charges_include_tax));
			$("#frieght_pack_charges").val(frieght_pack_charges_include_tax);
			$("#prod_grand_total").html(prod_final_grand_total);
			$("#order_grand_total").val(prod_final_grand_total);
			$("#order_nego_amount").val(prod_final_grand_total);
		}
		/* calculate Tax */
		alter_all_data();
});

});

	$(function(){
	  $("#product_search").autocomplete({ 
		source: "<?php echo base_url();?>product/Ajax_Auto_Complete" // path to the get_birds method
	  });

		$("#product_search").blur(function(){
			var prod_name = $("#product_search").val();
			var filepath = '<?php echo base_url();?>product/get_product_id_by_name';
			$.ajax({
				url:filepath,
				type:'POST',
				async:false,
				dataType: 'text',
				data: {'prod_name': prod_name},		
				success: function(res) {
					$("#order_product").val(res);
				}
			});
		});
	});
</script>
<!-- end add record -->
@endsection