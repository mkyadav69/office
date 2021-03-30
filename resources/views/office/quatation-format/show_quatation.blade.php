@extends('theme.layout.base_layout')
@section('title', 'Quotation Format')
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
    @if (session()->has('message_error'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{ session('message_error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">Manage Quatations</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                @permission('add_quatation')
                    <button class="au-btn-filter mb-1 add_modal" data-toggle="modal" data-target="#addModal">
                        <i class="zmdi zmdi-plus"></i> Add Quatation
                    </button>
                @endpermission
            </div>
        </div>
    </div> 
    
    <div class="table-responsive table--no-card m-b-30">
        <table id="quatation" class="table table-borderless table-striped table-earning" style="width:100%">
        </table>
    </div>
    
</div>
@if(Session::has('errors'))
    @if(!empty($errors->quatation_add->any()))
        <script>
            $(document).ready(function(){
                $('#addModal').modal({show: true});
            });
        </script>
    @endif
@endif  

@if(Session::has('errors'))
    @if($errors->quatation_update->any()))
        <script>
            $('#editModal').modal('show');  
        </script>
    @endif
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
                    url:'{{ route("get_quatation_format") }}',
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
                    {   data: 'stn_bill_add', 
                        name:'stn_bill_add',
                        title : 'Billing Address', 
                        className: "text td_ellipsis td-limit "
                    },
                    { data: 'stn_branch_add', title : 'Branch Address', className: "text td_ellipsis td-limit "},
                    { data: 'stn_tin_no', title : 'Tin Number', className: "text td_ellipsis td-limit "},
                    { data: 'int_branch_id', title : 'Branch Name', className: "text td_ellipsis td-limit "},
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
            // drawCallback: function( settings ) {
            //     alert("uuu");
            //         $('td.td_ellipsis').css('text-overflow', 'ellipsis');
            //         $('td.td_ellipsis').css('overflow', 'hidden');
            //         $('td.td_ellipsis').css(' white-space', 'nowrap');
            //         $('td.td_ellipsis').addClass('ellipsisd'); 
            //         $('td.td_ellipsis').unbind('click');
            //         $('td.date').addClass('date_format');
            //         $('td.td_ellipsis').click(function(){
            //             if($(this).hasClass('ellipsisd')){
            //                 alert("ll");
            //                 $(this).removeAttr('style');
            //                 $(this).removeClass('ellipsisd'); 
            //             }else{
            //                 alert("kk");
            //                 $(this).css('text-overflow', 'ellipsis');
            //                 $(this).css('overflow', 'hidden');
            //                 $(this).css('white-space', 'nowrap'); 
            //                 $(this).addClass('ellipsisd'); 
            //             }
            //         });
            // }                                                  
        });
        
        table.on('click', '.edit', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);
            var branch_wise = {!! json_encode($swipe_branch) !!};
            $('div #billing_address').val(data['stn_bill_add']);
            $('div #branch_address').val(data['stn_branch_add']);
            $('div #billing_notes').val(data['stn_billing_note']);
            $('div #add_tin').val(data['stn_tin_no']);
            $('div #email_address').val(data['str_branch_email']);
            $('div #mobile_no').val(data['str_branch_phnumber']);
            if(branch_wise != ''){
                $('div #select_branch').val(branch_wise[data['int_branch_id']]);
            }else{
                $('div #select_branch').val('');
            }

            $('#editForm').attr('action', '/edit-quatation-format/'+data['int_quotformat_id']);
            $('#editModal').modal('show');  
        });

        table.on('click', '.delete', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            $('#deleteForm').attr('action', '/delete-quatation-format/'+data['int_quotformat_id']);
            $('#deleteModal').modal('show');  
        });
    });
</script>
@endsection

@section('addModal')
<!-- add record -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Quatations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form  action="{{route('store_quatation_format')}}"method="post">
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="company" class="form-control-label required"> Add Billing Address</label>
                            <textarea type="text" name="billing_address" placeholder="address . . . " required class="form-control">{{old('billing_address')}}</textarea>
                            @if ($errors->quatation_add->has('billing_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('billing_address') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="vat" class=" form-control-label required"> Add Branch Address</label>
                            <textarea type="text" name="branch_address" placeholder="branch . . . " required class="form-control">{{old('branch_address')}}</textarea>
                            @if ($errors->quatation_add->has('branch_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('branch_address') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required"> Billing Note</label>
                            <textarea type="text"  name="billing_notes" placeholder="notes . . . " required class="form-control">{{old('billing_notes')}}</textarea>
                            @if ($errors->quatation_add->has('billing_notes'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('billing_notes') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="city" class=" form-control-label required"> Select Branch</label>
                            <select name="select_branch" required class="form-control">
                                <option value="">Select Branch</option>
                                @if(!empty($branch_wise))
                                    @foreach($branch_wise as $id=>$name)
                                        <option value="{{ $id.'_'.$name }}" {{ old('select_branch') == $id ? "selected" : "" }}>{{ $name}}</option>
                                    @endforeach
                                @else
                                    <option value="">No branch found</option>
                                @endif
                            </select>
                            @if ($errors->quatation_add->has('select_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('select_branch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Add Tin No.</label>
                            <input type="text" name="add_tin" value="{{old('add_tin')}}" placeholder="tin No. . . . " required class="form-control">
                            @if ($errors->quatation_add->has('add_tin'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('add_tin') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="street" class="form-control-label required">Mobile No. </label>
                            <input type="text"  name="mobile_no" value="{{old('mobile_no')}}" required placeholder="mobile No. . . . " maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">
                            @if ($errors->quatation_add->has('mobile_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('mobile_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Email Address</label>
                            <input type="text" name="email_address" value="{{old('email_address')}}" required placeholder="email address . . . !" class="form-control">
                            @if ($errors->quatation_add->has('email_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_add->first('email_address') }}
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
<!-- end add -->
@endsection

@section('editModal')
<!-- edit record -->
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
                            <textarea type="text" id="billing_address" name="update_billing_address" required placeholder="address . . . " class="form-control">{{old('update_billing_address')}}</textarea>
                            @if ($errors->quatation_update->has('update_billing_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_update->first('update_billing_address') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="vat" class=" form-control-label required"> Add Branch Address</label>
                            <textarea type="text" id="branch_address" name="update_branch_address" required placeholder="branch . . . " class="form-control">{{old('update_branch_address')}}</textarea>
                            @if ($errors->quatation_update->has('update_branch_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_update->first('update_branch_address') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required"> Billing Note</label>
                            <textarea type="text" id="billing_notes" name="update_billing_notes" required placeholder="notes . . . " class="form-control">{{old('update_billing_notes')}}</textarea>
                            @if ($errors->quatation_update->has('update_billing_notes'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_update->first('update_billing_notes') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="city" class=" form-control-label required"> Select Branch</label>
                            <select id="select_branch" name="update_select_branch" required class="form-control">
                                <option value="">Select Branch</option>
                                @if(!empty($branch_wise))
                                    @foreach($branch_wise as $id=>$name)
                                        <option value="{{ $id }}" { old('select_mode') == $id ? "selected" : "" }}>{{ $name}}</option>
                                    @endforeach
                                @else
                                    <option value="">No branch found</option>
                                @endif
                            </select>
                            @if ($errors->quatation_update->has('update_select_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_select_branch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Add Tin No.</label>
                            <input type="text" id="add_tin" name="update_add_tin" value="{{old('update_add_tin')}}" required placeholder="tin No. . . . " class="form-control">
                            @if ($errors->quatation_update->has('update_add_tin'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_update->first('update_add_tin') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Mobile No. </label>
                            <input type="text" id="mobile_no" name="update_mobile_no" required value="{{old('update_mobile_no')}}" placeholder="mobile No. . . . " class="form-control">
                            @if ($errors->quatation_update->has('update_mobile_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_update->first('update_mobile_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Email Address</label>
                            <input type="text" id="email_address" name="update_email_address" required value="{{old('update_email_address')}}" placeholder="email address . . . !" class="form-control">
                            @if ($errors->quatation_update->has('update_email_address'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->quatation_update->first('update_email_address') }}
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
<!-- end edit -->
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