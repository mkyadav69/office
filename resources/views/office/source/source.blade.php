@extends('theme.layout.base_layout')
@section('title', 'Source')
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
        <h3 class="title-5 m-b-35">Manage Source</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
            @permission('add_source')
                <button class="au-btn-filter mb-1 add_modal" data-toggle="modal" data-target="#addModal">
                    <i class="zmdi zmdi-plus"></i> Add Source
                </button>
            @endpermission
            </div>
        </div>
    </div>

    <div class="table-responsive table--no-card m-b-30">
        <table id="source" class="table table-borderless table--no-card m-b-30 table-striped table-earning" style="width:100%">
        </table>
    </div>
</div>
@if(Session::has('errors'))
    @if(!empty($errors->source_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->source_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){
        table = $('#source').DataTable({
                orderCellsTop: true,
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
                    url:'{{ route("get_source") }}',
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
                    { data: 'pro_source', title : 'Source Name', className: "text"},
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

            $('div #source_name').val(data['pro_source']);

            $('#editForm').attr('action', '/edit-source/'+data['id']);
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
            $('#deleteForm').attr('action', '/delete-source/'+data['id']);
            $('#deleteModal').modal({
                backdrop: 'static'
            });
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- add record -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Source</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_source')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Source Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="source_name" required value="{{old('source_name')}}" placeholder="Source Name" class="form-control">
                            @if ($errors->source_add->has('brand_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->source_add->first('source_name') }}
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
<!-- end add large -->
@endsection


@section('editModal')
<!-- edit records -->
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="largeModalLabel">Update Source</h5>
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
                        <label for="file-input" class=" form-control-label required">Source Name</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="source_name" required name="update_source_name" value="{{old('update_source_name')}}" placeholder="Source Name" class="form-control">
                        @if ($errors->source_update->has('update_source_name'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->source_update->first('update_source_name') }}
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