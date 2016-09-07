<div class="list_vertical">
    <section class="accordation_menu">
        <div>
            <input id="label-1" name="lida" type="radio" checked/>
            <label for="label-1" id="item1"><i class="ferme"> </i>Popular Posts<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
            <div class="content" id="a1">
                <div class="scrollbar" id="style-2">
                    <div class="force-overflow">
                        <div class="popular-post-grids">

                            @if(count($popular_posts))
                            @foreach($popular_posts as $post)

                            <div class="popular-post-grid">
                                <div class="post-img">
                                    <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"><img src="@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif" alt="" /></a>
                                </div>
                                <div class="post-text">
                                    <a class="pp-title" href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"> {{ $post->title }}</a>
                                    <p>on {{ $post->created_at }} <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>{{ count($post->commentsApproved) }} </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>{{ $post->view_count }} </a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input id="label-2" name="lida" type="radio"/>
            <label for="label-2" id="item2"><i class="icon-leaf" id="i2"></i>Recent Posts<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
            <div class="content" id="a2">
                <div class="scrollbar" id="style-2">
                    <div class="force-overflow">
                        <div class="popular-post-grids">

                           @if(count($recent_posts))
                            @foreach($recent_posts as $post)
                                <div class="popular-post-grid">
                                    <div class="post-img">
                                        <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"><img src="@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif" alt="" /></a>
                                    </div>
                                    <div class="post-text">
                                        <a class="pp-title" href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"> {{ $post->title }}</a>
                                        <p>on {{ $post->created_at }} <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>{{ count($post->commentsApproved) }} </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>{{ $post->view_count }} </a></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            @endforeach
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input id="label-3" name="lida" type="radio"/>
            <label for="label-3" id="item3"><i class="icon-trophy" id="i3"></i>Comments<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
            <div class="content" id="a3">
                <div class="scrollbar" id="style-2">
                    <div class="force-overflow">
                        <div class="response">

                            @if(count($recent_comments))
                            @foreach($recent_comments as $comment)
                                <div class="media response-info">
                                    <div class="media-left response-text-left">
                                        <a href="#">
                                            <img class="media-object" src="{{ isset($comment->user->photo->file_path) ? asset($comment->user->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }}" alt="" />
                                        </a>
                                        <h5><a href="#">{{ $comment->user->username }}</a></h5>
                                    </div>
                                    <div class="media-body response-text-right">
                                        <p>{{ $comment->comment }}</p>
                                        <ul>
                                            <li>{{ $comment->created_at->format('M d, Y') }}</li>
                                            <li><a href="single.html">Reply</a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            @endforeach
                            @endif


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
