@extends('theme.layout.base_layout')
@section('title', 'Usp')
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
        <h3 class="title-5 m-b-35">Manage USP</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#largeModal">
                    <i class="zmdi zmdi-plus"></i> Add Usp
                </button>
            </div>
        </div>
    </div> 
    <div class="table-responsive table--no-card m-b-30">
        <table id="usp" class="table table-borderless table-striped table-earning" style="width:100%">
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
        table = $('#usp').DataTable({
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
                url:'{{ route("get_usp") }}',
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
                { data: 'category', title : 'Category', className: "text"},
                { data: 'usp_type', title : 'Usp Type', className: "text"},
                { data: 'packing', title : 'Packing', className: "text td_ellipsis"},
                { data: 'brand', title : 'Brand', className: "text"},
                { data: 'principal', title : 'Principal', className: "select"},
                { data: 'dt_created', title : 'Created At'},

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
            },
            "drawCallback": function( settings ) {
                $('td.td_ellipsis').css('text-overflow', 'ellipsis');
                $('td.td_ellipsis').css('width', '50px');
                $('td.td_ellipsis').css('overflow', 'hidden');
                $('td.td_ellipsis').css('white-space', 'nowrap'); 
                $('td.td_ellipsis').addClass('ellipsisd'); 
                $('td.td_ellipsis').unbind('click');
                $('td.date').addClass('date_format');
                $('td.td_ellipsis').click(function(){
                    if($(this).hasClass('ellipsisd')){
                        $(this).removeAttr('style');
                        $(this).removeClass('ellipsisd'); 
                    }else{
                        $(this).css('text-overflow', 'ellipsis');
                        $(this).css('overflow', 'hidden');
                        $(this).css('white-space', 'nowrap'); 
                        $(this).addClass('ellipsisd'); 
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
            $('div #usp_type').val(data['usp_type']);
            $('div #packing').val(data['packing']);
            $('div #brand').val(data['brand']);
            $('div #select_category').val(data['category']);
            $('div #principal').val(data['principal']);
            $('#editForm').attr('action', '/edit-usp/'+data['id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-usp/'+data['id']);
            $('#deleteModal').modal('show');  
        });
    
    });
</script>
@endsection

<!-- Add records-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Add Usp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="{{route('store_usp')}}" method="post">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Usp Type</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" placeholder="Type" name="usp_type"  value="{{old('usp_type')}}"  class="form-control">
                                @if ($errors->has('usp_type'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('usp_type') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Packing</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea placeholder="Packing details . . . " name="packing"  class="form-control"></textarea>
                                @if ($errors->has('packing'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('packing') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Brand</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" placeholder="Brand" name="brand"  class="form-control">
                                @if ($errors->has('brand'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('brand') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                           

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Category</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="select_category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="HPCL Columns">HPCL Columns</option>
                                    <option value="GC Capillary Column">GC Capillary Column</option>
                                </select>
                                @if ($errors->has('select_category'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('select_category') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Principal</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" placeholder="Principal" name="principal"  class="form-control">
                                @if ($errors->has('principal'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('principal') }}
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
    </div>
</div>
<!-- end modal large -->

<!-- update records -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Update Usp</h5>
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
                                <label for="file-input" class=" form-control-label required">Usp Type</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="usp_type" placeholder="Name" name="update_usp_type"  class="form-control">
                                @if ($errors->has('update_usp_type'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('update_usp_type') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Packing</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea id="packing" placeholder="packing . . . " name="update_packing"  class="form-control"></textarea>
                                @if ($errors->has('update_packing'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('update_packing') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Brand</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="brand" placeholder="Name" name="update_brand"  class="form-control">
                                @if ($errors->has('update_brand'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('update_brand') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                           

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Category</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="update_select_category" id="select_category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="HPLC Columns">HPCL Columns</option>
                                    <option value="GC Capillary Column">GC Capillary Column</option>
                                </select>
                                @if ($errors->has('update_select_category'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('update_select_category') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label required">Principal</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="principal" placeholder="Principal" name="update_principal"  class="form-control">
                                @if ($errors->has('update_principal'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('update_principal') }}
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
    </div>
</div>
<!-- end modal large -->


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