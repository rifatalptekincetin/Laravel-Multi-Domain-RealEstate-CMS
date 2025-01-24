<section class="hero-section gray-bg">
    <div class="bg-wrap">
        <div class="half-hero-bg-media full-height">
            <div class="slider-progress-bar">
                <span>
                    <svg class="circ" width="30" height="30">
                        <circle class="circ2" cx="15" cy="15" r="13" stroke="rgba(255,255,255,0.4)" stroke-width="1" fill="none"/>
                        <circle class="circ1" cx="15" cy="15" r="13" stroke="#fff" stroke-width="2" fill="none"/>
                    </svg>
                </span>
            </div>
            <div class="slideshow-container" >
                @foreach($data["slide"] as $key=>$slide)
                <div class="slideshow-item">
                    <div class="bg"  data-bg="{{ get_image_url($slide["image_id"]) }}"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="hero-title hero-title_small">
            <ul class="hero-buttons">
            @foreach($data['buttons'] as $button)
                <li><a href="{{ $button['link'] }}" class="hero-button">
                    <img src="{{ get_image_url($button['image_id'],'thumbnail_url') }}" alt="{{ $button['title'] }}">
                    <span class="hero-button-title">{{ $button['title'] }}</span>
                </a></li>
            @endforeach
            </ul>
        </div>
        <div class="main-search-input-wrap shadow_msiw">
            <div class="main-search-input fl-wrap">
                <div class="main-search-input-item">
                    <input type="text" class="search-suggest" placeholder="Adres, İl, Kategori..." value=""/>
                    <div class="search-suggest-results">
                    </div>
                </div>
                <button class="main-search-button color-bg"> <i class="far fa-search"></i> </button>
            </div>
        </div>
    </div>
</section>