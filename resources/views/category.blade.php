@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">{{ isset($category) ? $category->name : '' }}</li>
</ol>

<div class="col-md-8 content-left category-page">
    <div class="articles sports">
        <header>
            <h3 class="title-head">{{ $category->name }}</h3>
        </header>

        @if(isset($posts))
            @foreach($posts as $post)
            <div class="article">
                <div class="article-left">
                    <a href="single.html"><img src="{{ isset($post->photo) ? asset($post->photo->file_path) : '' }}"></a>
                </div>
                <div class="article-right">
                    <div class="article-title">
                        <p>On Feb 25, 2015 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>104 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>52</a></p>
                        <a class="title" href="single.html"> {{ $post->title }}</a>
                    </div>
                    <div class="article-text">
                        <p>The standard chunk of Lorem Ipsum used since the 1500s. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" exact original.....</p>
                        <a href="single.html"><img src="{{ asset('assets/more.png') }}" alt="" /></a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            @endforeach
        @endif

        {{ $posts->links() }}



    </div>
    <div class="latest-articles">
        <div class="main-title-head">
            <header>
                <h3 class="title-head">What's Hot</h3>
            </header>
        </div>
        <div class="world-news-grids">
            <div class="world-news-grid">
                <img src="{{ asset('assets/tech1.jpg') }}" alt="" />
                <a href="single.html" class="title">Lorem ipsum dolor sit amet, consectetur </a>
                <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor eu mattis.</p>
                <a class="reu" href="single.html"><img src="{{ asset('assets/more.png') }}" alt="" /></a>
            </div>
            <div class="world-news-grid">
                <img src="{{ asset('assets/tech5.jpg') }}" alt="" />
                <a href="single.html" class="title">Lorem ipsum dolor sit amet, consectetur </a>
                <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor eu mattis.</p>
                <a class="reu" href="single.html"><img src="{{ asset('assets/more.png') }}" alt="" /></a>
            </div>
            <div class="world-news-grid">
                <img src="{{ asset('assets/tech6.jpg') }}" alt="" />
                <a href="single.html" class="title">Lorem ipsum dolor sit amet, consectetur </a>
                <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor eu mattis.</p>
                <a class="reu" href="single.html"><img src="{{ asset('assets/more.png') }}" alt="" /></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>



@endsection
