@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add User
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<!--end of page level css-->
@stop

@section('content')
<style type="text/css">

hr {
  border-top: 1px solid black;
}

</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
             <div class="portlet box default">
                <div class="portlet-title">
                    <h3 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Generate New Api
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
                            <form class="form-wizard form-horizontal" action="{{ route('save.token',$id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <section>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                        <label for="last_name" class="col-sm-2 control-label">Token/Api :</label>
                                        @if(\Session::get('data'))
                                            <label for="last_name" class="col-sm-2 control-label">{{ \Session::get('data')}}</label>
                                        @else
                                            <label for="last_name" class="col-sm-3 control-label"><b><hr></b></label>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        @if (!empty($token))
                                            
                                            <label class="col-sm-1 control-label" for="submit"></label>
                                            <div class="col-sm-5">
                                                <button id="submit" name="re_gen" value= "re_gen_value"  style="width:120px" class="btn btn-success">Re-generate</button>
                                            </div>
                                        
                                        @else
                                            <label class="col-sm-1 control-label" for="submit"></label>
                                            <div class="col-sm-5">
                                                <button id="submit" name="generate" value= "generate_value" class="btn btn-success">Generate</button>
                                            </div>
                                        
                                        @endif
                                        <input type="hidden" name="tok" value="{{ $token }}">
                                    </div>
                                    
                                
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-1 control-label">Expriy date:<span class="star text-danger">*</span></label>
                                        <div class="col-sm-2">
                                            @if (!empty($expiry_token))
                                                 <input id='date-input' type="date"  name="expiry"  class="form-control required" value="{{ date('Y-m-d', strtotime($expiry_token)) }}" />
                                            @else
                                                <input id='date-input' type="date" id="expiry1" name="expiry"  class="form-control required" value="<?php echo date("Y-m-d",strtotime('+1 years')); ?>" />
                                            @endif
                                            
                                            @if ($errors->has('expiry'))
		                                        <span class="text-danger">{{ $errors->first('expiry') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    
                    
                                    <div class="form-group">
                                      <label class="col-sm-1 control-label" for="submit"></label>
                                      <div class="col-sm-10">
                                        <button id="submit" name= "save" value= "save_value" style="width:120px" class="btn btn-primary">Save</button>
                                      </div>
                                    </div>
                                    
                                   
    
                                
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
<script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$('#expiry').click(function(e)
{
    $('#expiry').get(0).type = 'date'
})
</script>
@stop
