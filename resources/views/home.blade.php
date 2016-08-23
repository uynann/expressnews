@extends('layouts.app')

@section('content')

<div class="sports-top row">

   @if(isset($categories))
       @foreach($categories as $category)
            <div class="col-md-6">
                <div class="cricket">
                    <header>
                        <a href="{{ route('category', preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $category->name)))) }}" class="title-head-link"><h3 class="title-head">{{ $category->name }}</h3></a>
                    </header>

                    @foreach($category->posts->take(-4)->sortByDesc('id') as $post)
                        @if($category->posts->take(-4)->sortByDesc('id')->first() === $post)
                            <div class="c-sports-main">
                                <div class="c-image">
                                    <a href="single.html"><img src="@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif" alt="" /></a>
                                </div>
                                <div class="c-text">

                                    <a class="power" href="{{ route('show', ['category'=>preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $category->name))), 'id_title'=>$post->id . '-' . preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post->title)))]) }}">{{ $post->title }}</a>


                                    <p class="date">On {{ $post->created_at }}</p>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @else
                            <div class="s-grid-small">
                                <div class="sc-text">

                                    <a class="power" href="{{ route('show', ['category'=>preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $category->name))), 'id_title'=>$post->id . '-' . preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post->title)))]) }}">{{ $post->title }}</a>


                                    <p class="date">On {{ $post->created_at }}</p>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        @endforeach

    @endif

</div>

@endsection
