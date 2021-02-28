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
                                <input type="text" id="st_part_No" required name="st_part_No"placeholder="Quatation Prepared By" class="form-control">
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
                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Lead From</label>
                                <input type="text" id="stn_hsn_no" required name="stn_hsn_no" placeholder="Lead From" class="form-control">
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
                            
                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Notify Group</label>
                                <select id="principal_id" required name="principal_id" class="form-control">
                                    <option value="">Select Notify Group</option>
                                    @if(!empty($notify))
                                        @foreach($notify as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Notification are not available.</p>
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
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Customer Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="vat" class=" form-control-label required">Select Company</label>
                                <select id="principal_id" required name="principal_id" class="form-control">
                                    <option value="">Select Company</option>
                                    @if(!empty($company))
                                        @foreach($company as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Company are not available.</p>
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
                                <label for="company" class="form-control-label required">Enq Ref. No. </label>
                                    <input type="text" id="enq_date" required name="enq_date" placeholder="Enq Ref. No." class="form-control">
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
                                <label for="company" class="form-control-label required">Date </label>
                                <input type="text" name="datepicker" id="datepicker" class="form-control" placeholder="DD-MM-YYY" readonly />
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
                                <label for="company" class="form-control-label required">Add Customer</label>
                                    <span id="datepicker" class="form-control btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="zmdi zmdi-plus"></i> Add Customer</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Company Name </label>
                                    <input type="text" id="enq_date" required name="enq_date" placeholder="Company Name" class="form-control">
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
                                <label for="company" class="form-control-label required">Contact Person</label>
                                    <input type="text" id="enq_date" required name="enq_date" placeholder="Contact Person" class="form-control">
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
                                <label for="company" class="form-control-label required">Owner</label>
                                    <input type="text" id="enq_date" required name="enq_date" placeholder="Owner" class="form-control">
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
                                                    <textarea type="text" id="text-input" name="text-input" placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">State</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="State" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Pin Code</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="Pin Code" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Mobile No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="Mobile No." class="form-control">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email-input" name="email-input" placeholder="Email" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="Land-Line No." class="form-control">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Shipping </strong> Details
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label required">Address</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea type="text" id="text-input" name="text-input" placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">State</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="State" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Pin Code</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="Pin Code" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Mobile No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="Mobile No." class="form-control">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email-input" name="email-input" placeholder="Email" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label required">Land-Line No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="email-input" name="email-input" placeholder="Land-Line No." class="form-control">
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
    
<!-- end add record -->
@endsection