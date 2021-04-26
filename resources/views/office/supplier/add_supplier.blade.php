@extends('theme.layout.base_layout')
@section('title', 'Add Supplier')
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
.section__content--p30{
    padding: 0px 0px;
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
                <h5 class="modal-title" id="largeModalLabel">Add Supplier</h5>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Principal & Part No.</h5>
            </div>
            <form action="" name="quotation_form" id="quotation_form"  role="form">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Date Created </label>
                                <input type="text" name="reference_date" required id="datepicker" class="form-control" placeholder="DD-MM-YYY" />
                                <small class="help-block form-text text-danger" id="error_dt_ref"></small>
                            </div>
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Part No.</label>
                                <input type="text" id="product_search" required name="product_search"placeholder="Part No." class="form-control">
                                <small class="help-block form-text text-danger" id="error_product_search"></small>
                                <input type="hidden" id="order_product" value="">
                            </div>
                            <input type="hidden" name="_token"  id="token" value="{{ csrf_token() }}">
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Principal </label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Principal" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Desciptions</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Descriptions" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>
                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Source</label>
                                <select id="payment_turm" name="payment_turm" class="form-control">
                                    @if(!empty($source))
                                        <option value="">Select Source</option>
                                        @foreach($source as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    @else
                                        <p>Source are not available.</p>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <label for="vat" class=" form-control-label required">Currrency</label>
                                <select id="currency" required name="currency" class="form-control">
                                    @if(!empty($currency))
                                        <option value="">Select Currency</option>
                                        @foreach($currency as $id=>$cur)
                                            <option value="{{$id}}">{{$cur}}</option>
                                        @endforeach
                                    @else
                                        <p>Currrency are not available.</p>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Rate & Factor</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Rate FC</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Rate FC" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Factor FC</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Factor FC" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Total Cost</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="TOtal Cost" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Discount</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Discount" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Net Price</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Net Price" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Profit</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Descriptions" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
                            </div>

                            <div class="form-group col-4">
                                <label for="company" class="form-control-label required">Customer Price</label>
                                <input type="text" id="enq_ref_no" required  name="enq_ref_no" placeholder="Descriptions" class="form-control">
                                <small class="help-block form-text text-danger" id="error_st_enq_ref_number"></small>
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
});

   

    // $(window).load(function(){
    //     $('#editquotation_msg_err').modal('show');
    // });

    var admin_rights = '<?php //echo $this->session->userdata('admin_rights');?>';
    var sel_prods_details = [];

    /*To validate first product...*/
   
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
                    console.log(data);
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            AutoCompleteSelectHandler(event, ui)
        },
        minLength:3,   
    });
});

function AutoCompleteSelectHandler(event, ui){               
    var selectedObj = ui.item; 
    var part_no = selectedObj.value;  
    url = "{{ route('get_part_info')}}";           
    $.ajax({
            url: url,
            dataType: "json",
            data: {
                'part_no' : part_no,
            },
            success: function(data) {
                console.log(data);
                response(data);
            }
    });
}

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
        <button type="button" class="btn btn-primary add-quotation">Send Quotation</button>&nbsp;&nbsp;
    </div>
</div>
@endsection
<!-- End Quatation Preview-->