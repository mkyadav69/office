@extends('auth.auth_layout')
@section('title', 'Register')
@section('content')
<style>
    .required:after {
        content: '*';
        color: red;
        padding-left: 5px;
    }
</style>
<div class="login-form">
    <form action="{{ route('store.register')}}" method="post">
        @csrf
        <div class="form-group">
            <label class="required">Username</label>
            <input class="au-input au-input--full" type="text" name="username" value="{{old('username')}}" placeholder="Username">
        </div>
        @if ($errors->has('username'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Error</span>
                {{ $errors->first('username') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="form-group">
            <label class="required">Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" value="{{old('email')}}" placeholder="Email">
        </div>
        @if ($errors->has('email'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Error</span>
                {{ $errors->first('email') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="form-group">
            <label class="required">Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @if ($errors->has('password'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Error</span>
                {{ $errors->first('password') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="form-group">
            <label class="required">Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="confirm Password">
        </div>
        @if ($errors->has('password_confirmation'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Error</span>
                {{ $errors->first('password_confirmation') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="login-checkbox">
            <label class="required">
                <input type="checkbox" name="aggree">Agree the terms and policy
            </label>
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('login')}}">Sign In</a>
        </p>
    </div>
</div>
@endsection