<div class="row related-posts">
    <h4>Articles You May Like</h4>
    
    @foreach($similar_posts as $post)
        <div class="col-xs-6 col-md-3 related-grids">
            <a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}" class="thumbnail">
                <img src="@if(isset($post->photo)) {{ asset($post->photo->file_path) }} @endif" alt=""/>
            </a>
        <h5><a href="{{ route('show', ['category'=> $post->category->slug, 'id_title'=>$post->id . '-' . $post->slug]) }}">{{ $post->title }}</a></h5>
    </div>
    @endforeach
</div>