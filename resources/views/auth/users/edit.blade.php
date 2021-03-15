@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit User
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
 <link rel="stylesheet" href="{{ asset('assets/drop/mulselect/dist/css/bootstrap-multiselect.css') }}">
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box default">
                <div class="portlet-title">
                    <h2 class="panel-title"> <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Editing User : {{{ $user->first_name}}} {{{ $user->last_name}}}
                    </h2>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="portlet-body">
                <form class="form-wizard form-horizontal" action="{{ route('users.postupdate', $user->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
    
                             
                                
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-1 control-label">First Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control required" value="{{{ Request::old('first_name', $user->first_name) }}}" />
                                            @if ($errors->has('first_name'))
		                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-1 control-label">Last Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control required" value="{{{ Request::old('last_name', $user->last_name) }}}" />
                                            @if ($errors->has('last_name'))
		                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="email" class="col-sm-1 control-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-sm-5">
                                            <input id="email" name="email" placeholder="E-Mail" type="text" class="form-control required email" value="{{{ Request::old('email', $user->email) }}}" />
                                            @if ($errors->has('email'))
		                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="form-group">
                                          <label class="col-sm-1 control-label" for="selectbasic">Role <span class="text-danger">*</span></label>
                                          <div class="col-sm-10">
                                        <select id="role" multiple="multiple" name="role[]">
                                            @if (!empty($roles)) 
                                                @foreach ($roles as $role)
                                                    @if(in_array($role->id,array_column($user->roles->toArray(),'id')))
                                                    <option selected value="{{ $role->id }}">{{  $role->display_name}}</option> 
                                                    @else
                                                    <option value="{{ $role->id }}" {{ (is_array(old('role')) and in_array($role->id, old('role', []))) ? 'selected' : '' }}>{{  $role->display_name}}</option> 
                                                    @endif
                                                @endforeach
                                            @else
                                            <option value="">No role available</option> 
                                            @endif
                                        </select>
                                         @if ($errors->has('role'))
		                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-1 control-label">Password </label>
                                        <div class="col-sm-5">
                                            <input id="password" name="password" type="password" placeholder="Password" class="form-control required" 
                                            value=""  />
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                            <span class="text-info">[To update password please fill out this field] </span>
                                        </div>
                                       
                                    </div>
                                    <!-- Button -->
                                    <div class="form-group">
                                      <label class="col-sm-1 control-label" for="submit"></label>
                                      <div class="col-sm-5">
                                        <button id="submit" name="submit" class="btn btn-primary" style="width:115px">Submit</button>
                                      </div>
                                    </div>
                                    
                                    <p>(<span class="text-danger">*</span>) Mandatory</p>
                            </form> 
	                   
                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

{{-- page level scripts --}}

@section('footer_scripts')
<script src="{{ asset('assets/drop/mulselect/dist/js/bootstrap-multiselect.js') }}"></script>
<script>
    $(document).ready(function() {
	    $('#role').multiselect();
    });
</script>
@stop