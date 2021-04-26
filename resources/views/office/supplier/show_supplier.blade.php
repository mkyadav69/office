@extends('theme.layout.base_layout')
@section('title', 'Supplier')
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
        <h3 class="title-5 m-b-35">Manage Suppliers</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
            @permission('add_supplier')
                <a href="{{route('add_supplier')}}">
                    <button type="button" class="au-btn-filter mb-1" data-dismiss="modal"><i class="zmdi zmdi-plus"></i> Add Supplier</button>
                </a>
            @endpermission
            </div>
        </div>
    </div>

    <div class="table-responsive table--no-card m-b-30">
        <table id="supplier" class="table table-borderless table--no-card m-b-30 table-striped table-earning" style="width:100%">
        </table>
    </div>
</div>
@if(Session::has('errors'))
    @if(!empty($errors->supplier_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->supplier_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){
        table = $('#supplier').DataTable({
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
                    url:'{{ route("get_supplier") }}',
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
                    [10, 20, 30, -1],
                    [10, 20, 30, "All"]
                ],
                "columns":[
                    { data: 's_make', title : 'Maker', className: "text"},
                    { data: 's_partno', title : 'Part No.', className: "text"},
                    { data: 's_description', title : 'Description', className: "text"},
                    { data: 's_source', title : 'Source', className: "text"},
                    { data: 's_currency', title : 'Currency', className: "select"},
                    { data: 's_rate_fc', title : 'Rate FC', className: "text"},
                    { data: 's_factor_fc', title : 'Factor FC', className: "text"},
                    { data: 's_totalcost', title : 'Total Cost', className: "text"},
                    { data: 's_discount', title : 'Discount', className: "text"},
                    { data: 's_netprice', title : 'Net Price', className: "text"},
                    { data: 's_profit', title : 'Profit', className: "text"},
                    { data: 's_cust_price', title : 'Customer Price', className: "text"},
                    { data: 'dt_created', title : 'Created At'},
                    { data: 'actions', title : 'Actions'},
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
            var url = '{{ route("edit_supplier", ":id") }}';
            url = url.replace(':id', data['pro_id']);
            window.location.replace(url);
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-supplier/'+data['id']);
            $('#deleteModal').modal({
                backdrop: 'static'
            });
            $('#deleteModal').modal('show');  
        });
    });
</script>
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