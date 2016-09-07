<div class="side-bar-articles">

    @if(count($most_comment_posts))

    @foreach($most_comment_posts as $post)

    <div class="side-bar-article">
        <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}"><img src="@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif" alt="" /></a>
        <div class="side-bar-article-title">
            <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}">{{ $post->title }}</a>
        </div>
    </div>

    @endforeach

    @endif


</div>
