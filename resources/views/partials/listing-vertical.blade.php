<div class="listing-item">
    <article class="geodir-category-listing fl-wrap">
        <div class="geodir-category-img fl-wrap">
            <a href="{{$_listing->url()}}" class="geodir-category-img_item">
                <img src="{{$_listing->image->medium_url}}" alt="{{$_listing->image->alt}}">
                <div class="overlay"></div>
            </a>
            <div class="geodir-category-location">
                @if(isset($_listing_key))
                <a href="#{{$_listing_key}}" class="map-item tolt" data-microtip-position="top-left" data-tooltip="Haritada Aç">
                    <i class="fas fa-map-marker-alt"></i>
                    {{$_listing->district->title}},
                    {{$_listing->city->title}},
                    {{$_listing->state->title}}
                </a>
                @else
                <a href="#" class="single-map-item tolt" data-newlatitude="{{ $_listing->latitude }}" data-newlongitude="{{ $_listing->longitude }}"
                    data-microtip-position="top-left" data-tooltip="Haritada Aç"><i class="fas fa-map-marker-alt"></i>
                    <span>
                    {{$_listing->district->title}},
                    {{$_listing->city->title}},
                    {{$_listing->state->title}}
                    </span></a>
                @endif
            </div>
            <ul class="list-single-opt_header_cat">
                @foreach($_listing->categories()->orderBy('parent_id','asc')->get() as $key=>$category)
                    <li @if(!$key) style="display:none;" @endif><a href="{{$category->url()}}" class="cat-opt blue-bg">{{$category->title}}</a></li>
                @endforeach
            </ul>

            <a href="javascript:;" class="geodir_save-btn tolt add_wishlist" data-slug="{{$_listing->slug}}" data-microtip-position="left" data-tooltip="Kaydet"><span>
                <i class="fal fa-heart"></i></span></a>

            <a href="javascript:;" class="compare-btn tolt add_compare" data-slug="{{$_listing->slug}}" data-microtip-position="left" data-tooltip="Karşılaştır"><span>
                <i class="fal fa-random"></i></span></a>

            <div class="geodir-category-listing_media-list">
                <span><i class="fas fa-camera"></i> {{$_listing->images->count()}}</span>
            </div>
        </div>
        <div class="geodir-category-content fl-wrap">
            <h3 class="title-sin_item"><a href="{{$_listing->url()}}">{{ $_listing->title }}</a></h3>
            <div class="geodir-category-content_price">
                {{number_format($listing->price,2,',','.')}} ₺ @if($listing->price_type == 'monthly') / Ay @elseif($listing->price_type == 'yearly') / Yıl @endif
            </div>
            <p>{!! mb_strtolower( mb_substr( strip_tags($_listing->content), 0, 90) ) !!}</p>
            <div class="geodir-category-footer fl-wrap">
                <a href="{{ $_listing->user->url() }}" class="gcf-company">
                    <img src="{{ $_listing->user->image->thumbnail_url }}" alt="{{ $_listing->user->name }}">
                    <span>
                    {{ $_listing->user->name }}
                    </span>
                </a>
                <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Harika"
                    data-starrating2="5"></div>
            </div>
        </div>
    </article>
</div>