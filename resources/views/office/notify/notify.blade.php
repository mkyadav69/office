@extends('theme.layout.base_layout')
@section('title', 'Notification')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.td-limit {
    max-width: 150px;
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
    @if (session()->has('error_message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{ session('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">Manage Notification</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                @permission('add_notify')
                    <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#addModal">
                        <i class="zmdi zmdi-plus"></i> Add Notification
                    </button>
                @endpermission
            </div>
        </div>
    </div>
    <div class="table-responsive table--no-card m-b-30">
        <table id="notify" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
    
</div>
@if(Session::has('errors'))
    @if(!empty($errors->notify_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->notify_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){
        table = $('#notify').DataTable({
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
                    url:'{{ route("get_notify") }}',
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
                    { data: 'name', title : 'Name', className: "text td-limit"},
                    { data: 'email', title : 'Email', className: "text td-limit"},
                    { data: 'branch_id', title : 'Branch Name', className: "text td-limit"},
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
            var branch_wise = {!! json_encode($swipe_branch) !!};
            $('div #name').val(data['name']);
            $('div #email1').val(data['email']);
            $('div #email2').val(data['cc_email']);
            console.log(data);
            if(branch_wise != ''){
                $('div #select_branch').val(branch_wise[data['branch_id']]);
            }else{
                $('div #select_branch').val('');
            }
            $('#editForm').attr('action', '/edit-notify/'+data['id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-notify/'+data['id']);
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- add records -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Notify Users</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_notify')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" placeholder="Name" name="name" required value="{{old('name')}}" class="form-control">
                            @if ($errors->notify_add->has('name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_add->first('name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email Address 1</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" placeholder="Email" name="email1"  required value="{{old('email1')}}" class="form-control">
                            @if ($errors->notify_add->has('email1'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_add->first('email1') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email Address 2</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <textarea type="text" placeholder="List of emails . . . " required name="email2"  value="{{old('email2')}}" class="form-control">{{old('email2')}}</textarea>
                            @if ($errors->notify_add->has('email2'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_add->first('email2') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                        

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Branch Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                        @if(!empty($branch_wise))
                            <select name="select_branch" required class="form-control" >
                                <option value="">Select Branch</option>
                                @foreach($branch_wise as $key=>$branch)
                                    <option value="{{$key}}" {{ old('select_branch') == $key ? "selected" : "" }} >{{$branch}}</option>
                                @endforeach
                            </select>
                            @if ($errors->notify_add->has('select_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_add->first('select_branch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
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
<!-- end add-->
@endsection

@section('editModal')
<!-- add records -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Update Notify Users</h5>
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
                            <label for="file-input" class=" form-control-label required">Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" placeholder="Name" id="name" required name="name"  value="{{old('name')}}" class="form-control">
                            @if ($errors->notify_update->has('name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_update->first('name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email Address 1</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" placeholder="Email" id="email1" required name="email1"  value="{{old('email1')}}" class="form-control">
                            @if ($errors->notify_update->has('email1'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_update->first('email1') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email Address 2</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <textarea type="text" placeholder="Email" id="email2" required name="email2"  value="{{old('email2')}}" class="form-control">{{old('email2')}}</textarea>
                            @if ($errors->notify_update->has('email2'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_update->first('email2') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                        

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Branch Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                        @if(!empty($branch_wise))
                            <select name="select_branch" id="select_branch" required class="form-control" >
                                <option value="">Select Branch</option>
                                @foreach($branch_wise as $key=>$branch)
                                    <option value="{{$key}}">{{$branch}}</option>
                                @endforeach
                            </select>
                            @if ($errors->notify_add->has('select_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->notify_add->first('select_branch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
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
<!-- end add-->
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
<!-- end delete -->
@endsection