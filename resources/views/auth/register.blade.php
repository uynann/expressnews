@extends('layouts.app')

@section('content')

<ol class="breadcrumb category-page">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Signup</li>
</ol>

<div class="articles sports login-page">
    <header>
        <h3 class="title-head">Signup</h3>
    </header>

    <div class="login-section">

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Firstname</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="text" name="firstname" value="{{ old('firstname') }}">

                    @if ($errors->has('firstname'))
                    <span class="help-block">
                        {{ $errors->first('firstname') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Lastname</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="text" name="lastname" value="{{ old('lastname') }}">

                    @if ($errors->has('lastname'))
                    <span class="help-block">
                        {{ $errors->first('lastname') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="text" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                    <span class="help-block">
                       {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="text" name="password">

                    @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="text" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                       {{ $errors->first('password_confirmation') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-btn fa-user"></i> Register
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection
