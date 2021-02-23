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
<!-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true"> -->
    <div class="col col-md-12">
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
                            <input type="text" id="part_no" required name="part_no"placeholder="Part No." class="form-control">
                            @if ($errors->has('part_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('part_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">HSN No.</label>
                            <input type="text" id="hsn_no" required name="hsn_no" placeholder="HSN No." class="form-control">
                            @if ($errors->has('hsn_no'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('hsn_no') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Primcipals</label>
                            <select id="select_principal" required name="select_principal" class="form-control">
                                <option value="">Select Principals</option>
                                @if(!empty($principal))
                                    @foreach($principal as $p_name)
                                        <option value="{{$p_name}}">{{$p_name}}</option>
                                    @endforeach
                                @else
                                    <p>No principal are available.</p>
                                @endif
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

                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Category</label>
                            <select id="select_category" required name="select_category" class="form-control">
                                <option value="">Select Category</option>
                                @if(!empty($category))
                                    @foreach($category as $c_name=>$prod_field)
                                        <option value="{{$c_name}}">{{$c_name}}</option>
                                    @endforeach
                                @else
                                    <p>No categories are available.</p>
                                @endif
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

                        <div class="form-group col-2">
                            <label for="vat" class=" form-control-label required">Brand</label>
                            <select id="select_brand" required name="select_brand" class="form-control">
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
                            <input type="text" id="price" required name="price" placeholder="Price" class="form-control">
                            @if ($errors->has('price'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('price') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="form-group col-2">
                            <label for="vat" class="form-control-label required">IGST Rate</label>
                            <input type="text" id="igst" required name="igst" placeholder="IGST Rate" class="form-control">
                            @if ($errors->has('igst'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('igst') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class="form-control-label required">Discount</label>
                            <input type="text" id="discount" required name="discount" placeholder="%" class="form-control">
                            @if ($errors->has('discount'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('discount') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-2">
                            <label for="vat" class="form-control-label required">Qty</label>
                            <input type="text" id="qty"  required name="qty"  placeholder="Qty" class="form-control">
                            @if ($errors->has('qty'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('qty') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-3">
                            <label for="vat" class=" form-control-label required">Product Image</label>
                            <input type="file" name="principal_image" required class="form-control-file">
                            @if ($errors->has('principal_image'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('principal_image') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="company" class="form-control-label required">Description</label>
                            <textarea type="text" id="decription" required name="decription" placeholder="Write here . . ." class="form-control"></textarea>
                            @if ($errors->has('decription'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('decription') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            <label for="vat" class="form-control-label required">Additional Description</label>
                            <textarea type="text" id="add_decription" required name="add_decription" placeholder="Write here . . ." class="form-control"></textarea>
                            @if ($errors->has('add_decription'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('add_decription') }}
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
        $('#select_category').on('change', function(){
            var c_name = $('#select_category').val();
            var product_field = {!! json_encode($category) !!};
            var param_list = product_field[c_name];
            if (param_list != null){
                var param_array = param_list.split(',');
                $.each(param_array, function (key, field) {
                   // here
                });
            }
        });
    });
</script>
@endsection