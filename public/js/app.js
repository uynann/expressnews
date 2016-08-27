/***********************************************
*       Show Reply Form
***********************************************/
$(function() {

    $('.reply-btn').click(function() {

        $('.reply-form').hide();
        $(this).closest('.response-info').find('.reply-form:first').fadeToggle('fast');
    });
});







/***********************************************
*       Submit Comments and Replies
***********************************************/
$(function() {
    var form = $('#comment-form');
    var action = form.attr('data-link');
    var submit = $('#btn-submit-comment');

    form.on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            url: action,
            type: 'POST',
            cache: false,
            data: form.serialize(), // form serizlize data
            beforeSend: function() {
                submit.val('Submitting...').attr('disabled', 'disabled');
            },

            success: function(data) {
//                console.log(data);

                var comment = '<div class="media response-info">';
                comment    +=   '<div class="media-left response-text-left">';
                comment    +=      '<a href="#"><div class="media-object img" style="background-image: url(' + data.user_img + ')"></div></a>';

                comment    +=      '<h5 class="comment-author"></h5>';
                comment    +=    '</div>';

                comment    +=    '<div class="media-body response-text-right">';
                comment    +=       '<ul>';
                comment    +=           '<li><h5><a href="#">' + data.user + '</a></h5></li>';
                comment    +=           '<li>Sep 21, 2015</li>';
                comment    +=       '</ul>';
                comment    +=       '<p>' + data.comment + '</p>';
                comment    +=       '<ul>';
                comment    +=       '<li><a href="single.html">Reply</a></li>';
                comment    +=       '</ul>';
                comment    +=    '</div>';

                comment    +=    '<div class="clearfix"> </div>'

                comment    += '</div>';

                $('.comments-list').prepend(comment).hide().fadeIn('slow');
//                $('.comments-list').prepend(comment);

                // reset form and button
                form.trigger('reset');
                submit.val('Submit Comment').removeAttr('disabled');
            },

            error: function(e) {
                submit.val('Submit Comment').removeAttr('disabled');
            }

        });
    });
});
