
<section class="hidden-section single-par2  " data-scrollax-parent="true">
    <div class="bg-wrap bg-parallax-wrap-gradien">
        <div class="bg par-elem "  data-bg="{{ $image }}" data-scrollax="properties: { translateY: '30%' }"></div>
    </div>
    <div class="container">
        <div class="section-title center-align big-title">
            <h2><span>{{ $title }}</span></h2>
            @if(isset($description))
            <h4>{{ $description }}</h4>
            @endif
        </div>
        <div class="scroll-down-wrap">
            <div class="mousey">
                <div class="scroller"></div>
            </div>
            <span>İçerik için aşağı kaydırın</span>
        </div>
    </div>
</section>
