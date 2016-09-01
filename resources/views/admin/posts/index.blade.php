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
                        </a>

                        <div class="action filter-action dropdown">
                            <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Choose category...
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="{{ url('admin/posts') }}">All categories</a>

                                @if(isset($categories))
                                @foreach($categories as $category)
                                <a class="dropdown-item" href="{{ url('admin/posts?category=' . str_slug($category->name)) }}">{{ $category->name }}</a>

                                @endforeach
                                @endif
                            </div>
                        </div>
                    </h3>

                    <div class="statistics">
                        <span><a href="{{ url('admin/posts?status=all') }}">All</a> ({{ count($post_all) }})</span>
                        <span><a href="{{ url('admin/posts?status=published') }}">Published</a> ({{ count($post_published) }})</span>
                        <span><a href="{{ url('admin/posts?status=draft') }}">Draft</a> ({{ count($post_draft) }})</span>
                        <span><a href="{{ url('admin/posts?status=trash') }}">Trash</a> ({{ count($post_trash) }})</span>
                    </div>

                </div>
            </div>
            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif
        </div>
        <div class="items-search">
            <form class="form-inline">
                <div class="input-group">
                   <input type="text" class="form-control boxed rounded-s" placeholder="Search for..." name="search">
                   <span class="input-group-btn">
                        <button class="btn btn-secondary rounded-s" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>

    </div>

    <form action="/admin/posts/bulkactions" method="post" id="bulk-action-form">

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
                        <input type="checkbox" class="checkbox" name="checkboxPostsArray[]" value="{{ $post->id }}">
                        <span></span>
                        </label> </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Title</div>
                        <div>
                            <a href="{{ route('admin.posts.edit', $post->id) }}">
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
                        <div> <a href="{{ route('admin.users.edit', $post->user->id) }}">
                            {{ $post->user->username }}
                         </a></div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Categories</div>
                        <div class="categories-tags">
                        @if (isset($post->category))
                            <a href="{{ url('admin/posts?category=' . str_slug($post->category->name)) }}"> {{ $post->category->name }} </a> &nbsp;
                        @endif

                        </div>
                    </div>
                    <div class="item-col item-col-category no-overflow">
                        <div class="item-heading">Tags</div>
                        <div class="categories-tags">
                        @if (count($post->tags))
                            @foreach($post->tags as $tag)
                            <a href="{{ url('admin/posts?tag=' . str_slug($tag->name)) }}"> {{ $tag->name }} </a> &nbsp;
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
                                        <a class="edit" href="{{ route('admin.posts.edit', $post->id) }}"> <i class="fa fa-pencil"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>



            @endforeach

            @if (count($posts) == 0)
                <p class="not-found">No post found!</p>
            @endif

            @endif

        </ul>


    </div>

        <div class="action bulk-action dropdown">
        <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            More actions...
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <button type="submit" class="dropdown-item" name="markDraft"><i class="fa fa-pencil-square-o icon"></i> Mark as a draft</button>
            <button type="submit" class="dropdown-item" name="publish"><i class="fa fa-share-square-o icon"></i> Publish</button>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".comfirm-bulk-delete" id="bulk-delete"><i class="fa fa-close icon"></i> Move to Trash</a>
        </div>
    </div>

    </form>

    <div class="modal fade comfirm-bulk-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4> </div>
                <div class="modal-body">
                    <p>Are you sure want to do this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="comfirm-bulk-delete">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <nav class="text-xs-right">

        {{ $posts->links() }}

    </nav>


</article>



@endsection
