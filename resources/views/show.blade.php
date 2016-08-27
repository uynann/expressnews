@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">{{ $post->category->name }}</li>
</ol>

<div class="single-page">
    <div class="col-md-2 share_grid">
        <h3>SHARE</h3>
        <ul>
            <li>
                <a href="#">
                    <i class="facebook"></i>
                    <div class="views">
                        <span>SHARE</span>
                        <label>180</label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="twitter"></i>
                    <div class="views">
                        <span>TWEET</span>
                        <label>355</label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="linkedin"></i>
                    <div class="views">
                        <span>SHARES</span>
                        <label>28</label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="pinterest"></i>
                    <div class="views">
                        <span>PIN</span>
                        <label>16</label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="email"></i>
                    <div class="views">
                        <span>Email</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
        </ul>
    </div>

    <div class="col-md-10 content-left single-post">
        <div class="blog-posts">
            <h3 class="post">{{ $post->title }}</h3>

            <div class="date-time">
                <p class="date">Published time: {{ $post->created_at }}</p>
                @if( $post->created_at == $post->updated_at)

                @else
                    <p class="date">Edited time: {{ $post->updated_at }}</p>
                @endif
            </div>

            <div class="last-article">
                <img src="{{ isset($post->photo) ? asset($post->photo->file_path) : '' }}" alt="" class="featured-image">

                <div class="paragraphs">
                    {!! html_entity_decode($post->body) !!}

                    @if(count($post->tags) > 0)
                    <ul class="categories tags">
                        @foreach($post->tags as $tag)
                        <li><a href="#">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                    @endif

                </div>


                <div class="clearfix"></div>

                <!--related-posts-->
                <div class="row related-posts">
                    <h4>Articles You May Like</h4>
                    <div class="col-xs-6 col-md-3 related-grids">
                        <a href="single.html" class="thumbnail">
                            <img src="{{ asset('assets/f2.jpg') }}" alt=""/>
                        </a>
                        <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                    </div>
                    <div class="col-xs-6 col-md-3 related-grids">
                        <a href="single.html" class="thumbnail">
                            <img src="{{ asset('assets/f1.jpg') }}" alt=""/>
                        </a>
                        <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                    </div>
                    <div class="col-xs-6 col-md-3 related-grids">
                        <a href="single.html" class="thumbnail">
                            <img src="{{ asset('assets/f3.jpg') }}" alt=""/>
                        </a>
                        <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                    </div>
                    <div class="col-xs-6 col-md-3 related-grids">
                        <a href="single.html" class="thumbnail">
                            <img src="{{ asset('assets/f6.jpg') }}" alt=""/>
                        </a>
                        <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                    </div>
                </div>

                <!--//related-posts-->


                <div class="response">
                    <h4 class="response-title">Responses</h4>

                    <div class="coment-form">
                        <form method="POST" id="comment-form" data-link="{{ url('comments') }}">
                            {{ csrf_field() }}
                            <textarea class="comment-text" name="comment" placeholder="Add a comment..."></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="submit" value="Submit Comment" id="btn-submit-comment">
                        </form>
                    </div>

                    <div class="comments-list">

                    @foreach($post->comments->sortByDesc('id') as $comment)

                    <div class="media response-info">
                        <div class="media-left response-text-left">
                            <a href="#">

                                <div class="media-object img" style="background-image: url({{ isset($comment->user->photo->file_path) ? asset($comment->user->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }})"></div>
                            </a>
                            <h5 class="comment-author"></h5>
                        </div>

                        <div class="media-body response-text-right">
                            <ul>
                                <li><h5><a href="#">{{ $comment->user->firstname }}</a></h5></li>
                                <li>Sep 21, 2015</li>
                            </ul>
                            <p>{{ $comment->comment }}</p>
                            <ul>
                                <li><a href="single.html">Reply</a></li>
                            </ul>

                            @foreach($comment->replies as $reply)

                            <div class="media response-info response-info-reply">
                                <div class="media-left response-text-left">
                                    <a href="#">

                                        <div class="media-object img" style="background-image: url({{ isset($reply->user->photo->file_path) ? asset($reply->user->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }})"></div>
                                    </a>
                                    <h5 class="comment-author"></h5>
                                </div>
                                <div class="media-body response-text-right">
                                    <ul>
                                        <li><h5><a href="#">{{ $comment->user->firstname }}</a></h5></li>
                                        <li>Sep 21, 2015</li>
                                    </ul>

                                    <p>{{ $reply->reply }}</p>

                                    <ul>
                                        <li><a href="single.html">Reply</a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"> </div>
                            </div>

                            @endforeach

                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    @endforeach

                    </div>



                </div>

            </div>
        </div>
    </div>
</div>




@endsection
