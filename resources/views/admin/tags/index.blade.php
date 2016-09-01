@extends('layouts.admin')

@section('content')

<article class="content items-list-page categories-list-create-page">
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">
                        Tags

                    </h3>

                </div>
            </div>
            @if(session('status'))
            <div class="status update-status">{{ session('status') }} <span><i class="fa fa-times" aria-hidden="true"></i></span></div>
            @endif
        </div>


    </div>

    <div class="row">
        <div class="col-sm-5">
            <div class="categories-create">
                <div>
                    <h6 class="title-sm">Add New Tags</h6>
                </div>

                {!! Form::open(['method'=>'POST', 'action'=>'AdminTagsController@store', 'name'=>'item', 'class'=>'form-horizontal', 'id'=>'add-category-form']) !!}

                <div class="card card-block">
                    <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Name:', ['class'=>'col-sm-3 form-control-label form-controll-label-sm text-xs-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('name', null, ['class'=>'form-control form-controll-sm boxed']) !!}

                            @if ($errors->has('name'))
                            <span class="help-block">
                                <small>{{ $errors->first('name') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('description', 'Description:', ['class'=>'col-sm-3 form-control-label form-controll-label-sm text-xs-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('description', null, ['class'=>'form-control boxed', 'rows'=>'5']) !!}
                            <span class="help-block" style="display: block; color: #4f5f6f">
                                <small><em>The description is optional.</em></small>
                            </span>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-9 col-sm-offset-3">
                            {!! Form::submit('Add new tag', ['class'=>'btn btn-primary btn-sm']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>

        <div class="col-sm-7">
            <div class="row categories-list">
                <div class="col-sm-6">
                    <div class="statistics">
                        @if( count($tag_all) == 1)
                            <span>{{ count($tag_all) }} item</span>
                        @elseif (count($tag_all) > 1)
                            <span>{{ count($tag_all) }} items</span>
                        @endif

                    </div>

                </div>

                <div class="col-sm-6">
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

            </div>


            <form action="/admin/tags/bulkactions" method="post" id="bulk-action-form">
                {{ csrf_field() }}


            <div class="card items">
                <ul class="item-list striped">
                    <li class="item item-list-header hidden-sm-down">
                        <div class="item-row">
                            <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                                <input type="checkbox" class="checkbox">
                                <span></span>
                                </label> </div>
                            <div class="item-col item-col-header item-col-sales">
                                <div> <span>Name</span> </div>
                            </div>
                            <div class="item-col item-col-header item-col-stats">
                                <div class="no-overflow"> <span>Description</span> </div>
                            </div>
                            <div class="item-col item-col-header item-col-category">
                                <div class="no-overflow"> <span>Count</span> </div>
                            </div>

                            <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                        </div>
                    </li>
                    @if(isset($tags))
                    @foreach($tags as $tag)

                    <li class="item">
                        <div class="item-row">
                            <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                                <input type="checkbox" class="checkbox" name="checkboxTagsArray[]" value="{{ $tag->id }}">
                                <span></span>
                                </label>
                            </div>

                            <div class="item-col item-col-sales">
                                <div class="item-heading">Name</div>
                                <div> <a href="{{route('admin.tags.edit', $tag->id) }}">{{ $tag->name }} </a></div>
                            </div>
                            <div class="item-col item-col-stats no-overflow">
                                <div class="item-heading">Description</div>
                                <div class="categories-tags">
                                    {{ $tag->description }}

                                </div>
                            </div>
                            <div class="item-col item-col-category no-overflow">
                                <div class="item-heading">Count</div>
                                <div class="categories-tags">
                                    <a href="{{ url('admin/posts?tag=' . str_slug($tag->name)) }}">{{ count($tag->posts) }}
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

                                                <li>
                                                    <a class="remove remove-item" href="#" data-toggle="modal" data-target="#confirm-modal"> <i class="fa fa-trash-o " data-item-id="{{ $tag->id }}"></i> </a>
                                                </li>

                                                <li>
                                                    <a class="edit" href="{{route('admin.tags.edit', $tag->id) }}"> <i class="fa fa-pencil"></i> </a>
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
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target=".comfirm-bulk-delete" id="bulk-delete"><i class="fa fa-close icon"></i> Delete</a>
                    </div>
                </div>


            </form>


            <nav class="text-xs-right">
                {!! $tags->appends([$param => $param_val])->render() !!}
            </nav>
        </div>
    </div>



</article>


@endsection
