<div class="modal fade" id="modal-media">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Media Library</h4> </div>
            <div class="modal-body modal-tab-container">
                <ul class="nav nav-tabs modal-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link nav-link-gallery" href="#gallery" data-toggle="tab" role="tab">Gallery</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
                </ul>
                <div class="tab-content modal-tab-content">
                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                        <div class="images-container">
                            <ul class="row image-row">
                                @if(isset($photos))
                                @foreach($photos as $photo)
                                <li class="col-sm-2" >
                                    <div class="image-wrapper" photo-id="{{ $photo->id }}">
                                        <img src="{{ asset($photo->file_path) }}" alt="" class="image-gallary">
                                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                    </div>
                                </li>
                                @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade active in" id="upload" role="tabpanel">
                        <div class="upload-container">
                            <div id="dropzone">
                                <form action="{{ url('admin/medias') }}" class="dropzone needsclick dz-clickable" id="mediaUpload1">
                                    <div class="dz-message-block">
                                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                    </div>

                                    {{ csrf_field() }}

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" id="insert-selected" data-dismiss="modal">Insert Selected</button> </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
