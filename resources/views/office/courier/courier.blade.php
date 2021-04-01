@extends('theme.layout.base_layout')
@section('title', 'Courier')
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
.col-md-3 {
    padding-left: 20px;
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
        <h3 class="title-5 m-b-35">Manage Couriers</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                @permission('add_courier')
                    <button class="au-btn-filter mb-1 add_modal" data-toggle="modal" data-target="#addModal">
                        <i class="zmdi zmdi-plus"></i> Add Courier
                    </button>
                @endpermission
            </div>
        </div>
    </div> 
    <div class="table-responsive table--no-card m-b-30">
        <table id="courier" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
</div>
@if(Session::has('errors'))
    @if(!empty($errors->courier_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->courier_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif
  
<script>
    $(document).ready(function(){
        table = $('#courier').DataTable({
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
                    url:'{{ route("get_courier") }}',
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
                    { data: 'st_courier_name', title : 'Courier Agency Name', className: "text td-limit"},
                    { data: 'st_branch_name', title : 'Branch Name', className: "select td-limit"},
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
            console.log(data);

            $('div #courier_name').val(data['st_courier_name']);
            $('div #select_branch').val(data['in_branch_id']);
        
            $('#editForm').attr('action', '/edit-courier/'+data['in_courier_id']);
            $('#editModal').modal({
                backdrop: 'static'
            });
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-courier/'+data['in_courier_id']);
            $('#deleteModal').modal({
                backdrop: 'static'
            });
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- add  record -->
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="largeModalLabel">Add Courier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card">
            <form action="{{route('store_courier')}}" method="post">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Courier Name</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="courier_name" required placeholder="Enter courier name" value="{{old('courier_name')}}" class="form-control">
                        @if ($errors->courier_add->has('courier_name'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->courier_add->first('courier_name') }}
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
                    <div class="col-12 col-md-9">
                        <select name="select_branch" required class="form-control">
                            <option value="">Select Branch</option>
                            @if(!empty($branch_wise))
                                @foreach($branch_wise as $id=>$name)
                                    <option value="{{ $id }}" {{ old('select_branch') == $id ? "selected" : "" }}>{{ $name}}</option>
                                @endforeach
                            @else
                                <option value="">No branch found</option>
                            @endif
                        </select>
                        @if ($errors->courier_add->has('select_branch'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->courier_add->first('select_branch') }}
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
<!-- edit record -->
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="largeModalLabel">Update Courier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card">
            <form method="post" id="editForm">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-input" class=" form-control-label required">Courier Name</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="courier_name" required name="update_courier_name" placeholder="Enter courier name" class="form-control">
                        @if ($errors->courier_update->has('update_courier_name'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->courier_update-> first('update_courier_name') }}
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
                    <div class="col-12 col-md-6">
                        <select id="select_branch" required name="update_select_branch" class="form-control">
                            <option value="">Select Branch</option>
                            @if(!empty($branch_wise))
                                @foreach($branch_wise as $id=>$name)
                                <option value="{{ $id }}">{{ $name}}</option>
                                @endforeach
                            @else
                                <option value="">No branch found</option>
                            @endif
                        </select>
                        @if ($errors->has('update_select_branch'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->first('update_select_branch') }}
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