@extends('layouts.admin')


@section('content')

<article class="content items-list-page medias-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Media Library
                        <span class="btn btn-primary btn-sm rounded-s" id="btn-addnew-media">
                            Add New
                        </span>
                    </h3>

                </div>
            </div>

        </div>
        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..." name="search"> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    </span> </div>
            </form>
        </div>

    </div>

    <div class="card">
        <div class="upload-container">
            <div id="dropzone">
                <form action="{{ url('admin/medias') }}" class="dropzone needsclick dz-clickable" id="mediaUpload2" enctype="multipart/form-data">
                    <div class="dz-message-block">
                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                    </div>

                    {{ csrf_field() }}

                </form>
            </div>

            <span class="close-uploadform"><i class="fa fa-times"></i></span>
        </div>
    </div>

    <div class="card">
        <ul class="view-mode">
            <li><a href="{{ url('admin/medias?view=list') }}"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
            <li class="active"><a href="{{ url('admin/medias') }}"><i class="fa fa-th-large" aria-hidden="true"></i></a></li>
        </ul>
    </div>


    <div class="card items medias-list">
        <div class="medias-content">
            <div class="images-container">
                <ul class="row image-row clearfix">
                    @if(isset($photos))
                    @foreach($photos as $key=>$photo)
                    <li class="image-wrapper-holder clearfix">
                        <div class="image-wrapper-for-medias-page" data-index="{{ $key + ($photos->currentPage() - 1) * $photos->perPage() }}">
                            <img src="{{ file_exists(public_path('images/thumbs/' . $photo->file_name)) ?  asset('images/thumbs/' . $photo->file_name) : asset($photo->file_path) }}" alt="" class="image-gallary">
                        </div>
                    </li>
                    @endforeach
                    @endif

                </ul>
            </div>
        </div>
    </div>

    @include('admin.partials.window')

    <nav class="text-xs-right">

        {!! $photos->appends([$param1 => $param1_val])->render() !!}

    </nav>

</article>

@endsection
