@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Role
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
                    <h3 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Add New Role
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="portlet-body">
                    <!--main content-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('save.role') }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                               
                                <section>
                                
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-1 control-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Request::old('name') }}}" />
                                            @if ($errors->has('name'))
		                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                    <label for="last_name" class="col-sm-1 control-label">Display Name<span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="display_name" name="display_name" type="text" placeholder="Display Name" class="form-control required" value="{{{ Request::old('display_name') }}}" />
                                            @if ($errors->has('display_name'))
		                                        <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email" class="col-sm-1 control-label">Description <span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control form-control-sm" placeholder="Write description ...." id="desc"   name="description" rows="4">{{ Request::old('description') }}</textarea>
                                            @if ($errors->has('description'))
		                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-1 control-label">Add Permissions<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                        @if ($errors->has('permission'))
		                                        <span class="text-danger">{{ $errors->first('permission') }}</span>
                                            @endif
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer cell-border row-border compact sticky-header tableheader-processed sticky-table div2 persist-area" style="width:100px" id="order_table" role="grid" >
                                                <thead>
                                                <tr class="capitalize persist-header">
                                                        <th style="text-align:left; width:100%"><strong>Master</strong></th>
                                                        <th style="text-align:left;color:green; width:100%">View</th>
                                                        <th style="text-align:left;color:blue; width:100%">Edit</th>
                                                        <th style="text-align:left;color:red; width:100%">Delete</th>
                                                        <th style="text-align:left;color:purple; width:100%">Add/Upload</th>
                                                        <th style="text-align:left;color:brown; width:100%">Download</th>
                                                    </tr>
                                                <thead>
                                                <tbody>
                                                @if(!empty($per_arr))
                                                        @foreach( $per_arr as $modl_name=>$permsn)
                                                            <tr>
                                                                <td><strong>{{ ucfirst(str_replace('_',' ' , $modl_name))  }}</strong></td>
                                                               
                                                                @foreach($order as $key=>$per)
                                                                   
                                                                    <td>
                                                                    @if (!empty($permsn[$key]))
                                                                        <input type="checkbox" name="permission[{{ $modl_name }}][]" value="{{ $permsn[$key] }}" {{ (is_array(old('permission')) and in_array($permsn[$key], old('permission.'.$modl_name, []))) ? ' checked' : '' }}/>
                                                                    @else
                                                                        <input type="checkbox" disabled name="" value="" style="text-align:center; vertical-align: middle;">
                                                                    @endif
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
                                      <div class="col-sm-5" >
                                        <button id="submit"style="width:120px"  class="btn btn-primary">Submit</button>
                                      </div>
                                    </div>
                                    <p>(<span class="text-danger">*</span>) Mandatory</p>
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
 $(window).on('scroll', function(){
  var pos = $('#mCSB_1_scrollbar_horizontal').position();
  var offset = $('#mCSB_1').offset();
  var scroll = $(window).scrollTop();
  
  if(typeof offset !== "undefined" && offset.hasOwnProperty('top') && offset.top < scroll){
      $("#mCSB_1_scrollbar_horizontal").css({top: (scroll - offset.top)+35, left: pos.left, position:'absolute'});
  }
  else if(typeof pos !== "undefined" && pos.hasOwnProperty('left')){
      $("#mCSB_1_scrollbar_horizontal").css({top: 0, left: pos.left, position:'absolute'});
  }
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