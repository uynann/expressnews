@extends('layouts.admin')

@section('content')

<article class="content items-list-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Users
                        <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-sm rounded-s">
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
                    <div class="item-col item-col-header fixed item-col-img md">
                        <div> <span>Picture</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-title">
                        <div> <span>Firstname</span> </div>
                    </div>
                    <div class="item-col item-col-header item-col-sales">
                        <div> <span>Lastname</span> </div>
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
                            <input type="checkbox" class="checkbox">
                            <span></span>
                            </label> </div>
                        <div class="item-col fixed item-col-img md">
                            <a href="item-editor.html">
                                <div class="item-img rounded" style="background-image: url({{ isset($user->photo->file_path) ? asset($user->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }})"></div>
                            </a>
                        </div>
                        <div class="item-col fixed pull-left item-col-title">
                            <div class="item-heading">Firstname</div>
                            <div>
                                <a href="item-editor.html" class="">
                                    <h4 class="item-title">
                                        {{$user->firstname}}
                                    </h4> </a>
                            </div>
                        </div>
                        <div class="item-col item-col-sales">
                            <div class="item-heading">Lastname</div>
                            <div> {{$user->lastname}} </div>
                        </div>
                        <div class="item-col item-col-stats no-overflow">
                            <div class="item-heading">Email</div>
                            <div> <a href="">{{$user->email}} </a></div>
                        </div>
                        <div class="item-col item-col-category no-overflow">
                            <div class="item-heading">Role</div>
                            <div class="no-overflow"> {{$user->role->name}} </div>
                        </div>
                        <div class="item-col item-col-author">
                            <div class="item-heading">Posts</div>
                            <div class="no-overflow"> <a href=""></a> </div>
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
                                        <li>
                                            <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal"> <i class="fa fa-trash-o "></i> </a>
                                        </li>
                                        <li>
                                            <a class="edit" href="item-editor.html"> <i class="fa fa-pencil"></i> </a>
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
