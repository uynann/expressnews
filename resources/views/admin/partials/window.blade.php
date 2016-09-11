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
                        <p><strong>Uploaded on: </strong>{{ $photo->created_at->format('M d, Y') }} </p>
                        <p><strong>File size: </strong>{{ $photo->file_size }} </p>
                    </div>

                    <div class="image-desc-form">

                    </div>
                </div>
            </li>
            @endforeach


        </ul>
    </div>

</div>
