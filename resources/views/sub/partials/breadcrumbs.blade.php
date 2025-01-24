
<div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
    <div class="container">
        <div class="breadcrumbs-list">
            @foreach($links as $link)
                <a href="{{ $link["url"] }}">{{$link["title"]}}</a>
            @endforeach
            <span>{{ $title }}</span>
        </div>
        <div class="share-holder hid-share">
            <a href="#" class="share-btn showshare sfcs">  <i class="fas fa-share-alt"></i>  Paylaş   </a>
            <div class="share-container  isShare"></div>
        </div>
    </div>
</div>
