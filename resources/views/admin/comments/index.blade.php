@extends('layouts.admin')

@section('content')

<article class="content items-list-page comments-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Comments

                    </h3>

                    <div class="statistics">
                        <span><a href="{{ url('admin/comments') }}">All</a> ({{ count($comment_all) }})</span>
                        <span><a href="{{ url('admin/comments?status=approved') }}">Approved</a> ({{ count($comment_approved) }})</span>
                        <span><a href="{{ url('admin/comments?status=unapproved') }}">Unapproved</a> ({{ count($comment_unapproved) }})</span>
                    </div>

                </div>
            </div>
            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif
        </div>

        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..." name="search"> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    </span> </div>
            </form>
        </div>

       @if(isset($post_single))
        <h4 class="sub-title">
            Comments on: <a href="{{ route('admin.posts.edit', $post_single->id) }}">{{ $post_single->title }}</a>
        </h4>
        @endif

    </div>



    {{ method_field('PUT') }}

    <form action="/admin/comments/bulkactions" method="post" id="bulk-action-form">

        {{ csrf_field() }}


    <div class="card items">
        <ul class="item-list striped">
            <li class="item item-list-header hidden-sm-down">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox">
                        <span></span>
                        </label> </div>
                    <div class="item-col item-col-header item-col-title">
                        <div> <span>Author</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-sales">
                        <div> <span>Comment</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"> <span>In Response To</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-reply">
                        <div class="no-overflow"> <span>Replies</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"> <span>Submitted On</span> </div>
                    </div>

                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                </div>
            </li>
            @if(isset($comments))
            @foreach($comments as $comment)

            <li class="item {{ 'comment-number-' . $comment->id }} {{ $comment->is_active == 0 ? 'unapproved-item' : '' }}">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox" name="checkboxCommentsArray[]" value="{{ $comment->id }}">
                        <span></span>
                        </label>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Author</div>
                        <div>
                            <a href="{{ route('admin.users.edit', $comment->user->id) }}">
                                <h4 class="item-title">
                                    {{ $comment->user->username }}
                                </h4>  </a>
                        </div>
                    </div>
                    <div class="item-col item-col-sales">
                        <div class="item-heading">Comment</div>
                        <div class="comment-text">{{ $comment->comment }}</div>
                        <div class="edit-comment-section" id="{{ 'edit-comment-section-' . $comment->id }}" method="POST">
                           <textarea class="comment-text form-control boxed edit-comment-text">{{ $comment->comment }}</textarea>
                            <button class="btn btn-primary btn-sm btn-save-comment" data-link="{{ url('admin/comments/' . $comment->id) }}" type="submit">Save</button>
                           <span class="btn btn-danger btn-sm btn-cancel-comment">Cancel</span>
                       </div>


                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">In Response To</div>
                        <div class="categories-tags">
                            @if (isset($comment->post))
                            <a href="{{ route('admin.posts.edit', $comment->post->id) }}">{{ $comment->post->title }}</a>
                            @endif

                        </div>
                    </div>
                    <div class="item-col item-col-reply no-overflow">
                        <div class="item-heading">Replies</div>
                        <div class="no-overflow">
                            @if (count($comment->replies))
                            <a href="{{ url('admin/comment/replies?comment=') . $comment->id }}" class="comment-count">{{ count($comment->replies) }}
                                    @if(count($comment->repliesUnapproved))
                                    <span class="unapproved-count">{{ count($comment->repliesUnapproved) }}</span>
                                    @endif
                                </a>
                            @else
                                &mdash;
                            @endif
                        </div>
                    </div>
                    <div class="item-col item-col-category no-overflow">
                        <div class="item-heading">Submitted On</div>
                        <div class="no-overflow item-date">
                            {{ $comment->created_at->timezone('Europe/Moscow')->format('M d, Y - H:i:s') }}
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

                                    @if ($comment->id != 1)
                                    <li>
                                       <a class="remove remove-item remove-comment" data-link="{{ url('admin/comments/' .$comment->id) }}" data-id="{{ $comment->id }}"> <i class="fa fa-trash-o"></i> </a>

                                    </li>
                                    @endif

                                    <li>
                                        <a class="edit btn-edit-comment edit-comment" data-edit-comment-id="{{ $comment->id }}"> <i class="fa fa-pencil"></i> </a>
                                    </li>

                                    <li>
                                        @if($comment->is_active != 1)
                                        <a class="edit unapprove unapprove-comment" data-action="{{ '/admin/comments/unapprove/' . $comment->id }}" style="display : none"> <i class="fa fa-thumbs-down"></i> </a>
                                        <a class="edit approve approve-comment" data-action="{{ '/admin/comments/approve/' . $comment->id }}"> <i class="fa fa-thumbs-up"></i> </a>

                                        @else
                                        <a class="edit approve approve-comment" data-action="{{ '/admin/comments/approve/' . $comment->id }}" style="display : none"> <i class="fa fa-thumbs-up"></i> </a>
                                        <a class="edit unapprove unapprove-comment" data-action="{{ '/admin/comments/unapprove/' . $comment->id }}"> <i class="fa fa-thumbs-down"></i> </a>
                                        @endif
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
            <button type="submit" class="dropdown-item" name="approve"><i class="fa fa-thumbs-up icon"></i> Approve</button>
            <button type="submit" class="dropdown-item" name="unapprove"><i class="fa fa-thumbs-down icon"></i> Unapprove</button>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".comfirm-bulk-delete" id="bulk-delete"><i class="fa fa-close icon"></i> Delete</a>
        </div>
    </div>


    </form>



    <nav class="text-xs-right">

        {!! $comments->appends([$param => $param_val])->render() !!}


    </nav>


</article>

@endsection
