@extends('layouts.admin')

@section('content')

<article class="content item-editor-page post-editor-page">
    <div class="title-block">
        <h3 class="title">
            Edit Category <span class="sparkline bar" data-type="bar"></span>
        </h3>
        @if(session('status'))
        <div class="status update-status">{{ session('status') }} <a href="{{route('admin.categories.index')}}">Back to Categories</a><span><i class="fa fa-times" aria-hidden="true"></i></span></div>
        @endif
    </div>

    {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id], 'name'=>'item']) !!}

    <div class="card card-block">
        <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', '* Name:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('name'))
                <span class="help-block">
                    <small>{{ $errors->first('name') }}</small>
                </span>
                @endif

                <span class="help-block" style="display: block; color: #4f5f6f; font-size: 0.9em;">
                    <em>The name is how it appears on your site.</em>
                </span>
            </div>
        </div>

        <div class="form-group row{{ $errors->has('slug') ? ' has-error' : '' }}">
            {!! Form::label('slut', '* Slug:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('slug', null, ['class'=>'form-control boxed']) !!}

                @if ($errors->has('slug'))
                <span class="help-block">
                    <small>{{ $errors->first('slug') }}</small>
                </span>
                @endif

                <span class="help-block" style="display: block; color: #4f5f6f; font-size: 0.9em;">
                    <em>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</em>
                </span>
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('description', 'Description:', ['class'=>'col-sm-2 form-control-label form-controll-label-sm text-xs-right']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description', null, ['class'=>'form-control boxed', 'rows'=>'5']) !!}
                <span class="help-block" style="display: block; color: #4f5f6f; font-size: 0.9em;">
                    <em>The description is optional.</em>
                </span>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="note-on-page">
        <span><strong><em>Note:</em></strong></span>
        <span><em>Fields marked with * are required.</em></span>
    </div>

</article>


@endsection
