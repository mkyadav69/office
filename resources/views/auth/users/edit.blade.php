@extends('theme.layout.base_layout')
@section('title', 'Update User')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.container-fluid {
    width: 100%;
    padding-right: 15px;
    padding-left: 2px;
    margin-right: auto;
    margin-left: auto;
}
.col-md-1 {
    padding-left: 20px;
}
.table {
    max-width: 90%;
}

</style>
<div class="col col-md-12">
<div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModal">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_updated_user')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">First Name</label>
                        </div>
                        <input type="hidden" value="{{$id}}", name="id">
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Fisrt Name" required id="first_name" name="update_first_name" value="{{old('update_first_name', $user->first_name)}}" class="form-control">
                            @if ($errors->has('update_first_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_first_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Last Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Last Name" required id="last_name" name="update_last_name" value="{{old('update_last_name', $user->last_name)}}" class="form-control">
                            @if ($errors->has('update_last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_last_name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Username</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Username" required id="username" name="update_username" value="{{old('update_username', $user->user_name)}}" class="form-control">
                            @if ($errors->has('update_username'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_username') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" placeholder="Email" required id="email" name="update_email" value="{{old('update_email', $user->email)}}" class="form-control">
                            @if ($errors->has('update_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_email') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">CC Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea type="email" placeholder="CC Email . . . " required id="cc_email" name="update_cc_email" value="" class="form-control">{{old('cc_email', $user->cc_email)}}</textarea>
                            @if ($errors->has('update_cc_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_cc_email') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Select Branch</label>
                        </div>
                        <div class="col-12 col-md-9">
                            @if(!empty($branch_wise))
                                <select id="branch" name="update_branch" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branch_wise as $kb=>$vb)
                                        <option  value="{{$kb}}"  {{ ($user->branch_id == old('update_branch',$kb))?'selected':'' }} >{{$vb}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->has('update_branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('update_branch') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Role</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Role" name="name" value="{{old('name', $auth_role['name'])}}" class="form-control">
                            @if ($errors->has('name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->first('name') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                    </div>
                    <div class="row form-group">
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Permissions</label>
                        </div>
                   
                        <div class="col col-md-10">
                        <table id="customer" class="table table-borderless table--no-card m-b-30 table-striped table-earning sticky-header" style="width:100%">
                            <thead>
                                @if(!empty($order))
                                    <tr class="capitalize persist-header">
                                        <th style="text-align:left; width:100%"><strong>Modules</strong></th> 
                                        @foreach($order as $op)
                                            <th style="text-align:left; width:100%"><strong>{{ $op }}</strong></th> 
                                        @endforeach
                                    </tr>
                                @endif
                            <thead>
                            <tbody>
                                @if(!empty($per_data))
                                    @foreach($per_data as $identifier=>$permi_data)
                                        <tr>
                                            <td style="text-align:left; background: #333; color: #fff; width:100%"><strong>{{ ucfirst($identifier)  }}</strong></td>
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
                        @if ($errors->has('permission'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->first('permission') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    </div>
            
                    <div class="modal-footer">
                        <a href="{{route('show_user')}}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Add-->
@endsection