<div class="latest-articles">
    <div class="main-title-head">
        <header>
            <h3 class="title-head">What's Hot</h3>
        </header>
    </div>
    
    <div class="world-news-grids">
    
    @if(count($hot_posts))

    @foreach($hot_posts as $post)
    <div class="world-news-grid">
        <img src="@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif" alt="" />
        <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}" class="title" style="font-size: 1.2em">{{ $post->title }}</a>
        <p>{!! html_entity_decode(str_limit($post->body, 120)) !!}</p>
        <a class="reu" href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"><img src="{{ asset('assets/more.png') }}" alt="" /></a>
    </div>
    
    @endforeach

    @endif
    </div>
</div>