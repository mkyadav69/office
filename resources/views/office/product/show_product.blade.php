@extends('theme.layout.base_layout')
@section('title', 'Product')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.td-limit {
    max-width: 75px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
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
        <h3 class="title-5 m-b-35">Manage Product</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <a href="{{route('add_product')}}">
                    <button type="button" class="au-btn-filter mb-1" data-dismiss="modal"><i class="zmdi zmdi-plus"></i> Add Product</button>
                </a>
            </div>
        </div>
    </div>
 
    <div class="table-responsive table--no-card m-b-30">
        <table id="customer" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
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

@if(Session::has('errors'))
    @if($errors->cutomer_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif 
<script>
    $(document).ready(function(){
        table = $('#customer').DataTable({
                processing: true,
                orderCellsTop: true,
                fixedHeader: true,
                sort : true,
                scrollX: true,
                bDestroy: true,
                destroy: true,
                sort : true,
                cache: true,
                scrollX: true,
                responsive: true,
                ajax: {
                    url:'{{ route("get_product") }}',
                },
                pageLength: 10,
                columnDefs: [{ 
                    'orderable': true,
                    'targets': [0]
                }, {
                    "searchable": true,
                    "targets": [0]
                }],
                aaSorting: [[0, 'asc']],
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-4x fa-fw" style="font-size:60px;"></i>'
                },
                lengthMenu: [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "columns":[
                    { data: 'st_part_No', className: "text td-limit", title : 'Part No.'},
                    { data: 'st_pro_desc', className: "text text td-limit", title : 'Description'},
                    { data: 'in_pro_qty', className: "text text td-limit", title : 'Qty'},
                    { data: 'fl_pro_price', className: "text text td-limit", title : 'Price'},
                    { data: 'dt_created', title : 'Price Date'},
                    { data: 'in_pro_disc', className: "text text td-limit", title : 'Discount(%)'},
                    { data: 'str_igst_rate', className: "text text td-limit", title : 'IGST'},
                    { data: 'stn_hsn_no', className: "text text td-limit", title : 'HSN'},
                    { data: 'st_pro_maker', className: "select text td-limit", title : 'Principals'},
                    { data: 'stn_brand', className: "select text td-limit", title : 'Brand'},
                    { data: 'in_cat_id', className: "select text td-limit", title : 'Category'},
                    {
                        'data': null,
                        'render': function (data, type, row) {
                            return '<div class="table-data-feature"><button row-id="' + row.id + '" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button><button row-id="' + row.id + '" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>'
                        }, title: 'Actions'
                    }
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
            console.log(data);
            $('div #customer_name').val(data['st_com_name']);
            $('div #customer_last_name').val(data['st_cust_lname']);
            $('div #customer_name').val(data['st_com_name']);
            $('div #customer_region').val(data['st_regions']);

            $('div #customer_address').val(data['st_com_address']);
            $('div #persion1_name').val(data['st_con_person1']);
            $('div #persion1_email').val(data['st_con_person1_email']);
            $('div #persion1_mobile').val(data['st_con_person1_mobile']);

            $('div #persion2_name').val(data['st_con_person2']);
            $('div #persion2_email').val(data['st_con_person2_email']);
            $('div #persion2_mobile').val(data['st_con_person2_mobile']);

            $('div #customer_city').val(data['st_cust_city']);
            $('div #gst_no').val(data['cust_pin_no']);
            $('div #customer_pincode').val(data['in_pincode']);

            $('div #customer_contry').val(data['st_country']);
            $('div #customer_state').val(data['st_cust_state']);

            $('div #customer_mobile').val(data['st_cust_mobile']);
            $('div #customer_name').val(data['st_cust_email']);
            $('div #customer_name').val(data['st_cust_email_cc']);
            $('div #customer_name').val(data['in_branch']);

            $('#editForm').attr('action', '/edit-customer/'+data['in_cust_id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-customer/'+data['in_cust_id']);
            $('#deleteModal').modal('show');  
        });
    });
    
</script>
@endsection



<!-- Delete-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
    </div>
</div>
<!-- end modal large -->