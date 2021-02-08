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
                    url:'{{ route("show_quatation") }}',
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
                    { data: 'owner_name', title : 'Owner Name'},
                    { data: 'owner_desc', title : 'Description'},
                    { data: 'dt_created', title : 'Date'},
                ],                            
        });
    });
</script>
@endsection
<!-- modal large -->
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
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="company" class="form-control-label required"> Add Billing Address</label>
                            <textarea type="text" id="company" placeholder="Address . . . !" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="vat" class=" form-control-label required"> Add Branch Address</label>
                            <textarea type="text" id="company" placeholder="Branch . . . !" class="form-control"></textarea>
                         </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required"> Billing Note</label>
                            <textarea type="text" id="company" placeholder="Notes . . . !" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city" class=" form-control-label required"> Select Branch</label>
                            <select name="select" id="select" class="form-control">
                                <option value="">Select Principals</option>
                                <option value="authorized">Authorized</option>
                                <option value="dealers">Dealers</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Add Tin No.</label>
                            <input type="text" id="company" placeholder="Tin No. . . . !" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Mobile No. </label>
                            <input type="text" id="company" placeholder="Mobile No. . . . !" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="street" class=" form-control-label required">Email Address</label>
                            <input type="text" id="company" placeholder="Email address . . . !" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal large -->