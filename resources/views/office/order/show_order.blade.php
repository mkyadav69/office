@extends('theme.layout.base_layout')
@section('title', 'Quotations')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.col-md-3 {
    padding-left: 20px;
}

/* .td-limit {
    max-width: 75px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
} */

</style>
<div class="row">
    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">Manage Orders</h3>
        <div class="table-data__tool">
            
        </div>
    </div>
 
    <div class="table-responsive table--no-card m-b-30">
        <table id="product" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>

    <div id="dialog" title="Confirmation Required">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure, you want to generate order for this quotation ?</p>
            </div>
        </div>
    </div>                       
</div>
<script>
    $(document).ready(function(){
        table = $('#product').DataTable({
                processing: true,
                orderCellsTop: true,
                fixedHeader: true,
                sort : true,
                scrollX: true,
                scrollCollapse: true,
                bDestroy: true,
                destroy: true,
                sort : true,
                cache: true,
                responsive: true,
                ajax: {
                    url:'{{ route("get_order") }}',
                },
                columnDefs: [{ 
                    'orderable': true,
                    'targets': [0]
                }, {
                    "searchable": true,
                    "targets": [0]
                }],
                aaSorting: [[0, 'desc']],
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-4x fa-fw" style="font-size:60px;"></i>'
                },
                lengthMenu: [
                    [10, 20, 30, -1],
                    [10, 20, 30, "All"]
                ],
                "columns":[
                    { data: 'in_cust_id', className: "text td-limit", title : 'Company Name'},
                    { data: 'in_uniq_order_id', className: "text td-limit", title : 'Order No'},
                    { data: 'st_cust_order_num', className: "text td-limit", title : 'Customer Order No'},
                    { data: 'flt_ord_net_total', className: "text td-limit", title : 'Total Amount'},
                    { data: 'lead_from', className: "text td-limit", title : 'Lead From'},
                    {
                        'data': null,
                        'render': function (data, type, row) {
                            return '<a href="'+window.location.origin+'/pdf_'+new Date().getFullYear()+'/'+row.stn_pdf_name+'" target="_blank"><div class="table-data-feature text-success">Download<button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="Download"><i class="zmdi zmdi-download text-success"></i></button></div></a>'
                        }, title: 'Download'
                    },
                    { data: 'reason', className: "td-limit", title : 'Reason'},
                    { data: 'actions', className: "td-limit", title : 'Actions'},
                    // { data: 'dt_date_created', className: "td-limit", title : 'Created At'},
                    // { data: 'actions', title : 'Actions'},
                    
                ],  
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        if ($(column.header()).hasClass('select')) {
                            console.log(column);
                            var select = $('<select  tyle="width:150px; height: 30px;  font-weight: normal;  border-radius: 5px;" class="js-select2" ><option value="">' + $(column.header()).html() + '</option></select>')
                                    .appendTo($(column.header()).empty())
                                    .on('change', function (e) {
                                        e.stopImmediatePropagation();
                                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                                        return false;
                                    });
                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                        }else if ($(column.header()).hasClass('text')) {
                            var text = $('<input style="width:150px; height: 30px;  font-weight: normal;  border-radius: 5px;" type="text" placeholder="' + $(column.header()).html() + '" />')
                            .appendTo($(column.header()).empty())
                            .on('keyup change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if (column.search() !== this.value) {
                                    column.search(val).draw();
                                }
                                return false;
                            });
                        }
                    });
                }
        });
        table.on('click', '.edit', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            var url = '{{ route("edit_quatation", ":id") }}';
            url = url.replace(':id', data['in_quot_id']);
            window.location.replace(url);
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-quatation/'+data['in_quot_id']);
            $('#deleteModal').modal({
                backdrop: 'static'
            });
            $('#deleteModal').modal('show');  
        });

        table.on('click', '.view', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();

            $('div #number').val(data['in_quot_num']);
            $('div #follow_date').val(data['dt_date_created']);
            $('div #value').val(data['final_amount']);
            if(data['dt_date_modified'] != null){
                var date = new Date(data['dt_date_modified']);
            }else{
                var date = '';
            }
            $('div #last_update').val(date);
            $('#viewModal').modal({
                backdrop: 'static'
            });
            $('#viewModal').modal('show');  
        });

        table.on('click', '.add', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();

            $('div #order_number').val(data['in_uniq_order_id']);
            $('div #order_date').val(data['dt_cust_order_date']);
            $('div #order_value').val(data['flt_ord_net_total']);
            $('div #customer_name').val(data['in_cust_id']);

            
            // var customer = {!! json_encode($customer) !!};
        
            
            if(data['dt_date_modified'] != null){
                var date = new Date(data['dt_date_modified']);
            }else{
                var date = '';
            }
            $('div #last_update').val(date);
            $('#addMoreModal').modal({
                backdrop: 'static'
            });
            $('#addMoreModal').modal('show');  
        });

        table.on('click', '.generate_order', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            var url = '{{ route("update_order", ":id") }}';
            url = url.replace(':id', data['in_quot_id']);
            $("#dialog").dialog({
                buttons : {
                    "Cancel" : function() {
                        $(this).dialog("close");
                        $(this).addClass("btn btn-primary");
                    },
                    "Confirm" : function() {
                        window.location.replace(url); 
                    },
                },
            });
        });
        $('#dialog').hide();
    });
   
</script>
@endsection
@section('addMoreModal')
<!-- Add  Data-->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Order No.</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Order No." disabled id="order_number" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Order Date</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Order Date" disabled name="order_date" id="order_date" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Order Value</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Order Name" disabled name="order_value" id="order_value" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Company Name</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Customer name" name="customer_name" disabled id="customer_name" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Reason Name</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Reason name" name="reason_name" id="reason_name" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class="form-control-label required">Reason</label>
                    </div>
                     <div class="col-12 col-md-9">
                        <select id="reason" required name="reason" class="form-control">
                            <option value="">Selet Reason</option>
                            <option value="Make &amp; Model not specified.">Make &amp; Model not specified.</option>
                            <option value="In Process.">In Process.</option>
                            <option value="Old payment pending">Old payment pending</option>
                        </select>
                        <small class="help-block form-text text-danger" id="error_reason"></small>
                    </div>
                </div>

               
                
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
            </div>
        </div>
    </div>
<!-- End Add-->
<script>
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
</script>
@endsection

@section('viewModal')
<!-- Add  Data-->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Quotation No.</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Quote No." disabled id="number" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Follow Up Date</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Follow Date" disabled id="follow_date" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Quotation Value</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="column name" disabled id="value" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Reason</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Reason" disabled id="reason" value="Open" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">User Name</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="User Name" disabled id="name" value="{{ \Auth::user()->user_name }}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required"> Last Update</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Last Update"  disabled id="last_update" class="form-control">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<!-- End Add-->
@endsection

@section('deleteModal')
<!-- Delete-->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="deleteForm">
            @csrf
            <div class="modal-body">
                <p>Are you sure to delete the record ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </form>
    </div>
<!-- end modal large -->
@endsection

@section('confirmModal')
<!-- Delete-->
    
<!-- end modal large -->
@endsection