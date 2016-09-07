@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Search</li>
</ol>

<div class="articles sports search-page">
    <header>
        <h3 class="title-head">Search results</h3>
        <form id="search-form">
            <input id="email" type="text" class="search-bar" name="search" value="{{ isset($search)? $search : '' }}">
            <button type="submit" class="submit-search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

    </header>
    @if(isset($posts_all))
    @if(count($posts_all) == 1)
    <p class="result-count">1 result</p>
    @elseif(count($posts_all) > 1 && count($posts_all) <= 10)
    <p class="result-count">{{ count($posts) }} results</p>
    @elseif(count($posts_all) > 10)
    <p class="result-count">More than {{ floor(count($posts_all) / 10) * 10 }} results</p>
    @else
    <p class="result-count">No posts found</p>
    @endif

    @endif

    @if(isset($posts))
    @foreach($posts as $post)
    <div class="article">
        <div class="header">
            <a class="title" href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"> {{ $post->title }}</a>
        </div>
        <div class="clearfix"></div>
        <div class="article-left">
            <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"><img src="{{ isset($post->photo) ? asset($post->photo->file_path) : '' }}"></a>
        </div>
        <div class="article-right">
            <div class="article-text">
                <p>{!! html_entity_decode(str_limit($post->body, 160)) !!}</p>
            </div>
            <div class="article-title">
                <p>On {{ $post->created_at }} <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>{{ count($post->commentsApproved) }} </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>{{ $post->view_count }} </a><a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>52</a></p>

            </div>

        </div>
        <div class="clearfix"></div>
    </div>

    @endforeach

{!! $posts->appends([$param => $param_val])->render() !!}

    @endif





</div>

@endsection
