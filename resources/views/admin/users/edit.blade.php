@extends('layouts.admin')

@section('content')


<article class="content item-editor-page user-editor-page">
    <div class="title-block">

        @if($user->id == Auth::user()->id)
            <h3 class="title">
                Profile <span class="sparkline bar" data-type="bar"></span>
            </h3>
        @else
            <h3 class="title">
                Edit User <span class="sparkline bar" data-type="bar"></span> <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-sm rounded-s">
                Add New
                </a>
            </h3>
        @endif

        @if(session('status'))
        <div class="status update-status">{{ session('status') }} <a href="{{route('admin.users.index')}}">Back to Users</a><span><i class="fa fa-times" aria-hidden="true"></i></span></div>
        @endif
    </div>

    {!! Form::model($user ,['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'name'=>'item', 'files'=>true]) !!}

    <div class="card card-block">
        <div class="form-group row{{ $errors->has('firstname') ? ' has-error' : '' }}">
            {!! Form::label('firstname', 'Firstname:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('firstname', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('firstname'))
                <span class="help-block">
                    <small>{{ $errors->first('firstname') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ $errors->has('lastname') ? ' has-error' : '' }}">
            {!! Form::label('lastname', 'Lastname:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('lastname', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('lastname'))
                <span class="help-block">
                    <small>{{ $errors->first('lastname') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ $errors->has('username') ? ' has-error' : '' }}">
            {!! Form::label('username', 'Username:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('username', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('username'))
                <span class="help-block">
                    <small>{{ $errors->first('username') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::email('email', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('email'))
                <span class="help-block">
                    <small>{{ $errors->first('email') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Password:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::password('password', ['class'=>'form-control boxed']) !!}

                @if ($errors->has('password'))
                <span class="help-block">
                    <small>{{ $errors->first('password') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Confirm Password:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::password('password_confirmation', ['class'=>'form-control boxed']) !!}

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <small>{{ $errors->first('password_confirmation') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('role', 'Role:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('role_id', $roles, $user->role->id, ['class' => 'c-select form-control boxed']) !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 form-control-label text-xs-right">Images:</label>
            <div class="col-sm-10">
                <div class="images-container">
                    <div class="image-container" id="image-container">
                        <div class="controls">
                            <a href="#" class="control-btn remove"> <i class="fa fa-trash-o"></i> </a>
                        </div>
                        <div class="image" style="background-image:url(@if(isset($user->photo)) {{ asset($user->photo->file_path) }} @endif )"></div>
                    </div>
                    <a href="#" class="add-image" data-toggle="modal" data-target="#modal-media">
                        <div class="image-container new">
                            <div class="image"> <i class="fa fa-plus"></i> </div>
                        </div>
                    </a>
                </div>
            </div>
            {!! Form::hidden('photo_id', null, ['id' => 'photo-id']) !!}
        </div>

        <div class="form-group row">
            <div class="col-sm-10 col-sm-offset-2">
                @if($user->id == Auth::user()->id)
                    {!! Form::submit('Update Profile', ['class'=>'btn btn-primary']) !!}
                @else
                    {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                @endif

            </div>
        </div>

    </div>
    {!! Form::close() !!}

</article>


@endsection
