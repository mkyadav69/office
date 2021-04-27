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
    margin-left: 0.75rem auto;
}
datepicker,
.table-condensed {
  width: 450px;
  height:250px;
}

.table td, .table {
    padding: 1.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table td, .table {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
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
            <form action="{{route('store_supplier')}}" method="post" name="quotation_form" id="quotation_form"  role="form">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Date Created </label>
                                <input type="text" name="reference_date"  id="datepicker" class="form-control" value="{{old('reference_date')}}" placeholder="DD-MM-YYY" />
                                @if ($errors->has('reference_date'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('reference_date') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Part No.</label>
                                <input type="text" id="product_search" name="product_search" placeholder="Part No." value="{{old('product_search')}}" class="form-control">
                                @if ($errors->has('product_search'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('product_search') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif   
                            </div>
                            <input type="hidden" name="_token"  id="token" value="{{ csrf_token() }}">
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Principal </label>
                                <input type="text" id="principal" name="principal" disabled placeholder="Principal" value="{{old('principal')}}"  class="form-control">
                                @if ($errors->has('principal'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('principal') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif   
                            </div>
                            <div class="form-group col-3">
                                <label for="company" class="form-control-label required">Desciptions</label>
                                <input type="text" id="decsription"  name="decsription" disabled placeholder="Descriptions" value="{{old('decsription')}}" class="form-control">
                                @if ($errors->has('decsription'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('decsription') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif   
                            </div>
                           
                        </div>
                    </div>

                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Rate & Factor</h5>
                    </div>
                    <div class="modal-body">
                        <table id="example" class="table table-striped table-bordered order-list" style="width:100%">
                            <tr>
                                <th>Source</th>
                                <th>Currency</th>
                                <th>Rate FC</th>
                                <th>Factor Fc</th>
                                <th>Total Cost</th>
                                <th>Discount</th>
                                <th>Net Price</th>
                                <th>Profit</th>
                                <th>Customer Price</th>
                                <th>Action</th>
                            </tr>
                            <tr class="prod_row_deatails">
                                <td class="col-sm-2" >
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
                                    @if ($errors->has('payment_turm'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('payment_turm') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif   

                                    
                                </td>
                                <td class="col-sm-2"> 
                                    <select class="form-control currency" name="currency" id="currency">
                                    <option value="">Currency</option> 
                                    <?php  $currency	=	$currency;
                                        if(!empty($currency)){
                                        $selected='';
                                        foreach($currency as $k=>$v){  ?>
                                        <option <?php echo $selected; ?> value="<?php echo $v;?>"><?php echo $v;?></option>
                                            <?php  } }?>
                                    </select>

                                    @if ($errors->has('currency'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('currency') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif   
                                </td>
                               
                                <td class="col-sm-1">
                                    <input type="text" name="rate_fc" id="rate_fc" onBlur="updateData();" class="form-control rate_fc" placeholder="Rate FC " />
                                    @if ($errors->has('rate_fc'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('rate_fc') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif   
                                </td>
                                <td class="col-sm-1">
                                    <input type="text" name="factor_fc" id="factor_fc" onBlur="updateData();" class="form-control factor_fc" placeholder="Factor FC" />
                                    @if ($errors->has('factor_fc'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('factor_fc') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif   
                                </td>
                                <td class="col-sm-1">
                                    <input type="text" name="total_cost" id="total_cost" onBlur="updateData();" class="form-control total_cost" nBlur="calTotalCost(this.value)"  placeholder="Total Cost in INR" readonly="readonly"  />
                                    @if ($errors->has('total_cost'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('total_cost') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif   
                                </td>
                                <td class="col-sm-1">
                                    <input type="text" name="discount" id="discount" onBlur="updateData();" class="form-control discount" placeholder="Discount" />
                                    @if ($errors->has('discount'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('discount') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif   
                                </td>
                                <td class="col-sm-1">
                                    <input type="text" name="net_cost" id="net_cost" class="form-control net_cost" placeholder="Net Cost" readonly="readonly" />
                                    @if ($errors->has('net_cost'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('net_cost') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif  
                                </td>
                                <td class="col-sm-1">
                                    <input type="text" name="profit" id="profit" onBlur="updateData();" class="form-control profit" placeholder="Profit" />
                                    @if ($errors->has('profit'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('profit') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif  
                                </td>
                                <td class="col-sm-">
                                    <input type="text" name="selling_price" id="selling_price" class="form-control selling_price" placeholder="Selling Price[INR]" readonly="readonly" />
                                    @if ($errors->has('selling_price'))
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $errors->first('selling_price') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif  
                                </td>
                                <td ><div class="table-data-feature"><span row-id="" class="item" data-toggle="tooltip" data-placement="top" title="View Only"><i class="fa fa-eye text-primary"></i></span></div></td>          
                            </tr> 
                        </table>
                    </div>
                    <div class="modal-footer">
                    <span class="btn-success btn" id="more">
                    <i class="fas fa-plus"></i> More
                        </span>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('show_supplier')}}">
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
$(document).ready(function () {
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
    var counter = 0;
    $("#more").on("click", function () {
        var newRow = $("<tr class='prod_row_deatails'>");
        var cols = "";
        cols += '<td><select class="form-control supplier_name" name="name'+counter+'" id="name'+counter+'"> <option value="">Source</option><?php   if(!empty($source)){ foreach($source as $k=>$v){  ?> <option <?php echo $selected; ?> value="<?php echo $v;?>"><?php echo $v;?></option><?php  } }?>  </select></td>';

        cols += '<td><select class="form-control currency" name="currency'+counter+'" id="currency'+counter+'"> <option value="">Currency</option><?php  $currency; if(!empty($currency)){ foreach($currency as $k=>$v){  ?> <option <?php echo $selected; ?> value="<?php echo $v;?>"><?php echo $v;?></option><?php  } }?>  </select></td>';

        cols += '<td><input type="text" class="form-control rate_fc"   id="rate_fc' + counter + '"  name="rate_fc' + counter + '" placeholder="Rate FC " /></td>';

        cols += '<td><input type="text" class="form-control factor_fc" data-id="'+counter+'"  onchange="factorfc(this);" id="factor_fc' + counter + '"  name="factor_fc' + counter + '" placeholder="Factor FC"/></td>';
        
        cols += '<td><input type="text" class="form-control total_cost" id="total_cost' + counter + '"  name="total_cost' + counter + '" readonly="readonly" placeholder="Total Cost in INR" /></td>';

        cols += '<td><input type="text" class="form-control discount" data-id="'+counter+'" discount' + counter +'" onchange="discountamt(this);" id="discount' + counter + '"  name="discount' + counter + '" placeholder="Discount"/></td>';

        cols += '<td><input type="text" class="form-control net_cost" id="net_cost' + counter + '"  name="net_cost' + counter + '" readonly="readonly" placeholder="Net Cost"/></td>';
        
        cols += '<td><input type="text" class="form-control profit" data-id="'+counter+'" profit' + counter + '" onchange="profitperctg(this);" id="profit' + counter + '"  name="profit' + counter + '" placeholder="Profit"/></td>';

        cols += '<td><input type="text" class="form-control selling_price" id="selling_price' + counter + '"  name="selling_price' + counter + '" readonly="readonly" placeholder="Selling Price[INR]" /></td>';
        
        cols += '<td><div class="table-data-feature"><button type="button" row-id="" class="item delete ibtnDel" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
        if(counter == 4){
          $("#more").hide();  
        }
    });
    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
        if(counter <= 3)
        {
          $("#more").show();  
        }
    });
});

function updateData() { 
    var rate_fc         = $('#rate_fc').val();
    var factor_fc       = $('#factor_fc').val();
    var total_cost      = '';
    var discount        = '';
    var net_cost        = '';
    var profit          = '';
    var selling_price   = '';
    if(rate_fc !='' && factor_fc !=''){
        total_cost      = rate_fc * factor_fc ;
        $('#total_cost').val(total_cost);
        discount        = $('#discount').val();
        net_cost        = parseFloat(total_cost - parseFloat((total_cost*discount)/(100)));
        $('#net_cost').val(net_cost);
        profit          = $('#profit').val();
        selling_price   = parseFloat(net_cost + parseFloat((net_cost*profit)/(100)));
        $('#selling_price').val(selling_price);
    }
}
function ratefc(obj) { 
    var rate_fc = $("#"+id).val();
    var factor_fc       = $('#factor_fc'+id).val();
    var total_cost      = '';
    var discount        = '';
    var net_cost        = '';
    var profit          = '';
    var selling_price   = '';
    if(rate_fc !='' && factor_fc !=''){
        total_cost      = rate_fc * factor_fc ;
        $('#total_cost').val(total_cost);
        discount        = $('#discount'+id).val();
        net_cost        = parseFloat(total_cost - parseFloat((total_cost*discount)/(100)));
        $('#net_cost').val(net_cost);
        profit          = $('#profit'+id).val();
        selling_price   = parseFloat(net_cost + parseFloat((net_cost*profit)/(100)));
        $('#selling_price').val(selling_price);
    }  
}

function factorfc(obj) { 
    var id = obj.id;
    var uniqid = $('#'+id).attr('data-id');
    var rate_fc         = $("#rate_fc"+uniqid).val();
    var factor_fc       = $('#'+id).val();
    var total_cost      = rate_fc * factor_fc ;
    var total_cost      = '';
    var discount        = '';
    var net_cost        = '';
    var profit          = '';
    var selling_price   = '';
    if(rate_fc !='' && factor_fc !=''){
        total_cost      = rate_fc * factor_fc ;
        $('#total_cost'+uniqid).val(total_cost);
        discount = $('#discount'+uniqid).val();
        if(discount !=''){
            net_cost        = parseFloat(total_cost - parseFloat((total_cost*discount)/(100)));
            $('#net_cost'+id).val(net_cost);
        }
        profit = $('#profit'+uniqid).val();
        if(profit !=''){
            selling_price   = parseFloat(net_cost + parseFloat((net_cost*profit)/(100)));
            $('#selling_price'+uniqid).val(selling_price);
        }
    }
}

function discountamt(obj) { 
    var id = obj.id;
        var uniqid = $('#'+id).attr('data-id');
    var rate_fc         =   $("#rate_fc"+uniqid).val();
    var factor_fc       =   $('#factor_fc'+uniqid).val();
    var total_cost      =   rate_fc * factor_fc ;
    var discount        =   $('#'+id).val();
    var net_cost        =   '';
    var profit          =   '';
    var selling_price   =   '';
    if(rate_fc !='' && factor_fc !=''){
        total_cost      = rate_fc * factor_fc ;
        $('#total_cost'+uniqid).val(total_cost);
        discount        = $('#discount'+uniqid).val();
        if(discount !=''){
            net_cost        = parseFloat(total_cost - parseFloat((total_cost*discount)/(100)));
            $('#net_cost'+uniqid).val(net_cost);
        }
        profit        = $('#profit'+uniqid).val();
        if(profit !=''){
            var selling_price   =  parseFloat((net_cost*profit)/(100));
            selling_price = 	 parseFloat(selling_price) + parseFloat(net_cost);
            $('#selling_price'+uniqid).val(selling_price);
        }
        
    }
}

function profitperctg(obj) { 
    var id = obj.id;
    var uniqid = $('#'+id).attr('data-id');
    var rate_fc         =   $("#rate_fc"+uniqid).val();
    var factor_fc       =   $('#factor_fc'+uniqid).val();
    var net_cost        =   $('#net_cost'+uniqid).val();
    var profit          =   '';
    if(rate_fc !='' && factor_fc !=''){
        profit = $('#'+id).val();
        if(profit !=''){
            var	selling_price   =  parseFloat((net_cost*profit)/(100));
            selling_price =    parseFloat(selling_price) + parseFloat(net_cost);
            $('#selling_price'+uniqid).val(selling_price);
        }
    }
}

// function productadd (){
//     var partNo = $("#pro_name").val();
//     var filepath = '<>suppliers/Ajax_Get_make_discp';
//     $.ajax({
//         url:filepath,
//         type:'POST',
//         async:false,
//         dataType: "json",
//         data: {'partNo':partNo},		
//         success: function(res) {
//             if(res.length != 0){
//                 $("#pro_maker").val(res.st_pro_maker);
//                 $("#pro_disc").val(res.st_pro_desc);
//             }else{
//                 alert("Maker and Description not found");
//             }
//         }
//     });
// }
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
        select: function( event, ui ) {
            this.value=ui.item.value; 
            $(this).trigger('change'); 
            return false; 
		},
        minLength:3,   
    });
});

$('#product_search').on('change', function(){
    var part_no =  $('#product_search').val();
    url = "{{ route('get_part_info')}}";           
    $.ajax({
        url: url,
        dataType: "json",
        data: {
            'part_no' : part_no,
        },
        success: function(data) {
            $('#principal').val(data['st_pro_maker']);
            $('#decsription').val(data['st_pro_desc']);
            console.log(data);
        }
    });
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