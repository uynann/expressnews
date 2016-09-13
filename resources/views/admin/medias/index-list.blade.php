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

            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif

        </div>
        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..." name="search"> <span class="input-group-btn">
                   <input type="hidden" name="view" value="list">
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
                <form action="{{ url('admin/medias') }}" class="dropzone needsclick dz-clickable" id="mediaUpload4" enctype="multipart/form-data">
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
            <li class="active"><a href="{{ url('admin/medias?view=list') }}"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
            <li><a href="{{ url('admin/medias') }}"><i class="fa fa-th-large" aria-hidden="true"></i></a></li>
        </ul>
    </div>


    <form action="/admin/medias/bulkactions" method="post" id="bulk-action-form">

        {{ csrf_field() }}


    <div class="card items">
        <ul class="item-list striped">
            <li class="item item-list-header hidden-sm-down">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox">
                        <span></span>
                        </label> </div>
                    <div class="item-col item-col-header item-col-sales">
                        <div> <span>File</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"> <span>Author</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-reply">
                        <div class="no-overflow"> <span>Uploaded to</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"> <span>Date</span> </div>
                    </div>

                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                </div>
            </li>


            @if(isset($photos))
            @foreach($photos as $key=>$photo)
            <li class="item">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox" name="checkboxMediasArray[]" value="{{ $photo->id }}">
                        <span></span>
                        </label>
                    </div>

                    <div class="item-col item-col-sales">
                        <div class="item-heading">File</div>
                        <div class="no-overflow image-list-container clearfix">
                            <div class="image-list-holder" data-index="{{ $key + ($photos->currentPage() - 1) * $photos->perPage() }}">
                                <img src="{{ asset($photo->file_path) }}" alt="" class="image-gallary">
                            </div>
                            <div class="image-list-desc">
                                <a class="file-name" data-index="{{ $key + ($photos->currentPage() - 1) * $photos->perPage() }}"><h5 class="item-title">{{ $photo->file_name }}</h5></a>
                                <p>{{ $photo->file_size }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Author</div>
                        <div class="no-overflow">
                            <a href="{{ route('admin.users.edit', $photo->user->id) }}">{{ $photo->user->username }}</a>
                        </div>
                    </div>
                    <div class="item-col item-col-reply no-overflow">
                        <div class="item-heading">Uploaded to</div>
                        <div class="no-overflow">

                        </div>
                    </div>
                    <div class="item-col item-col-category no-overflow">
                        <div class="item-heading">Date</div>
                        <div class="no-overflow item-date">
                            {{ $photo->created_at->timezone('Europe/Moscow')->format('M d, Y') }}
                        </div>
                    </div>

                    <div class="item-col fixed item-col-actions-dropdown">
                        <div class="item-actions-dropdown">
                            <a class="item-actions-toggle-btn"> <span class="inactive">
                                <i class="fa fa-cog"></i>
                                </span> <span class="active">
                                <i class="fa fa-chevron-circle-right"></i>
                                </span> </a>
                            <div class="item-actions-block">
                                <ul class="item-actions-list">

                                    @if ($photo->id != 1)
                                    <li>
                                        <a class="remove remove-item romove-photo" href="#" data-toggle="modal" data-target="#confirm-modal"> <i class="fa fa-trash-o " data-item-id="{{ $photo->id }}"></i> </a>

                                    </li>
                                    @endif

                                    <li>
                                        <a class="edit btn-edit-comment edit-photo" data-index="{{ $key + ($photos->currentPage() - 1) * $photos->perPage() }}"> <i class="fa fa-pencil"></i> </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </li>

            @endforeach
            @endif
        </ul>
    </div>

    <div class="action bulk-action dropdown">
        <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            More actions...
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".comfirm-bulk-delete" id="bulk-delete"><i class="fa fa-close icon"></i> Delete Permanently</a>
        </div>
    </div>

    </form>

    @include('admin.partials.window')


    <nav class="text-xs-right">

        {!! $photos->appends([$param => $param_val, $param1 => $param1_val])->render() !!}

    </nav>

</article>

@endsection
