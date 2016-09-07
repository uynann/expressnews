@extends('layouts.admin')

@section('styles')

<link rel="stylesheet" href="{{asset('css/admin/slick.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/slick-theme.css')}}">

@endsection

@section('scripts')

<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/admin/slick.min.js')}}"></script>

@endsection

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
                        </span><div class="action dropdown">
                        <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More actions...
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o icon"></i>Mark as a draft</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm-modal"><i class="fa fa-close icon"></i>Delete</a>
                        </div>
                        </div>
                    </h3>

                </div>
            </div>
            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif
        </div>
        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..."> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                    </span> </div>
            </form>
        </div>

    </div>

    <div class="card">
        <div class="upload-container">
            <div id="dropzone">
                <form action="{{ url('admin/medias') }}" class="dropzone needsclick dz-clickable" id="demo-upload">
                    <div class="dz-message-block">
                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                    </div>

                    {{ csrf_field() }}

                </form>
            </div>

            <span class="close-uploadform"><i class="fa fa-times"></i></span>
        </div>
    </div>


    <div class="card items medias-list">
        <div class="medias-content">
            <div class="images-container">
                <ul class="row image-row clearfix">
                    @if(isset($photos))
                    @foreach($photos as $photo)
                    <li class="image-wrapper-holder clearfix">
                        <div class="image-wrapper-for-medias-page">
                            <img src="{{ asset($photo->file_path) }}" alt="" class="image-gallary">
                        </div>


{{--
                        <div class="window window-show-media">
                            <div class="window-content">
                                <div class="window-header">
                                    <h4 class="modal-title">Attachment Details</h4>
                                    <div class="window-controls">
                                        <span><i class="fa fa-chevron-left"></i> </span>
                                        <span><i class="fa fa-chevron-right"></i> </span>
                                        <span class="close-window"><i class="fa fa-times"></i> </span>

                                    </div>

                                </div>

                                <div class="window-body clearfix">
                                    <div class="image-show">
                                        <div class="image-holder">
                                            <img src="{{ asset($photo->file_path) }}" alt="">
                                        </div>

                                        <a href="" class="btn btn-secondary btn-sm">Edit Image</a>

                                    </div>
                                    <div class="image-description">

                                    </div>
                                </div>
                            </div>

                        </div>
--}}


                    </li>
                    @endforeach
                    @endif

                </ul>
            </div>
        </div>
    </div>

    <div class="window window-show-media">
        <div class="window-content slides-master clearfix " id="cslide-slides">
            <div class="window-header">
                <h4 class="modal-title">Attachment Details</h4>

            </div>

            <div class="window-controls slide-prev-next">
                <span class="slide-prev"><i class="fa fa-chevron-left"></i> </span>
                <span class="slide-next"><i class="fa fa-chevron-right"></i> </span>
                <span class="close-window"><i class="fa fa-times"></i> </span>

            </div>

            <div class="slides-container clearfix">
{{--                @foreach($photos as $photo)--}}

                    <div class="window-body slide active clearfix">
                        <div class="image-show">
                            <div class="image-holder">
                                <img src="{{ asset($photo->find(3)->file_path) }}" alt="">
                            </div>

                            <a href="" class="btn btn-secondary btn-sm">Edit Image</a>

                        </div>
                        <div class="image-description">
                            <div class="image-desc-header">
                                <p><strong>File name: </strong>{{ $photo->find(4)->file_name }} </p>
                                <p><strong>File type: </strong>{{ $photo->find(4)->file_mime }} </p>
                                <p><strong>Uploaded on: </strong>{{ $photo->find(4)->created_at->format('M d, Y') }} </p>
                                <p><strong>File size: </strong>{{ $photo->find(4)->file_size }} </p>
                            </div>

                            <div class="image-desc-form">

                            </div>
                        </div>
                    </div>


                    <div class="window-body slide clearfix">
                        <div class="image-show">
                            <div class="image-holder">
                                <img src="{{ asset($photo->find(4)->file_path) }}" alt="">
                            </div>

                            <a href="" class="btn btn-secondary btn-sm">Edit Image</a>

                        </div>
                        <div class="image-description">
                            <div class="image-desc-header">
                                <p><strong>File name: </strong>{{ $photo->find(4)->file_name }} </p>
                            </div>

                            <div class="image-desc-form">

                            </div>
                        </div>
                    </div>

{{--                @endforeach--}}


            </div>
        </div>

    </div>


    <nav class="text-xs-right">

        @if(isset($photos)) {{ $photos->links() }} @endif

    </nav>

</article>

@endsection
