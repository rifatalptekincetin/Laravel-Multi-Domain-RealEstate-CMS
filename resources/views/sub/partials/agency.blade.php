<div class="listing-item">
    <article class="geodir-category-listing fl-wrap">
        <div class="geodir-category-img fl-wrap">
            <a href="{{ $_agency->url(get_subdomain()) }}" class="geodir-category-img_item">
            <img src="{{ $_agency->image->medium_url }}" alt="{{ $_agency->title }}">
            </a>
        </div>
        <div class="geodir-category-content fl-wrap">
            <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Onaylı"><i class="fal fa-user-check"></i></div>
            <div class="agent_card-title fl-wrap">
                <h4><a href="{{ $_agency->url(get_subdomain()) }}" >{{ $_agency->title }}</a></h4>
                <div class="geodir-category-location fl-wrap">
                    <a href="{{ $_agency->url(get_subdomain()) }}"><i class="fas fa-map-marker-alt"></i>  {{ $_agency->address ?? $_agency->state->title, $_agency->city->title, $_agency->district->title }}</a> 
                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                </div>
            </div>
            <p class="agency">
                {{ $_agency->about }}
            </p>
            <div class="small-facts fl-wrap">
                <ul>
                    <li><i class="fal fa-home"></i> <span><strong>{{ $_agency->listings()->count() }}</strong>İlan</span></li>
                    <li><i class="fal fa-users-class"></i> <span><strong>{{ $_agency->users()->count() }}</strong>Danışman</span></li>
                    <li><i class="fal fa-comment-alt"></i> <span><strong>0</strong>Yorum</span></li>
                </ul>
            </div>
            <div class="geodir-category-footer fl-wrap">
                <a href="{{ $_agency->url(get_subdomain()) }}" class="btn float-btn color-bg small-btn">Siteye Git</a>
                <a href="mailto:{{$_agency->email}}" class="tolt ftr-btn" data-microtip-position="top-left" data-tooltip="E-posta"><i class="fal fa-envelope"></i></a>
                <a href="tel:{{$_agency->phone}}" class="tolt ftr-btn" data-microtip-position="top-left" data-tooltip="Telefon"><i class="fal fa-phone"></i></a>	
            </div>
        </div>
    </article>
</div>