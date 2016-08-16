@extends('layouts.admin')

@section('styles')
<!-- Froala Editor style -->
<link rel="stylesheet" href="{{asset('css/froala.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
@endsection

@section('content')

<article class="content item-editor-page post-create-page">
    <div class="title-block">
        <h3 class="title">
            Add New Post <span class="sparkline bar" data-type="bar"></span>
        </h3>
        @if(session('status'))
        <div class="status update-status">{{ session('status') }} <a href="{{route('admin.posts.index')}}">Back to Posts</a><span><i class="fa fa-times" aria-hidden="true"></i></span></div>
        @endif
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'name'=>'item', 'files'=>true]) !!}

        <div class="card card-block">
            <div class="form-group row{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', 'Title:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
                <div class="col-sm-10">
                    {!! Form::text('title', null, ['class'=>'form-control boxed']) !!}

                    @if ($errors->has('title'))
                    <span class="help-block">
                        <small>{{ $errors->first('title') }}</small>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('body', 'Content:', ['class'=>'col-sm-2 form-control-label text-xs-right']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('body', null, ['class'=>'form-control boxed', 'id' => 'post-editor']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 col-sm-offset-2">
                   <div class="row">
                        <div class="select-tags col-sm-6">
                            {!! Form::label('tags', 'Select Tags:', ['class'=>'form-control-label']) !!}

                            <div class="selected-tags">

                            </div>

                            <div class="used-tags">
                                @foreach($tags as $tag)
                                <span data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}"> {{ $tag->name }} </span> &nbsp;
                                @endforeach
                            </div>

                            <div class="add-tag row">
                                <div class="col-xs-9">
                                    <input type="text" class="form-control form-control-sm boxed" data-next-tag-record-id="10">
                                </div>
                                <div class="col-xs-3">
                                    <span class="btn btn-primary btn-sm btn-add-tag">Add</span>
                                </div>
                                <em>Separate tags with commas</em>
                            </div>

                        </div>

                       <div class="select-categories col-sm-6">
                           {!! Form::label('categories', 'Select Categories:', ['class'=>'form-control-label']) !!}
                           @foreach($categories as $category)
                           <span>
                               <input type="checkbox" name="categories[]" value="{{ $category->id }}">&nbsp; {{ $category->name }}
                           </span>
                           @endforeach
                       </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 form-control-label text-xs-right">Featured Image:</label>
                <div class="col-sm-10">
                    <div class="images-container">
                        <div class="image-container" id="image-container">
                            <div class="controls">
                                <a href="#" class="control-btn remove"> <i class="fa fa-trash-o"></i> </a>
                            </div>
                            <div class="image" style="background-image:url()"></div>
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
                    {!! Form::submit('Publish', ['class'=>'btn btn-primary', 'name' => 'publish']) !!} &nbsp;
                    {!! Form::submit('Save Draft', ['class'=>'btn btn-secondary', 'name' => 'draft']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}

</article>


@endsection

@section('scripts')
<!-- Froala JS file -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

<script type="text/javascript" src="{{ asset('js/froala/froala_editor.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/align.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/char_counter.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/code_beautifier.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/code_view.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/color.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/draggable.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/emoticons.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/entities.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/file.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/font_size.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/font_family.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/fullscreen.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/image.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/image_manager.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/line_breaker.min.js') }}" ></script>
{{--        <script type="text/javascript" src="{{ asset('js/froala/inline_style.min.js') }}" ></script>--}}
<script type="text/javascript" src="{{ asset('js/froala/link.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/lists.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/paragraph_format.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/paragraph_style.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/quick_insert.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/quote.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/table.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/save.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/url.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/froala/video.min.js') }}" ></script>

@endsection
