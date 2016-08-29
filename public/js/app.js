/***********************************************
*       Show Reply Form
***********************************************/
$(function() {
    $('.reply-btn').click(function() {

        $('.reply-form form').remove();

        var form = '<form method="POST" id="reply-form" data-link="' + $(this).children('.data-link').val() + '">';
        form    +=     '<input type="hidden" name="_token" value="' + $("input[name='_token']").val() + '">';
        form    +=     '<textarea class="comment-text comment-text-reply" name="reply" placeholder="Add a comment..."></textarea>';
        form    +=     '<input type="hidden" name="post_id" value="' + $(this).children('.post-id').val() + '">';
        form    +=     '<input type="hidden" name="to_user" value="'  + $(this).children('.to-user').val() + '">';
        form    +=     '<input type="hidden" name="comment_id" value="' + $(this).children('.comment-id').val() + '">'
        form    +=     '<input type="submit" value="Submit Comment" id="btn-submit-reply">';
        form    += '</form>';

        var reply_form = $(form);
        var submit =reply_form.children('#btn-submit-reply');

//        $(this).closest('.response-info').find('.reply-form:first').append(reply_form).hide().fadeToggle('fast');

//        $('.comment-text-reply').focus();

        var append_to = $(this).closest('.response-info');
        append_to.find('.reply-form:first').append(reply_form).hide().fadeToggle('fast');



        /***********************************************
        *       Submit Replies
        ***********************************************/

        $(document).on('click', '#reply-form #btn-submit-reply', function(e) {

            e.preventDefault();

            $.ajax({
                url: reply_form.attr('data-link'),
                type: 'POST',
                cache: false,
                data: reply_form.serialize(), // form serizlize data
                beforeSend: function() {
                    submit.val('Submitting...').attr('disabled', 'disabled');
                },

                success: function(data) {
//                    console.log(data);

                    var comment = '<div class="media response-info response-info-reply">';
                    comment    +=   '<div class="media-left response-text-left">';
                    comment    +=      '<a href="#"><div class="media-object img" style="background-image: url(' + data.user_img + ')"></div></a>';

                    comment    +=      '<h5 class="comment-author"></h5>';
                    comment    +=    '</div>';

                    comment    +=    '<div class="media-body response-text-right">';
                    comment    +=       '<ul>';
                    comment    +=           '<li><h5><a href="#">' + data.user + '</a></h5></li>';
                    comment    +=           '<li class="response-user"><svg class="icon" viewBox="0 0 14 11"><path d="M7 0v3.675a11.411 11.411 0 0 1-2.135-.244 10.511 10.511 0 0 1-1.983-.635 5.92 5.92 0 0 1-1.715-1.13A4.975 4.975 0 0 1 0 .012c.047 1.075.206 2.045.479 2.912A7.68 7.68 0 0 0 1.686 5.28c.533.704 1.248 1.266 2.147 1.685.898.42 1.954.66 3.167.726V11l7-5.53L7 0" fill-rule="evenodd"></path></svg>' + data.to_user + '</li>';
                    comment    +=           '<li></li>';
                    comment    +=       '</ul>';
                    comment    +=       '<p>' + data.reply + '</p>';
                    comment    +=       '<ul>';
                    comment    +=       '<li><a class="reply-btn">Reply</a></li>';
                    comment    +=       '</ul>';
                    comment    +=    '</div>';

                    comment    +=    '<div class="clearfix"> </div>'

                    comment    += '</div>';



                    append_to.append(comment).hide().fadeIn('fast');
//                    $('.reply-form form').remove();

                    // reset form and button
                    reply_form.trigger('reset');
                    submit.val('Submit Comment').removeAttr('disabled');
                },

                error: function(e) {
                    submit.val('Submit Comment').removeAttr('disabled');
                }

            });
        });




    });

});


/***********************************************
*       Submit Comments
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
                comment    +=       '<li><a class="reply-btn">Reply</a></li>';
                comment    +=       '</ul>';
                comment    +=    '</div>';

                comment    +=    '<div class="clearfix"> </div>';
                comment    +=    '<div class="reply-form"></div>';

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

