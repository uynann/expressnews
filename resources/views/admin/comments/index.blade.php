@extends('layouts.admin')

@section('content')

<article class="content items-list-page comments-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Comments
                        <div class="action dropdown">
                        <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More actions...
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o icon"></i>Mark as a draft</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm-modal"><i class="fa fa-close icon"></i>Delete</a>
                        </div>
                        </div>
                    </h3>

                </div>
            </div>
            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif
        </div>

        <div class="items-search">
            <form class="form-inline">
                <div class="input-group"> <input type="text" class="form-control boxed rounded-s" placeholder="Search for..."> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                    </span> </div>
            </form>
        </div>

    </div>
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
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"> <span>Submitted On</span> </div>
                    </div>

                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                </div>
            </li>
            @if(isset($comments))
            @foreach($comments as $comment)

            <li class="item {{ 'comment-number-' . $comment->id }}">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox" name="checkboxUsersArray[]" value="{{ $comment->id }}">
                        <span></span>
                        </label>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Author</div>
                        <div>
                            <a href="item-editor.html">
                                <h4 class="item-title">
                                    {{ $comment->user->username }}
                                </h4>  </a>
                        </div>
                    </div>
                    <div class="item-col item-col-sales">
                        <div class="item-heading">Comment</div>
                        <div class="comment-text">{{ $comment->comment }}</div>
                        <form class="edit-comment-section" id="{{ 'edit-comment-section-' . $comment->id }}" method="POST">
                            {{ csrf_field() }}
                           <textarea name="comment" class="comment-text form-control boxed edit-comment-text">{{ $comment->comment }}</textarea>
                            <button class="btn btn-primary btn-sm btn-save-comment" data-link="{{ url('admin/comments/' . $comment->id) }}" type="submit">Save</button>
                           <span class="btn btn-danger btn-sm btn-cancel-comment">Cancel</span>
                       </form>


                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">In Response To</div>
                        <div class="categories-tags">
                            @if (isset($comment->post))
                            <a href="">{{ $comment->post->title }}</a>
                            @endif

                        </div>
                    </div>
                    <div class="item-col item-col-category no-overflow">
                        <div class="item-heading">Submitted On</div>
                        <div class="no-overflow">
                            {{ $comment->created_at }}
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

                                       <form method="POST">
                                           {{ csrf_field() }}
                                           <a class="remove remove-item remove-comment" data-link="{{ url('admin/comments/' .$comment->id) }}" data-id="{{ $comment->id }}"> <i class="fa fa-trash-o"></i> </a>
                                       </form>

                                    </li>
                                    @endif

                                    <li>
                                        <a class="edit btn-edit-comment" data-edit-comment-id="{{ $comment->id }}"> <i class="fa fa-pencil"></i> </a>
                                    </li>

{{--
                                    <li>
                                        <a class="edit" href="{{route('admin.comments.edit', $comment->id) }}"> Unapprove </a>
                                    </li>
--}}
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

    <nav class="text-xs-right">

        @if(isset($comments)) {{ $comments->links() }} @endif


    </nav>


</article>

@endsection
