Dropzone.options.mediaUpload1 = {
    maxFilesize: 2, // MB
    acceptedFiles: "image/*",
    success: function(file, response) {
        if (file.status == 'success') {
            handleDropzoneFileUpload1.handleSuccess(response);
        } else {
            handleDropzoneFileUpload1.handleError(response);
        }
    }
};


Dropzone.options.mediaUpload2 = {
    maxFilesize: 2, // MB
    acceptedFiles: "image/*",
    success: function(file, response) {
        if (file.status == 'success') {
            handleDropzoneFileUpload2.handleSuccess(response);
        } else {
            handleDropzoneFileUpload2.handleError(response);
        }
    }
};


Dropzone.options.mediaUpload3 = {
    maxFilesize: 2, // MB
    acceptedFiles: "image/*",
    success: function(file, response) {
        if (file.status == 'success') {
            handleDropzoneFileUpload3.handleSuccess(response);
        } else {
            handleDropzoneFileUpload3.handleError(response);
        }
    }
};


var handleDropzoneFileUpload1 = {
    handleError: function(response) {
        console.log(response);
    },
    handleSuccess: function(response) {
        $('#modal-media .tab-pane#gallery').addClass('active in');
        $('#modal-media .nav-item .nav-link.nav-link-gallery').addClass('active');

        var imageHolder = '<li class="col-sm-2">';
        imageHolder    +=    '<div class="image-wrapper selected" photo-id="' + response.id + '">';
        imageHolder    +=        '<img src="' + baseUrl + '/' + response.file_path + '" alt="" class="image-gallary">';
        imageHolder    +=        '<span><i class="fa fa-check" aria-hidden="true"></i></span>';
        imageHolder    +=     '</div>';
        imageHolder    += '</li>';

        $('ul.image-row li .image-wrapper.selected').removeClass('selected');

        $('#modal-media .tab-pane .image-row').prepend(imageHolder);

        $('#insert-selected').prop( "disabled", false );
//        console.log(response);
    }
};


var handleDropzoneFileUpload2 = {
    handleError: function(response) {
        console.log(response);
    },
    handleSuccess: function(response) {
        var imageHolder = '<li class="image-wrapper-holder clearfix">';
        imageHolder    +=    '<div class="image-wrapper-for-medias-page">';
        imageHolder    +=        '<img src="' + baseUrl + '/' + response.file_path + '" alt="" class="image-gallary">';
        imageHolder    +=     '</div>';
        imageHolder    += '</li>';

        $('.medias-content .image-row').prepend(imageHolder);
        //        console.log(response);
    }
};

var handleDropzoneFileUpload3 = {
    handleError: function(response) {
        console.log(response);
    },
    handleSuccess: function(response) {
        var imageHolder = '<div class="status uploaded-image">';
        imageHolder    +=    '<img src="' + baseUrl + '/' + response.file_path + '" alt="">';
        imageHolder    +=    '<span><i class="fa fa-times" aria-hidden="true"></i></span>';
        imageHolder    +=  '</div>';

        $('.medias-create-page').append(imageHolder);
        //        console.log(response);
    }
};

