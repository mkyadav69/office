@extends('theme.layout.base_layout')
@section('title', 'Reason')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.td-limit {
    max-width: 200px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.section__content--p30{
    padding: 0px 0px;
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
        <h3 class="title-5 m-b-35">Manage Reasons</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                @permission('add_reason')
                    <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#addModal">
                        <i class="zmdi zmdi-plus"></i> Add Reason
                    </button>
                @endpermission
            </div>
        </div>
    </div> 

    <div class="table-responsive table--no-card m-b-30">
        <table id="reason" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
    
</div>
@if(Session::has('errors'))
    @if(!empty($errors->reason_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->reason_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif 

<script>
    $(document).ready(function(){
        table = $('#reason').DataTable({
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
                    url:'{{ route("get_reason") }}',
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
                    { data: 'stn_reasons', title : 'Reason Name', className: "text td-limit"},
                    { data: 'stn_reason_type', title : 'Reason Mode', className: "text td-limit"},
                    { data: 'dt_created', title : 'Created Date'},
                    {
                        'data': null,
                        'render': function (data, type, row) {
                            return '<div class="row form-group"><div class="table-data-feature"><button row-id="' + row.id + '" class="item edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit text-primary"></i></button> <button row-id="' + row.id + '" class="item delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete text-danger"></i></button></div></div>'
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
            var type = data['stn_reason_type'];
            var r_field = null;
            
            if(type == 'Pending Order'){
                r_field = 1;
            }else{
                r_field = 2;
            }
            $('div #reason_name').val(data['stn_reasons']);
            $('div #select_mode').val(r_field);

            $('#editForm').attr('action', '/edit-reason/'+data['int_id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-reason/'+data['int_id']);
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- add  reason -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_reason')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Reason Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Name" required name="reason_name"  value="{{ old('reason_name')}}" class="form-control">
                            @if ($errors->reason_add->has('reason_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->reason_add->first('reason_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                        

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Reason Mode</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <select name="select_mode" required class="form-control">
                                <option value="">Select Reason</option>
                                <option value="1" {{ old('select_mode') == 1 ? "selected" : "" }} >Pending Order</option>
                                <option value="2" {{ old('select_mode') == 2 ? "selected" : "" }} >Pending Shipment</option>
                            </select>
                            @if ($errors->reason_add->has('select_mode'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->reason_add->first('select_mode') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
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
@endsection

@section('editModal')
<!-- update  reason -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Update Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form  method="post" id="editForm">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Reason Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="reason_name" placeholder="Name" required name="update_reason_name"  class="form-control">
                            @if ($errors->has('update_reason_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_reason_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                        

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Reason Mode</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <select name="update_select_mode" id="select_mode" required class="form-control">
                                <option value="">Select Reason</option>
                                <option value="1" {{old('update_select_mode')== '1' ? 'selected' : ''}}>Pending Order</option>
                                <option value="2" {{old('update_select_mode')== '2' ? 'selected' : ''}}>Pending Shipment</option>
                            </select>
                            @if ($errors->has('update_select_mode'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_select_mode') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
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