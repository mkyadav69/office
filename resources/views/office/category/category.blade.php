@extends('theme.layout.base_layout')
@section('title', 'Category')
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
        <h3 class="title-5 m-b-35">Manage Category</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
            @permission('add_category') 
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#addModal">
                    <i class="zmdi zmdi-plus"></i> Add Category
                </button>
                <input type="file" class="au-btn-filter">
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-upload"></i> Import
                </button>
            @endpermission
            </div>
        </div>
    </div>

    <div class="table-responsive table--no-card m-b-30">
        <table id="category" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
</div>
@if(Session::has('errors'))
    @if(!empty($errors->category_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->category_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){
        table = $('#category').DataTable({
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
                    url:'{{ route("get_category") }}',
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
                    { data: 'st_cat_name', title : 'Category Name', className: "text td_ellipsis"},
                    { data: 'st_cat_disc', title : 'Description', className: "text td_ellipsis"},
                    { data: 'dt_created', title : 'Created At'},
                    { data: 'actions', title : 'Actions'},
                ],
                "drawCallback": function( settings ) {
                    $('td.td_ellipsis').css('text-overflow', 'ellipsis');
                    $('td.td_ellipsis').css('overflow', 'hidden');
                    $('td.td_ellipsis').css('white-space', 'nowrap'); 
                    $('td.td_ellipsis').addClass('ellipsisd'); 
                    $('td.td_ellipsis').unbind('click');
                    $('td.date').addClass('date_format');
                    $('td.td_ellipsis').click(function(){
                        if($(this).hasClass('ellipsisd')){
                            $(this).removeAttr('style');
                            $(this).removeClass('ellipsisd'); 
                        }
                        else{
                            $(this).css('text-overflow', 'ellipsis');
                            $(this).css('overflow', 'hidden');
                            $(this).css('white-space', 'nowrap'); 
                            $(this).addClass('ellipsisd'); 
                        }
                    });
                },
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

            $('div #category_name').val(data['st_cat_name']);
            $('div #category_desc').val(data['st_cat_disc']);
            var field = data['st_product_fields'];
            var product_field = {!! json_encode($param) !!};
            if(field != null){
                var select_array = field.split(',');
                var option = '';
                $.each(product_field, function (key, field) {
                    var check_exist_filed = select_array.includes(field);
                    if(check_exist_filed == true){
                        option = option +'<option value="'+ field +'" selected >'+ field +'</option>';
                    }else{
                        option = option + '<option value="'+ field +'">'+ field +'</option>';
                    }
                });
                var sel = '<select name="product_param[]" multiple="" required class="form-control">'+option+'</select>';
                $('div #product_fields').html(sel);
            }else{
                $.each(product_field, function (key, field) {
                   option = option + '<option value="'+ field +'">'+ field +'</option>';
                });
                var sel = '<select name="product_param[]" multiple="" required class="form-control">'+option+'</select>';
                $('div #product_fields').html(sel);
            }
        
            $('#editForm').attr('action', '/edit-category/'+data['cat_id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-category/'+data['cat_id']);
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- add  record -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_category')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Category Name</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="category_name" required value="{{old('category_name')}}" placeholder="Enter category name" class="form-control">
                            @if ($errors->category_add->has('category_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_add->first('category_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea placeholder="write description  . . . " name="category_desc"  required class="form-control">{{old('category_desc')}}</textarea>
                            @if ($errors->category_add->has('category_desc'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_add->first('category_desc') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Principal Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" name="principal_image" required class="form-control-file">
                            @if ($errors->category_add->has('principal_image'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_add->first('principal_image') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="multiple-select" class=" form-control-label">Product Fields Type</label>
                        </div>
                        <div class="col col-md-9">
                            <select name="product_param[]" multiple="" required class="form-control">
                            @if(!empty($param))
                                @foreach($param as  $p)
                                    <option value="{{$p}}" {{ (old('product_param') == null ? '' : (in_array($p ,old('product_param')) ? "selected":"")) }} >{{$p}}</option>
                                @endforeach
                            @endif
                            </select>
                            @if ($errors->category_add->has('product_param'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_add->first('product_param') }}
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
<!-- end add-->
@endsection

@section('editModal')
<!-- edit  record -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Update Category</h5>
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
                            <label for="file-input" class=" form-control-label required">Category Name</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" id="category_name" required name="update_category_name" value="{{old('update_category_name')}}" placeholder="Enter category name" class="form-control">
                            @if ($errors->category_update->has('update_category_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_update->first('update_category_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea id="category_desc" placeholder="write description  . . . " required name="update_category_desc"  class="form-control"> {{old('update_category_desc')}}</textarea>
                            @if ($errors->category_update->has('update_category_desc'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_update->first('update_category_desc') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label required">Principal Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="principal_image" required name="update_principal_image" class="form-control-file">
                            @if ($errors->category_update->has('update_principal_image'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_update->first('update_principal_image') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="multiple-select" class=" form-control-label">Product Fields Type</label>
                        </div>
                        <div class="col col-md-9" id="product_fields">
                        </div>
                            @if ($errors->category_update->has('product_param'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->category_update->first('product_param') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
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
<!-- end delete -->
@endsection
