@extends('layouts.admin')

@section('content')

<article class="content item-editor-page post-editor-page">
    <div class="title-block">
        <h3 class="title">
            Edit Tag <span class="sparkline bar" data-type="bar"></span>
        </h3>
        @if(session('status'))
        <div class="status update-status">{{ session('status') }} <a href="{{route('admin.tags.index')}}">Back to Tags</a><span><i class="fa fa-times" aria-hidden="true"></i></span></div>
        @endif
    </div>

    {!! Form::model($tag, ['method'=>'PATCH', 'action'=>['AdminTagsController@update', $tag->id], 'name'=>'item']) !!}

    <div class="card card-block">
        <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('name'))
                <span class="help-block">
                    <small>{{ $errors->first('name') }}</small>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('description', 'Description:', ['class'=>'col-sm-2 form-control-label form-controll-label-sm text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description', null, ['class'=>'form-control boxed', 'rows'=>'5']) !!}
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</article>


@endsection
