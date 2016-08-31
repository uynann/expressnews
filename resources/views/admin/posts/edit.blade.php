@extends('layouts.admin')

@section('styles')
<!-- Froala Editor style -->
<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/char_counter.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/code_view.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/colors.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/draggable.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/emoticons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/file.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/fullscreen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/image_manager.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/image.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/line_breaker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/quick_insert.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/table.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/css/plugins/video.min.css">


@endsection

@section('content')

<article class="content item-editor-page post-editor-page">
    <div class="title-block">
        <h3 class="title">
            Edit Post
            <a href="{{ route('show', ['category'=>preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post->category->name))), 'id_title'=>$post->id . '-' . preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post->title)))]) }}" class="btn btn-primary btn-sm rounded-s">
                View Post
            </a>
            <span class="sparkline bar" data-type="bar"></span>
        </h3>
        @if(session('status'))
        <div class="status update-status">{{ session('status') }} <a href="{{route('admin.posts.index')}}">Back to Posts</a><span><i class="fa fa-times" aria-hidden="true"></i></span></div>
        @endif
    </div>

    {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'name'=>'item', 'files'=>true]) !!}

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
                            @foreach($post->tags as $post_tag)
                                <span class="selected-tag">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i> {{ $post_tag->name }}
                                    <input type="hidden" name="tags[]" value="{{ $post_tag->id }}">
                                </span>
                            @endforeach
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
                           @if($post->category->id === $category->id)
                                <input type="radio" name="category_id" value="{{ $category->id }}" checked>&nbsp; {{ $category->name }}
                            @else
                                <input type="radio" name="category_id" value="{{ $category->id }}">&nbsp; {{ $category->name }}
                            @endif
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 col-sm-offset-2">
                <div class="post-status row">
                    <div class="post-status-show col-xs-12">
                        <i class="fa fa-key" aria-hidden="true"></i> Status: <strong>{{ ucfirst($post->status) }}</strong> <span class="edit-post-status">Edit</span>
                    </div>
                    <input type="hidden" name="status" id="status-holder" value="{{ $post->status }}">
                    <div class="post-status-change col-xs-5">
                        {!! Form::select('status_options', ['publish'=>'Publish', 'draft'=>'Draft'], $post->status, ['class' => 'c-select form-control form-control-sm boxed']) !!} <span class="btn btn-primary btn-sm ok-post-status-change">OK</span> <span class="cancel-post-status-change">Cancel</span>
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
                        <div class="image" style="background-image:url(@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif)"></div>
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
                {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</article>


@endsection


@section('scripts')

<!-- Include JS file. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/froala_editor.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/align.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/colors.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/entities.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/file.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/font_family.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/font_size.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/forms.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/image.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/link.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/quote.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/save.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/table.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/url.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.4/js/plugins/video.min.js"></script>

<script>
$(function(){
    $('#post-editor').froalaEditor()
});
</script>

@endsection
