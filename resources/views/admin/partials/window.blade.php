<div class="window window-show-media">
    <div class="window-content clearfix">
        <div class="window-header">
            <h4 class="modal-title">Attachment Details</h4>

        </div>

        <div class="window-controls slide-prev-next">
            <span class="slide-prev"><i class="fa fa-chevron-left"></i> </span>
            <span class="slide-next"><i class="fa fa-chevron-right"></i> </span>
            <span class="close-window"><i class="fa fa-times"></i> </span>

        </div>

        <ul class="slides-container clearfix" style="width: {{ 100 * count($photos_all) }}%">

            @foreach($photos_all as $photo)
            <li class="window-body clearfix">
                <div class="image-show">
                    <div class="image-holder">
                        <img src="{{ asset($photo->file_path) }}" alt="">
                    </div>

                    <a href="" class="btn btn-secondary btn-sm">Edit Image</a>

                </div>
                <div class="image-description">
                    <div class="image-desc-header">
                        <p><strong>File name: </strong>{{ $photo->file_name }} </p>
                        <p><strong>File type: </strong>{{ $photo->file_mime }} </p>
                        <p><strong>File size: </strong>{{ $photo->file_size }} </p>
                        <p><strong>Uploaded on: </strong>{{ $photo->created_at->format('M d, Y') }} </p>
                        <p><strong>Uploaded by: </strong>{{ $photo->user->username }} </p>
                    </div>

                    <div class="image-desc-form">

                        <div class="status update-photo-status">Update saved!<span><i class="fa fa-times" aria-hidden="true"></i></span></div>

                        <form data-link="{{ url('admin/medias', [$photo->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row"> <label for="url" class="col-sm-3 form-control-label">URL</label>
                                <div class="col-sm-9"> <input type="text" class="form-control boxed form-control-sm" id="url" readonly="readonly" value="{{ url($photo->file_path) }}"> </div>
                            </div>
                            <div class="form-group row"> <label for="caption" class="col-sm-3 form-control-label">Caption</label>
                                <div class="col-sm-9"> <input type="text" class="form-control boxed form-control-sm" id="caption" value="{{ $photo->caption }}" name="caption"> </div>
                            </div>
                            <div class="form-group row"> <label for="alt-text" class="col-sm-3 form-control-label">Alt Text</label>
                                <div class="col-sm-9"> <input type="text" class="form-control boxed form-control-sm" id="alt-text" value="{{ $photo->alttext }}" name="alttext"> </div>
                            </div>
                            <div class="form-group row"> <label for="description" class="col-sm-3 form-control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea rows="3" class="form-control boxed form-control-sm" id="description" style="margin-top: 0px; margin-bottom: 0px; height: 110px;" name="description">{{ $photo->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-9"> <button type="submit" class="btn btn-primary btn-sm btn-save-photo">Save</button> </div>
                            </div>
                        </form>
                    </div>
                    <div class="image-desc-footer">
                       <form action="{{ url('admin/medias', [$photo->id]) }}" method="post">
                           {{ csrf_field() }}
                           {{ method_field('DELETE') }}
                           <button type="submit" class="delete-warning delete-photo">Delete Permanently</button>
                       </form>

                    </div>
                </div>
            </li>
            @endforeach
        </ul>

    </div>

</div>
