<div class="tags">
    <header>
        <h3 class="title-head">Tags</h3>
    </header>
    <p>

        @if(isset($tags))
            @foreach($tags as $key=>$tag)
                <a class="{{ 'tag' . ($key + 1) }}" href="single.html">{{ $tag->name }}</a>
            @endforeach

        @endif

    </p>
</div>
