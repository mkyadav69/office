@extends('theme.layout.base_layout')
@section('title', 'Dashboard')
@section('content')
<style>
.form-inline label {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    margin-top: -86px;
}
table.dataTable {
    clear:both;
    margin-top:77px !important;
    margin-bottom:6px !important;
    max-width:none !important;
    border-collapse:separate !important
}

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
        <h3 class="title-5 m-b-35">Manage Usp</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#largeModal">
                        <i class="zmdi zmdi-plus"></i> Add Usp
                    </button>
            </div>
        </div>
    </div>
    <div class="table-responsive table--no-card m-b-30">
        <table id="usp" class="table table-borderless table-striped table-earning">
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
                { data: 'category', title : 'Category'},
                { data: 'usp_type', title : 'Usp Type'},
                { data: 'packing', title : 'Packing'},
                { data: 'brand', title : 'Brand'},
                { data: 'principal', title : 'Principal'},
                {
                        'data': null,
                        'render': function (data, type, row) {
                            return '<button row-id="' + row.id + '" class="btn btn-primary edit">Edit</button> <button row-id="' + row.id + '" class="btn btn-danger delete">Delete</button>'
                        }, title: 'Actions'
                }
            ],                            
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
            $('div #select_principal').val(data['principal']);
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
                                <input type="text" id="usp_type" placeholder="Type" name="usp_type"  value="{{old('usp_type')}}"  class="form-control">
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
                                <textarea id="packing" placeholder="Packing details . . . " name="packing"  class="form-control"></textarea>
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
                                <input type="text" id="brand" placeholder="Brand" name="brand"  class="form-control">
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
                                <select name="select_category" id="select" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="hpcl_columns">HPCL Columns</option>
                                    <option value="gc_capillary_column">GC Capillary Column</option>
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
                            <div class="col-12 col-md-6">
                                <select name="select_principal" id="select_principal" class="form-control">
                                    <option value="">Select Principal</option>
                                    <option value="pending_order">Pending Order</option>
                                    <option value="pending_shipment">Pending Shipment</option>
                                </select>
                                @if ($errors->has('select_principal'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('select_principal') }}
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
                <h5 class="modal-title" id="largeModalLabel">Edit Usp</h5>
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
                                <input type="text" id="usp_type" placeholder="Name" name="usp_type"  class="form-control">
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
                                <textarea id="packing" placeholder="packing . . . " name="packing"  class="form-control"></textarea>
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
                                <input type="text" id="brand" placeholder="Name" name="brand"  class="form-control">
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
                                <select name="select_category" id="select_category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="hpcl_columns">HPCL Columns</option>
                                    <option value="gc_capillary_column">GC Capillary Column</option>
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
                            <div class="col-12 col-md-6">
                                <select name="select_principal" id="select_principal" class="form-control">
                                    <option value="">Select Principal</option>
                                    <option value="pending_order">Pending Order</option>
                                    <option value="pending_shipment">Pending Shipment</option>
                                </select>
                                @if ($errors->has('select_principal'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('select_principal') }}
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