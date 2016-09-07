@extends('layouts.admin')

@section('content')

<article class="content items-list-page comments-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Comment Replies

                    </h3>

                    <div class="statistics">
                        <span><a href="{{ url('admin/comment/replies') }}">All</a> ({{ count($reply_all) }})</span>
                        <span><a href="{{ url('admin/comment/replies?status=approved') }}">Approved</a> ({{ count($reply_approved) }})</span>
                        <span><a href="{{ url('admin/comment/replies?status=unapproved') }}">Unapproved</a> ({{ count($reply_unapproved) }})</span>
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

        @if(isset($comment_single))
        <h4 class="sub-title">
            Comments on: <span>{{ $comment_single->comment }}</span>
        </h4>
        @endif

    </div>



    {{ method_field('PUT') }}

    <form action="/admin/comment/replies/bulkactions" method="post" id="bulk-action-form">

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
                        <div> <span>Reply</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"> <span>In Response To</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"> <span>Submitted On</span> </div>
                    </div>

                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                </div>
            </li>

            @if(isset($replies))
            @foreach($replies as $reply)

            <li class="item {{ 'comment-number-' . $reply->id }} {{ $reply->is_active == 0 ? 'unapproved-item' : '' }}">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox" name="checkboxCommentRepliesArray[]" value="{{ $reply->id }}">
                        <span></span>
                        </label> </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Author</div>
                        <div>
                            <a href="{{ route('admin.users.edit', $reply->user->id) }}">
                                <h4 class="item-title">
                                    {{$reply->user->username}}
                                </h4>  </a>
                        </div>
                    </div>
                    <div class="item-col item-col-sales">
                        <div class="item-heading">Reply</div>
                        <div class="comment-text">{{ $reply->reply }}</div>

                        <div class="edit-comment-section" id="{{ 'edit-comment-section-' . $reply->id }}" method="POST">
                            <textarea class="comment-text form-control boxed edit-comment-text">{{ $reply->reply }}</textarea>
                            <button class="btn btn-primary btn-sm btn-save-comment" data-link="{{ url('admin/comment/replies/' . $reply->id) }}" type="submit">Save</button>
                            <span class="btn btn-danger btn-sm btn-cancel-comment">Cancel</span>
                        </div>


                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">In Response To</div>
                        <div class="categories-tags">
                            @if (isset($reply->comment))
                            <a href="">{{ $reply->comment->comment }}</a>
                            @endif

                        </div>
                    </div>
                    <div class="item-col item-col-category no-overflow">
                        <div class="item-heading">Submitted On</div>
                        <div class="no-overflow item-date">
                            {{ $reply->created_at->timezone('Europe/Moscow')->format('M d, Y - H:i:s') }}
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

                                    @if ($reply->id != 1)
                                    <li>

                                        <a class="remove remove-item remove-comment" data-link="{{ url('admin/comment/replies/' .$reply->id) }}" data-id="{{ $reply->id }}"> <i class="fa fa-trash-o"></i> </a>

                                    </li>
                                    @endif

                                    <li>
                                        <a class="edit btn-edit-comment" data-edit-comment-id="{{ $reply->id }}"> <i class="fa fa-pencil"></i> </a>
                                    </li>

                                    <li>
                                        @if($reply->is_active != 1)
                                        <a class="edit unapprove unapprove-comment" data-action="{{ '/admin/comment/replies/unapprove/' . $reply->id }}" style="display : none"> <i class="fa fa-thumbs-down"></i> </a>
                                        <a class="edit approve approve-comment" data-action="{{ '/admin/comment/replies/approve/' . $reply->id }}"> <i class="fa fa-thumbs-up"></i> </a>

                                        @else
                                        <a class="edit approve approve-comment" data-action="{{ '/admin/comment/replies/approve/' . $reply->id }}" style="display : none"> <i class="fa fa-thumbs-up"></i> </a>
                                        <a class="edit unapprove unapprove-comment" data-action="{{ '/admin/comment/replies/unapprove/' . $reply->id }}"> <i class="fa fa-thumbs-down"></i> </a>
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


    <div class="action bulk-action dropdown reply-bulk-action">
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

        {!! $replies->appends([$param => $param_val])->render() !!}


    </nav>


</article>

@endsection
