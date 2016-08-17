@extends('layouts.admin')

@section('content')

<article class="content items-list-page posts-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Posts
                        <a href="{{route('admin.posts.create')}}" class="btn btn-primary btn-sm rounded-s">
                            Add New
                        </a><div class="action dropdown">
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
                        <div> <span>Title</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-sales">
                        <div> <span>Author</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"> <span>Categories</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"> <span>Tags</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-date">
                        <div> <span>Published</span> </div>
                    </div>

                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                </div>
            </li>
            @if(isset($posts))
            @foreach($posts as $post)

            <li class="item">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox" name="checkboxUsersArray[]" value="{{ $post->id }}">
                        <span></span>
                        </label> </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Title</div>
                        <div>
                            <a href="item-editor.html">
                                <h4 class="item-title">
                                    {{$post->title}}
                                </h4>  </a>
                                @if($post->status == 'draft')
                            <span style="font-weight:bold"> &mdash; Draft </span>
                                @endif
                        </div>
                    </div>
                    <div class="item-col item-col-sales">
                        <div class="item-heading">Author</div>
                        <div> <a href="">
                        @if($post->user_id == 14)
                            {{$post->user->firstname}}
                        @else
                            {{$post->user->firstname . ' ' . $post->user->lastname}}
                        @endif
                         </a></div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Categories</div>
                        <div class="categories-tags">
                        @if (count($post->categories))
                            @foreach($post->categories as $category)
                                <a href=""> {{ $category->name }} </a> &nbsp;
                            @endforeach
                        @endif

                        </div>
                    </div>
                    <div class="item-col item-col-category no-overflow">
                        <div class="item-heading">Tags</div>
                        <div class="categories-tags">
                        @if (count($post->tags))
                            @foreach($post->tags as $tag)
                                <a href=""> {{ $tag->name }} </a> &nbsp;
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <div class="item-col item-col-date">
                        <div class="item-heading">Published</div>
                        <div class="no-overflow"> {{ $post->created_at }}</div>
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

                                    @if ($post->id != 1)
                                    <li>
                                        <a class="remove remove-item" href="#" data-toggle="modal" data-target="#confirm-modal"> <i class="fa fa-trash-o " data-item-id="{{ $post->id }}"></i> </a>
                                    </li>
                                    @endif

                                    <li>
                                        <a class="edit" href="{{route('admin.posts.edit', $post->id) }}"> <i class="fa fa-pencil"></i> </a>
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

    <nav class="text-xs-right">
        <ul class="pagination">
            <li class="page-item"> <a class="page-link" href="">
                Prev
                </a> </li>
            <li class="page-item active"> <a class="page-link" href="">
                1
                </a> </li>
            <li class="page-item"> <a class="page-link" href="">
                2
                </a> </li>
            <li class="page-item"> <a class="page-link" href="">
                3
                </a> </li>
            <li class="page-item"> <a class="page-link" href="">
                4
                </a> </li>
            <li class="page-item"> <a class="page-link" href="">
                5
                </a> </li>
            <li class="page-item"> <a class="page-link" href="">
                Next
                </a> </li>
        </ul>
    </nav>
</article>

@endsection
