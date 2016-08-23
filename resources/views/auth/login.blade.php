@extends('layouts.app')

@section('content')

<ol class="breadcrumb category-page">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Login</li>
</ol>

<div class="articles sports login-page">
    <header>
        <h3 class="title-head">Login</h3>
    </header>

    <div class="login-section">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

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

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>

                    <a class="power" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
