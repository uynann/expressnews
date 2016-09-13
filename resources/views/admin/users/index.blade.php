@extends('layouts.admin')

@section('content')

<article class="content items-list-page users-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Users
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm rounded-s">
                            Add New
                        </a>

                        <div class="action filter-action dropdown">
                            <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Choose role...
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="{{ url('admin/users') }}">All roles</a>

                                @if(isset($roles))
                                @foreach($roles as $role)
                                <a class="dropdown-item" href="{{ url('admin/users?role=' . str_slug($role->name)) }}">{{ $role->name }}</a>

                                @endforeach
                                @endif
                            </div>
                        </div>

                    </h3>

                    <div class="statistics">
                        <span><a href="{{ url('admin/users') }}">All</a> ({{ count($user_all) }})</span>
                        <span><a href="{{ url('admin/users?role=administrator') }}">Administrator</a> ({{ count($user_admin) }})</span>
                        <span><a href="{{ url('admin/users?role=author') }}">Author</a> ({{ count($user_author) }})</span>
                        <span><a href="{{ url('admin/users?role=subscriber') }}">Subscriber</a> ({{ count($user_subs) }})</span>

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

    </div>



    <form action="/admin/users/bulkactions" method="post" id="bulk-action-form">

        {{ csrf_field() }}

    <div class="card items">
        <ul class="item-list striped">
            <li class="item item-list-header hidden-sm-down">
                <div class="item-row">
                    <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                        <input type="checkbox" class="checkbox">
                        <span></span>
                        </label> </div>
                    <div class="item-col item-col-header fixed item-col-img md">
                        <div> <span>Picture</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-title">
                        <div> <span>Username</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-sales">
                        <div> <span>Name</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"> <span>Email</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"> <span>Role</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-author">
                        <div class="no-overflow"> <span>Posts</span> </div>
                    </div>

                    <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                </div>
            </li>
            @if($users)
            @foreach($users as $user)

                <li class="item">
                    <div class="item-row">
                        <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                            <input type="checkbox" class="checkbox" name="checkboxUsersArray[]" value="{{ $user->id }}">
                            <span></span>
                            </label> </div>
                        <div class="item-col fixed item-col-img md">
                            <a href="item-editor.html">
                                <div class="item-img rounded" style="background-image: url(@if(isset($user->photo->file_path))
                                {{ file_exists(public_path('images/thumbs/' . $user->photo->file_name)) ?  asset('images/thumbs/' . $user->photo->file_name) : asset($user->photo->file_path) }} @else
                                {{ 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }} @endif)"></div>
                            </a>
                        </div>
                        <div class="item-col fixed pull-left item-col-title">
                            <div class="item-heading">Username</div>
                            <div>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="">
                                    <h4 class="item-title">
                                        {{$user->username}}
                                    </h4> </a>
                            </div>
                        </div>
                        <div class="item-col item-col-sales">
                            <div class="item-heading">Name</div>
                            <div> {{$user->firstname . ' ' . $user->lastname}} </div>
                        </div>
                        <div class="item-col item-col-stats no-overflow">
                            <div class="item-heading">Email</div>
                            <div> <a href="">{{$user->email}} </a></div>
                        </div>
                        <div class="item-col item-col-category no-overflow">
                            <div class="item-heading">Role</div>
                            <div class="no-overflow"> <a href="{{ url('admin/users?role=' . str_slug($user->role->name)) }}">{{$user->role->name}} </a></div>
                        </div>
                        <div class="item-col item-col-author">
                            <div class="item-heading">Posts</div>
                            <div class="no-overflow"> <a href="{{ route('admin.posts.index') }}">{{ count($user->posts) }} </a></div>
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

                                       @if (($user->id != 1) && ($user->id != 14))
                                        <li>
                                            <a class="remove remove-item" href="#" data-toggle="modal" data-target="#confirm-modal"> <i class="fa fa-trash-o " data-item-id="{{ $user->id }}"></i> </a>
                                        </li>
                                        @endif

                                        <li>
                                            <a class="edit" href="{{route('admin.users.edit', $user->id) }}"> <i class="fa fa-pencil"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach

            @if (count($users) == 0)
            <p class="not-found">No user found!</p>
            @endif

            @endif
        </ul>
    </div>


    <div class="action bulk-action dropdown">
        <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            More actions...
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">

           @foreach($roles as $role)
                <button type="submit" class="dropdown-item" name="{{ $role->name }}"><i class="fa fa-pencil-square-o icon"></i> Make {{ $role->name }}</button>
           @endforeach
            <a class="dropdown-item" href="#" data-toggle="modal" data-target=".comfirm-bulk-delete" id="bulk-delete"><i class="fa fa-close icon"></i> Delete</a>

        </div>
    </div>


    </form>



    <nav class="text-xs-right">
        {!! $users->appends([$param => $param_val])->render() !!}
    </nav>

    <div class="note-on-page">
        <span><strong><em>Note:</em></strong></span>
        <span><em>Deleting a user does not delete the his or her posts. Instead, posts that were belonged to the deleted user are set to the user Unknown.</em></span>
    </div>


</article>

@endsection
