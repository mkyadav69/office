@extends('theme.layout.base_layout')
@section('title', 'Users')
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
        <h3 class="title-5 m-b-35">Manage Users</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#addModal">
                    <i class="zmdi zmdi-plus"></i> Add User
                </button>
            </div>
        </div>
    </div> 

    <div class="table-responsive table--no-card m-b-30">
        <table id="users" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
    
</div>
@if(Session::has('errors'))
    @if(!empty($errors->user_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->user_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){
        table = $('#users').DataTable({
                processing: true,
                orderCellsTop: true,
                fixedHeader: true,
                sort : true,
                scrollX: true,
                bDestroy: true,
                responsive:true,
                destroy: true,
                sort : true,
                cache: true,
                scrollX: true,
                responsive: true,
                ajax: {
                    url:'{{ route("get_user") }}',
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
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "columns":[
                    { data: 'first_name', title : 'First Name', className: "text"},
                    { data: 'last_name', title : 'Last Name', className: "text"},
                    { data: 'user_name', title : 'User Name', className: "text"},
                    { data: 'email', title : 'Email Id', className: "text"},
                    { data: 'branch_id', title : 'Branch', className: "text"},
                    { data: 'dt_created', title : 'Created At', className: "text"},
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
            $('div #first_name').val(data['first_name']);
            $('div #last_name').val(data['last_name']);
            $('div #username').val(data['user_name']);
            $('div #email').val(data['email']);
            $('div #cc_email').val(data['cc_email']);
            if(data['branch_id'] != '' && data['branch_id'] != null){
                var branch_wise = {!! json_encode($name_branch) !!};
                var branch = branch_wise[data['branch_id']];
            }else{
                var branch = '';
            }
            $('div #branch').val(branch);
            $('#editForm').attr('action', '/edit-user/'+data['id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-parameter/'+data['id']);
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- Add  Data-->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addModal">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_user')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">First Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Fisrt Name" required name="first_name" value="{{old('first_name')}}" class="form-control">
                            @if ($errors->user_add->has('first_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('first_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Last Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Last Name" required name="last_name" value="{{old('last_name')}}" class="form-control">
                            @if ($errors->user_add->has('last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('last_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Username</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Username" required name="username" value="{{old('username')}}" class="form-control">
                            @if ($errors->user_add->has('username'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('username') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" placeholder="Password" required name="password" value="{{old('password')}}" class="form-control">
                            @if ($errors->user_add->has('password'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('password') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" placeholder="Email" required name="email" value="{{old('email')}}" class="form-control">
                            @if ($errors->user_add->has('email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('email') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">CC Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea type="email" placeholder="CC Email . . . " required name="cc_email" value="{{old('cc_email')}}" class="form-control"></textarea>
                            @if ($errors->user_add->has('cc_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('cc_email') }}
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
                            @if(!empty($branch_wise))
                                <select name="branch" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branch_wise as $kb=>$vb)
                                        <option  value="{{$kb}}"  {{ ($kb == old('branch',$vb))?'selected':'' }} >{{$vb}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->user_add->has('branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('branch') }}
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
<!-- End Add-->
@endsection

@section('editModal')
<!-- Update  Data-->
<div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModal">Update User</h5>
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
                            <label for="file-input" class=" form-control-label required">First Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Fisrt Name" required id="first_name" name="update_first_name" value="{{old('update_first_name')}}" class="form-control">
                            @if ($errors->user_update->has('update_first_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_update->first('update_first_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Last Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Last Name" required id="last_name" name="update_last_name" value="{{old('update_last_name')}}" class="form-control">
                            @if ($errors->user_update->has('update_last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_update->first('update_last_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Username</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Username" required id="username" name="update_username" value="{{old('update_username')}}" class="form-control">
                            @if ($errors->user_add->has('update_username'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('update_username') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" placeholder="Email" required id="email" name="update_email" value="{{old('update_email')}}" class="form-control">
                            @if ($errors->user_add->has('update_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('update_email') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">CC Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea type="email" placeholder="CC Email . . . " required id="cc_email" name="update_cc_email" value="{{old('cc_email')}}" class="form-control"></textarea>
                            @if ($errors->user_add->has('update_cc_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('update_cc_email') }}
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
                            @if(!empty($branch_wise))
                                <select id="branch" name="update_branch" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branch_wise as $kb=>$vb)
                                        <option  value="{{$kb}}"  {{ ($kb == old('update_branch',$vb))?'selected':'' }} >{{$vb}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->user_add->has('update_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('update_branch') }}
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