@extends('theme.layout.base_layout')
@section('title', 'Customer')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}


</style>
<div class="row">
    @if (session()->has('customer_message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{ session('customer_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">Manage Customers</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#largeModal">
                    <i class="zmdi zmdi-plus"></i> Add Customer
                </button>
                <input type="file" class="au-btn-filter">
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-upload"></i> Import
                </button>
            </div>
        </div>
    </div>
 
    <div class="table-responsive table--no-card m-b-30">
        <table id="customer" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
                       
</div>
@if(Session::has('errors'))
    <script>
        $(document).ready(function(){
            $('#largeModal').modal({show: true});
        });
    </script>
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
                    url:'{{ route("get_customer") }}',
                },
                pageLength: 10,
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
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "columns":[
                    { data: 'st_cust_fname', className: "text", title : 'Name'},
                    { data: 'st_com_name', className: "text", title : 'Company Name'},
                    { data: 'st_cust_city', className: "select", title : 'View Branch Wise'},
                    { data: 'st_cust_state', className: "text", title : 'State'},
                    { data: 'st_regions', className: "select",title : 'View Regions Wise'},
                    {
                        'data': null,
                        'render': function (data, type, row) {
                            return '<div class="table-data-feature"><button row-id="' + row.id + '" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button> <button row-id="' + row.id + '" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div>'
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
            $('div #customer_pincode').val(data['cust_pin_no']);
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

<!-- add records -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="form-group">
                            <input type="text" id="customer_name" name="customer_name"placeholder="name" class="form-control">
                            @if ($errors->has('customer_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('customer_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_last_name" name="customer_last_name"placeholder="Last name" class="form-control">
                            @if ($errors->has('customer_last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('customer_last_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea type="text" id="customer_address" name="customer_address"placeholder="Address . . . !" class="form-control"></textarea>
                            
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_region" name="customer_region" placeholder="region" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_mobile" name="customer_mobile" placeholder="Mobile" class="form-control">
                        </div>
        
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_city" name= "customer_city" placeholder="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_state" name="customer_state" placeholder="State city" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_pincode" name="customer_pincode" placeholder="Pin Code" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_contry" name="customer_contry" placeholder="Country" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="persion1_name" name="persion1_name"placeholder="Person 1 name" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion1_email" name= "persion1_email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion1_mobile" name="persion1_mobile" placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="persion2_name" name="persion2_name"placeholder="Person 2 name" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion2_email" name= "persion1_email" placeholder="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion2_mobile" name="persion1_mobile" placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="branch_name" name="branch_name"placeholder="Branch name" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</div>
<!-- end add record -->


<!-- edit records -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Update Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form method="post" id="editForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="customer_name" name="customer_name"placeholder="name" class="form-control">
                            @if ($errors->has('customer_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('customer_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_last_name" name="customer_last_name"placeholder="Last name" class="form-control">
                            @if ($errors->has('customer_last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('customer_last_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea type="text" id="customer_address" name="customer_address"placeholder="Address . . . !" class="form-control"></textarea>
                            
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_region" name="customer_region" placeholder="region" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_mobile" name="customer_mobile" placeholder="Mobile" class="form-control">
                        </div>
        
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_city" name= "customer_city" placeholder="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_state" name="customer_state" placeholder="State city" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_pincode" name="customer_pincode" placeholder="Pin Code" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_contry" name="customer_contry" placeholder="Country" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="persion1_name" name="persion1_name"placeholder="Person 1 name" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion1_email" name= "persion1_email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion1_mobile" name="persion1_mobile" placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="persion2_name" name="persion2_name"placeholder="Person 2 name" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion2_email" name= "persion1_email" placeholder="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion2_mobile" name="persion1_mobile" placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="branch_name" name="branch_name"placeholder="Branch name" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</div>
<!-- end add record -->


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