@extends('theme.layout.base_layout')
@section('title', 'Add User')
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
            <h5 class="modal-title" id="addModal">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="{{route('store_user')}}" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">First Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" placeholder="Fisrt Name" name="first_name" value="{{old('first_name')}}" class="form-control">
                            @if ($errors->user_add->has('first_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('first_name') }}
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
                            <input type="text" placeholder="Last Name" name="last_name" value="{{old('last_name')}}" class="form-control">
                            @if ($errors->user_add->has('last_name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('last_name') }}
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
                            <input type="text" placeholder="Username" name="username" value="{{old('username')}}" class="form-control">
                            @if ($errors->user_add->has('username'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('username') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label for="file-input" class=" form-control-label required">Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" placeholder="Password" name="password" value="{{old('password')}}" class="form-control">
                            @if ($errors->user_add->has('password'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('password') }}
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
                            <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="form-control">
                            @if ($errors->user_add->has('email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('email') }}
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
                            <textarea type="email" placeholder="CC Email . . . " name="cc_email" value="{{old('cc_email')}}" class="form-control"></textarea>
                            @if ($errors->user_add->has('cc_email'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('cc_email') }}
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
                                <select name="branch" class="form-control">
                                    <option value="">Select Branch</option>
                                    @foreach($branch_wise as $kb=>$vb)
                                        <option  value="{{$kb}}"  {{ ($kb == old('branch',$vb))?'selected':'' }} >{{$vb}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->user_add->has('branch'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('branch') }}
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
                            <input type="text" placeholder="Role" name="name" value="{{old('role')}}" class="form-control">
                            @if ($errors->user_add->has('name'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('name') }}
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
                                        @if(!empty($module_name['Operations']))
                                            <thead>
                                                <tr class="capitalize persist-header">
                                                    <th style="text-align:left; width:100%"><strong>Modules</strong></th> 
                                                    @foreach($module_name['Operations'] as $op)
                                                        <th style="text-align:left; width:100%"><strong>{{ $op }}</strong></th> 
                                                    @endforeach
                                                </tr>
                                        @endif
                                    <thead>
                                    <tbody>
                                        @if(!empty($module_name['Modules']))
                                            @foreach($module_name['Modules'] as $modl_name=>$permsn)
                                                <tr>
                                                    <td style="text-align:left; background: #333; color: #fff; width:100%"><strong>{{ ucfirst(str_replace('_',' ' , $modl_name))  }}</strong></td>
                                                    @foreach($module_name['order'] as $key=>$per)
                                                        <td style="text-align:left; width:100%">
                                                        @if (!empty($permsn[$key]))
                                                            <input type="checkbox" name="permission[{{ $modl_name }}][]" value="{{ $permsn[$key]['name'] }}" {{ (is_array(old('permission')) and in_array($permsn[$key], old('permission.'.$modl_name, []))) ? ' checked' : '' }}/>
                                                        @else
                                                            <input type="checkbox" disabled name="" value=""style="text-align:center; vertical-align: middle;">
                                                        @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                            </table>
                            @if ($errors->user_add->has('permission'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $errors->user_add->first('permission') }}
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