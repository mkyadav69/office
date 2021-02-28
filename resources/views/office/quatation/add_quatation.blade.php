@extends('theme.layout.base_layout')
@section('title', 'Add Quatation')
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
                <h5 class="modal-title" id="largeModalLabel">Add Quatation</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('store_product')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="form-group col-4">
                            <label for="company" class="form-control-label required">Quatation Prepared By </label>
                            <input type="text" id="st_part_No" required name="st_part_No"placeholder="Quatation Prepared By" class="form-control">
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
                        <div class="form-group col-4">
                            <label for="vat" class=" form-control-label required">Lead From</label>
                            <input type="text" id="stn_hsn_no" required name="stn_hsn_no" placeholder="Lead From" class="form-control">
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
                        
                        <div class="form-group col-4">
                            <label for="vat" class=" form-control-label required">Notify Group</label>
                            <select id="principal_id" required name="principal_id" class="form-control">
                                <option value="">Select Notify Group</option>
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
                    </div>

                    <div class="modal-footer">
                        <a href="{{route('show_quatation')}}">
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
    
</script>
@endsection