@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Role
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
 <link rel="stylesheet" href="{{ asset('assets/drop/mulselect/dist/css/bootstrap-multiselect.css') }}">
@stop
{{-- Page content --}}
@section('content')
<style>
.floatingHeader {
  position: fixed;
  top: 0;
  visibility: hidden;
}
table td, table th {
    padding: 10px 5px !important;
    min-width: 214px !important;
    max-width: 200px;
    border-collapse: collapse;
}
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box default">
                <div class="portlet-title">
                    <h2 class="panel-title"> <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit Role
                    </h2>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="portlet-body">

                    <!--main content-->
                    <div class="row">

                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('update.role',$edit_role->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                               
                                <section>
                                @if (!empty($edit_role))
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-1 control-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="name" name="name" type="text" readonly placeholder="Name" class="form-control required" value="{{{ Request::old('name',$edit_role->name) }}}" />
                                            @if ($errors->has('name'))
		                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-1 control-label">Display Name<span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="display_name" name="display_name" type="text" readonly placeholder="Display Name" class="form-control required" value="{{{ Request::old('display_name',$edit_role->display_name) }}}" />
                                            @if ($errors->has('display_name'))
		                                        <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="email" class="col-sm-1 control-label">Description<span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control form-control-sm" placeholder="Write description ...." id="desc" name="description" rows="4">{{ $edit_role->description  }}</textarea>
                                            @if ($errors->has('description'))
		                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-1 control-label">Update Permissions<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            @if ($errors->has('permission'))
		                                        <span class="text-danger">{{ $errors->first('permission') }}</span>
                                            @endif
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer cell-border row-border compact sticky-header tableheader-processed sticky-table div2 persist-area"  style="width:100px" id="order_table" role="grid" >
                                                <thead>
                                                <tr class="capitalize persist-header">
                                                        <th style="text-align:left;width:100%"><strong>Master</strong></th>
                                                        <th style="text-align:left;color:green;">View</th>
                                                        <th style="text-align:left;color:blue;">Edit</th>
                                                        <th style="text-align:left;color:red;">Delete</th>
                                                        <th style="text-align:left;color:purple;">Add/Upload</th>
                                                        <th style="text-align:left;color:brown;">Download</th>
                                                    </tr>
                                                <thead>
                                                <tbody>
                                                
                                                    @if(!empty($per_data))
                                                        @foreach($per_data as $identifier=>$permi_data)
                                                            <tr>
                                                                @if($identifier == 'regx_tag_option_groups')
                                                                    <td><strong>UMO Tags</strong></td>
                                                                @elseif($identifier == 'made_in_usa')
                                                                    <td><strong>US Allowed Suppliers</strong></td>
                                                                @else
                                                                    <td><strong>{{ ucfirst(str_replace('_',' ' , $identifier))  }}</strong></td>
                                                                @endif

                                                                @foreach($order as $key)
                                                                    <td>
                                                                        @isset($permi_data[$key])
                                                                            @isset($user_role_list[$identifier])
                                                                                @if(in_array($permi_data[$key] , $user_role_list[$identifier]))
                                                                                <input type="checkbox" checked name="permission[{{ $identifier }}][]" value="{{ $permi_data[$key] }}" style="text-align:center; vertical-align: middle;">
                                                                                @else
                                                                                    <input type="checkbox" name="permission[{{ $identifier }}][]" value="{{ $permi_data[$key] }}" {{ (is_array(old('permission')) and in_array($permi_data[$key], old('permission.'.$identifier, []))) ? ' checked' : '' }} style="text-align:center; vertical-align: middle;">
                                                                                @endif
                                                                            @else
                                                                                <input type="checkbox" name="permission[{{ $identifier }}][]" value="{{ $permi_data[$key] }}" {{ (is_array(old('permission')) and in_array($permi_data[$key], old('permission.'.$identifier, []))) ? ' checked' : '' }} style="text-align:center; vertical-align: middle;">
                                                                            @endisset
                                                                        @else
                                                                            <input type="checkbox" disabled name="" value="" style="text-align:center; vertical-align: middle;">  
                                                                        @endisset
                                                                        
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                           
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-1 control-label" for="submit"></label>
                                      <div class="col-sm-5">
                                      <button id="submit" class="btn btn-primary" style="width:115px">Submit</button>
                                      </div>
                                    </div>
                                    <p>(<span class="text-danger">*</span>) Mandatory</p>
                                @endif
                                </section>                               

                            
                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION --> 
                        </div>
                    </div>
                    <!--main content end--> 
                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

@section('footer_scripts')
<script src="{{ asset('assets/drop/mulselect/dist/js/bootstrap-multiselect.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#permission').multiselect();
    });
</script>
<script>
function UpdateTableHeaders() {
  $(".persist-area").each(function() {
    var el = $(this),
      offset = el.offset(),
      scrollTop = $(window).scrollTop(),
      floatingHeader = $(".floatingHeader", this);

    if (scrollTop > offset.top && scrollTop < offset.top + el.height()) {
      floatingHeader.css({
        visibility: "visible"
      });
    } else {
      floatingHeader.css({
        visibility: "hidden"
      });
    }
  });
}

$(function() {
  var clonedHeaderRow;
  $(".persist-area").each(function() {
    clonedHeaderRow = $(".persist-header", this);
    console.log(clonedHeaderRow);
    clonedHeaderRow
      .before(clonedHeaderRow.clone())
      .css("width", clonedHeaderRow.width())
      .addClass("floatingHeader");
  });

  $(window)
    .scroll(UpdateTableHeaders)
    .trigger("scroll");
});
</script>
@stop