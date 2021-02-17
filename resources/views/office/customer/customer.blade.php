@extends('theme.layout.base_layout')
@section('title', 'Customer')
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
    <div class="col-md-12">
        @if (session()->has('message'))
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h3 class="title-5 m-b-35">Customers</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">View Branch Wise</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">View Region Wise</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>

                <div class="rs-select2--light rs-select2--md">
                    <button class="au-btn-filter">
                        <i class="zmdi zmdi-filter-list"></i>filters
                    </button>
                </div>
            
            </div>
            <div class="table-data__tool-right">
                <input type="file" class="au-btn-filter">
                <button class="au-btn-filter">
                        <i class="zmdi zmdi-upload"></i> Upload
                </button>
            </div>

            <div class="table-data__tool-right">
                <button class="au-btn-filter mb-1" data-toggle="modal" data-target="#largeModal">
                        <i class="zmdi zmdi-plus"></i> Add Customer
                    </button>
            </div>
        </div>

       
    </div>
    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
            <table id="customer" class="table table-borderless table-striped table-earning">
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        table = $('#customer').DataTable({
                processing: true,
                orderCellsTop: true,
                fixedHeader: true,
                sort : true,
                scrollX: true,
                ajax: {
                    url:'{{ route("get_customer") }}',
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
                    { data: 'st_cust_fname', title : 'GST'},
                    { data: 'st_com_name', title : 'Company'},
                    { data: 'st_cust_city', title : 'City'},
                    { data: 'st_cust_state', title : 'State'},
                    { data: 'st_regions', title : 'Region'},
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
                <h5 class="modal-title" id="largeModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="{{route('store_customer')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="customer_name" name="customer_name"placeholder="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_last_name" name="customer_last_name"placeholder="Last name" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea type="text" id="customer_address" name="customer_address"placeholder="Address . . . !" class="form-control"></textarea>
                            
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_region" name="customer_region" placeholder="region" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="customer_mobile" name="customer_mobile" placeholder="Mobile" class="form-control">
                        </div>
        
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_city" name= "customer_city" placeholder="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_state" name="customer_state" placeholder="State city" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_pincode" name="customer_pincode" placeholder="Pin Code" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="customer_contry" name="customer_contry" placeholder="Country" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="persion1_name" name="persion1_name"placeholder="Person 1 name" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion1_email" name= "persion1_email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion1_mobile" name="persion1_mobile" placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="persion2_name" name="persion2_name"placeholder="Person 2 name" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion2_email" name= "persion1_email" placeholder="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" id="persion2_mobile" name="persion1_mobile" placeholder="Mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="branch_name" name="branch_name"placeholder="Branch name" class="form-control">
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