<article class="post-article fl-wrap">
    <div class="list-single-main-media fl-wrap">
        <img src="{{ $post->image->medium_url }}" class="respimg" alt="{{ $post->image->alt }}">
    </div>
    <div class="list-single-main-item fl-wrap block_box">
        <h2 class="post-opt-title"><a href="{{$post->url(get_subdomain())}}">{{ $post->title }}</a></h2>
        <p>
        {{ mb_substr( strip_tags($post->content), 0, 200) }}...
        </p>
        <span class="fw-separator fl-wrap"></span>
        <a href="{{$post->url(get_subdomain())}}" class="btn color-bg float-btn small-btn">Devamını Oku</a>
    </div>
</article>