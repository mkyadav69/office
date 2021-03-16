@extends('theme.layout.base_layout')
@section('title', 'Users')
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
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">Manage Role & Permissions</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <a href="{{route('add_role')}}">
                    <button type="button" class="au-btn-filter mb-1" data-dismiss="modal"><i class="zmdi zmdi-plus"></i> Add Role</button>
                </a>
            </div>
        </div>
    </div> 

    <div class="table-responsive table--no-card m-b-30">
        <table id="" class="table table-borderless table-striped table-earning" style="width:100%">
            <thead>
                <tr class="filters">
                   
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                @if (!empty($roles))
                    @foreach ($roles as $role)
                        <tr>
                            

                            <td>
                                {{ $role->name }}
                            </td>

                            <td>
                                {{ $role->display_name }}
                            </td>

                            <td>
                                {{ $role->description }}
                            </td>

                            <td class="td-limit">
                                @foreach ($role->permissions as $permission )
                                    {!! $permission->display_name.";" !!}
                                @endforeach
                            </td>
                            
                            @php
                                $arr = [];
                                if(\Auth::user()->can('edit_role')){
                                    $edit = route('edit.role', ['edit' => $role->id ]);
                                    $arr[] = "<a class='btn edit edit-role' title='Edit Role' href=$edit><i class='fa fa-pencil text-primary' aria-hidden='true' ></i>
                                    </a>";
                                }
                                if(\Auth::user()->can('delete_role')){
                                    $delete = route('remove.role', ['delete' => $role->id]);
                                    $arr[] ="<a class='btn trush delete-role' title='Delete Role' href=$delete ><i class='fa fa-trash text-danger' aria-hidden='true' ></i></i>
                                    </a>";
                                }
                                if(!\Auth::user()->can(['edit_role','delete_role'])){ 
                                    $arr[] = "<a class='btn' title='View Only'><i class='fa fa-eye text-primary' aria-hidden='true' ></i></i></a>";
                                }
                                
                            @endphp

                            @if(\Auth::user()->can(['edit_role', 'delete_role']))
                                <td>
                                    {!! implode(' ', $arr) !!}
                                </td>
                            @else
                                <td>
                                    {!! implode(' ', $arr) !!}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
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
    });
</script>
@endsection