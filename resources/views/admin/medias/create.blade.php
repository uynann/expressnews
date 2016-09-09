@extends('layouts.admin')

@section('content')

<article class="content items-list-page medias-create-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Upload New Media
                    </h3>

                </div>
            </div>
            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif
        </div>

        @if(session('status'))
        <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
        @endif

    </div>

    <div class="card">
        <div class="upload-container">
            <div id="dropzone">
                <form action="{{ url('admin/medias') }}" class="dropzone needsclick dz-clickable" id="mediaUpload3">
                    <div class="dz-message-block">
                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                    </div>

                    {{ csrf_field() }}

                </form>
            </div>
        </div>
    </div>


</article>


@endsection




