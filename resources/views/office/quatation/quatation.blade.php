@extends('theme.layout.base_layout')
@section('title', 'Quatation')
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
        <h3 class="title-5 m-b-35">Quatations</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#largeModal">
                        <i class="zmdi zmdi-plus"></i> Add Quatation
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive table--no-card m-b-30">
        <table id="quatation" class="table table-borderless table-striped table-earning">
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
        table = $('#quatation').DataTable({
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
                    url:'{{ route("get_quatation") }}',
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
                    { data: 'stn_bill_add', title : 'Billing Address'},
                    { data: 'stn_branch_add', title : 'Branch Address'},
                    { data: 'stn_tin_no', title : 'Tin Number'},
                    { data: 'int_branch_id', title : 'Branch Name'},
                    { data: 'dt_created', title : 'Created At'},
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

            $('div #billing_address').val(data['stn_bill_add']);
            $('div #branch_address').val(data['stn_branch_add']);
            $('div #billing_notes').val(data['stn_billing_note']);
            $('div #add_tin').val(data['stn_tin_no']);
            $('div #email_address').val(data['str_branch_email']);
            $('div #mobile_no').val(data['str_branch_phnumber']);
            $('div #select_branch').val(data['int_branch_id']);

            $('#editForm').attr('action', '/edit-quatation/'+data['int_quotformat_id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-quatation/'+data['int_quotformat_id']);
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

<!-- add record -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Add Quatations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form  action="{{route('store_quatation')}}"method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="company" class="form-control-label required"> Add Billing Address</label>
                                <textarea type="text" id="billing_address" name="billing_address" placeholder="address . . . " class="form-control"></textarea>
                                @if ($errors->has('billing_address'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('billing_address') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label required"> Add Branch Address</label>
                                <textarea type="text" id="branch_address" name="branch_address" placeholder="branch . . . " class="form-control"></textarea>
                                @if ($errors->has('branch_address'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('branch_address') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required"> Billing Note</label>
                                <textarea type="text" id="billing_notes" name="billing_notes" placeholder="notes . . . " class="form-control"></textarea>
                                @if ($errors->has('billing_notes'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('billing_notes') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="city" class=" form-control-label required"> Select Branch</label>
                                <select id="select_branch" name="select_branch" class="form-control">
                                    <option value="">Select Branch</option>
                                    @if(!empty($branch_wise))
                                        @foreach($branch_wise as $id=>$name)
                                        <option value="{{ $id }}">{{ $name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No branch found</option>
                                    @endif
                                </select>
                                @if ($errors->has('select_branch'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('select_branch') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required">Add Tin No.</label>
                                <input type="text" id="add_tin" name="add_tin" placeholder="tin No. . . . " class="form-control">
                                @if ($errors->has('add_tin'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('add_tin') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required">Mobile No. </label>
                                <input type="text" id="mobile_no" name="mobile_no" placeholder="mobile No. . . . " class="form-control">
                                @if ($errors->has('mobile_no'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('mobile_no') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required">Email Address</label>
                                <input type="text" id="email_address" name="email_address" placeholder="email address . . . !" class="form-control">
                                @if ($errors->has('email_address'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('email_address') }}
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal large -->

<!-- edit record -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Update Quatations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form method="post" id="editForm">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="company" class="form-control-label required"> Add Billing Address</label>
                                <textarea type="text" id="billing_address" name="billing_address" placeholder="address . . . " class="form-control"></textarea>
                                @if ($errors->has('billing_address'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('billing_address') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label required"> Add Branch Address</label>
                                <textarea type="text" id="branch_address" name="branch_address" placeholder="branch . . . " class="form-control"></textarea>
                                @if ($errors->has('branch_address'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('branch_address') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required"> Billing Note</label>
                                <textarea type="text" id="billing_notes" name="billing_notes" placeholder="notes . . . " class="form-control"></textarea>
                                @if ($errors->has('billing_notes'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('billing_notes') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="city" class=" form-control-label required"> Select Branch</label>
                                <select name="select_branch" id="select_branch" name="select_branch" class="form-control">
                                    <option value="">Select Branch</option>
                                    @if(!empty($branch_wise))
                                        @foreach($branch_wise as $id=>$name)
                                        <option value="{{ $id }}">{{ $name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No branch found</option>
                                    @endif
                                </select>
                                @if ($errors->has('select_branch'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('select_branch') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required">Add Tin No.</label>
                                <input type="text" id="add_tin" name="add_tin" placeholder="tin No. . . . " class="form-control">
                                @if ($errors->has('add_tin'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('add_tin') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required">Mobile No. </label>
                                <input type="text" id="mobile_no" name="mobile_no" placeholder="mobile No. . . . " class="form-control">
                                @if ($errors->has('mobile_no'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('mobile_no') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label required">Email Address</label>
                                <input type="text" id="email_address" name="email_address" placeholder="email address . . . !" class="form-control">
                                @if ($errors->has('email_address'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{ $errors->first('email_address') }}
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