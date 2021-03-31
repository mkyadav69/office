@extends('theme.layout.base_layout')
@section('title', 'Quotations')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
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
        <h3 class="title-5 m-b-35">Manage Quotation</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
            @permission('add_quatationadd')
                <a href="{{route('add_quatation')}}">
                    <button type="button" class="au-btn-filter mb-1" data-dismiss="modal"><i class="zmdi zmdi-plus"></i> Add Quotation</button>
                </a>
            @endpermission
            </div>
        </div>
    </div>
 
    <div class="table-responsive table--no-card m-b-30">
        <table id="product" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
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
                    url:'{{ route("get_quatation") }}',
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
                    { data: 'in_cust_id', className: "text td-limit", title : 'Customer'},
                    { data: 'owner_id', className: "select td-limit", title : 'Owner'},
                    { data: 'st_currency_applied', className: "select td-limit", title : 'Currency'},
                    { data: 'in_quot_num', className: "text td-limit", title : 'Quatation Id'},
                    { data: 'final_amount', className: "text td-limit", title : 'Total'},
                    { data: 'lead_from', className: "text td-limit", title : 'Lead From'},
                    { data: 'in_branch_id', className: "select td-limit", title : 'Branch'},
                    { data: 'dt_date_created', className: "td-limit", title : 'Created At'},
                    { data: 'lead_from', className: "td-limit", title : 'Status'},
                    {
                        'data': null,
                        'render': function (data, type, row) {
                            return '<a href="'+window.location.origin+'/pdf_'+new Date().getFullYear()+'/'+row.stn_pdf_name+'" target="_blank"><div class="table-data-feature"><button row-id="" class="item" data-toggle="tooltip" data-placement="top" title="Download"><i class="zmdi zmdi-download text-success"></i></button></div></a>'
                        }, title: 'Download'
                    },
                    { data: 'lead_from', className: "td-limit", title : 'Reason'},
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
            $('#deleteForm').attr('action', '/delete-product/'+data['pro_id']);
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