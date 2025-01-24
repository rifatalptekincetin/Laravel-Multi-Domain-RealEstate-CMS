@if($data["slide"])
<section class="no-padding-section">
    <div class="hero-slider-wrap carousel-wrap fl-wrap">
        <div class="hero-slider carousel">
            @foreach($data["slide"] as $key=>$slide)
            <div class="hero-slider-item fl-wrap">
                <div class="bg" data-bg="{{ get_image_url($slide["image_id"]) }}"></div>
                <div class="overlay"></div>
                <div class="hero-listing-item">
                    <div class="container">
                        <h2><a href="{{ $slide["button_link"] }}">{{ $slide["title"] }}</a></h2>
                        <div class="clearfix"></div>
                        <p>{{ $slide["description"] }}</p>
                        <div class="clearfix"></div>
                        <a href="{{ $slide["button_link"] }}" class="btn color-bg float-btn">{{ $slide["button_text"] }}</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="hs-btn hs-btn_prev color-bg swiper-button-prev"><i class="far fa-angle-left"></i></div>
        <div class="hs-btn hs-btn_next color-bg swiper-button-next"><i class="far fa-angle-right"></i></div>
    </div>
</section>
@endif