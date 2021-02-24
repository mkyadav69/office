@extends('theme.layout.base_layout')
@section('title', 'Add Product')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
</style>
<!-- add records -->
    <div class="col col-md-12">
        @if (session()->has('message'))
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Add Product</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('store_product')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="form-group col-2">
                            <label for="company" class="form-control-label required">Part No.</label>
                            <input type="text" id="st_part_No" required name="st_part_No"placeholder="Part No." class="form-control">
                            @if ($errors->has('st_part_No'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('st_part_No') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">HSN No.</label>
                            <input type="text" id="stn_hsn_no" required name="stn_hsn_no" placeholder="HSN No." class="form-control">
                            @if ($errors->has('stn_hsn_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('stn_hsn_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Principals</label>
                            <select id="principal_id" required name="principal_id" class="form-control">
                                <option value="">Select Principals</option>
                                @if(!empty($principal))
                                    @foreach($principal as $id=>$p_name)
                                        <option value="{{$p_name.'_'.$id}}">{{$p_name}}</option>
                                    @endforeach
                                @else
                                    <p>No principal are available.</p>
                                @endif
                            </select>
                            @if ($errors->has('principal_id'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('principal_id') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Category</label>
                            <select id="in_cat_id" required name="in_cat_id" class="form-control">
                                <option value="">Select Category</option>
                                @if(!empty($category))
                                    @foreach($category as $c_name=>$prod_field)
                                        <option value="{{$c_name}}">{{$c_name}}</option>
                                    @endforeach
                                @else
                                    <p>No categories are available.</p>
                                @endif
                            </select>
                            @if ($errors->has('in_cat_id'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('in_cat_id') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Brand</label>
                            <select id="stn_brand" required name="stn_brand" class="form-control">
                                <option value="">Select Brand</option>
                                @if(!empty($brand))
                                    @foreach($brand as $b_name)
                                        <option value="{{$b_name}}">{{$b_name}}</option>
                                    @endforeach
                                @else
                                    <p>No categories are available.</p>
                                @endif
                            </select>
                            @if ($errors->has('select_brand'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('select_brand') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Price</label>
                            <input type="text" id="fl_pro_price" required name="fl_pro_price" placeholder="Price" class="form-control">
                            @if ($errors->has('fl_pro_price'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('fl_pro_price') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group" id="cat">
                        
                    </div>
                    <div class="row form-group">
                        <div class="form-group col-2">
                            <label for="vat" class="form-control-label required">IGST Rate</label>
                            <input type="text" id="str_igst_rate" required name="str_igst_rate" placeholder="IGST Rate" class="form-control">
                            @if ($errors->has('str_igst_rate'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('str_igst_rate') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class="form-control-label required">Discount</label>
                            <input type="text" id="discount" required name="in_pro_disc" placeholder="%" class="form-control">
                            @if ($errors->has('in_pro_disc'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('in_pro_disc') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class="form-control-label required">Qty</label>
                            <input type="text" id="qty"  required name="in_pro_qty"  placeholder="Qty" class="form-control">
                            @if ($errors->has('in_pro_qty'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('in_pro_qty') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-3">
                            <label for="vat" class=" form-control-label required">Product Image</label>
                            <input type="file" name="st_img_path" class="form-control-file">
                            @if ($errors->has('st_img_path'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('st_img_path') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="company" class="form-control-label required">Description</label>
                            <textarea type="text" id="st_pro_desc" required name="st_pro_desc" placeholder="Write here . . ." class="form-control"></textarea>
                            @if ($errors->has('st_pro_desc'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('st_pro_desc') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            <label for="vat" class="form-control-label required">Additional Description</label>
                            <textarea type="text" id="extra_desc" required name="extra_desc" placeholder="Write here . . ." class="form-control"></textarea>
                            @if ($errors->has('extra_desc'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('extra_desc') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{route('show_product')}}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- end add record -->
<script>
    $(document).ready(function(){
        $('#in_cat_id').on('change', function(){
            var c_name = $('#in_cat_id').val();
            var product_field = {!! json_encode($category) !!};
            var param_list = product_field[c_name];
            if (param_list != null && param_list != ''){
                var param_array = param_list.split(',');
                $.each(param_array, function (key, field) {
                    console.log("lll");
                    console.log(field);
                   var col = '<div class="form-group col-2 field"><label for="vat" class="form-control-label" style="color: green">'+field+'</label><input type="text" id="hsn_no" name="'+field+'" placeholder="'+field+'" class="form-control"></div></div>';
                   $('#cat').append(col);
                });
            }else{
                $('.field').remove();
            }
        });
    });
</script>
@endsection