<div class="listing-item">
    <article class="geodir-category-listing fl-wrap">
        <div class="geodir-category-img fl-wrap  agent_card">
            <a href="{{ $_agent->url() }}" class="geodir-category-img_item">
                <img src="{{ $_agent->image->medium_url }}" alt="{{ $_agent->image->alt }}">
                <ul class="list-single-opt_header_cat">
                    <li><span class="cat-opt color-bg">{{ $_agent->listings()->count() }} ilan</span></li>
                </ul>
            </a>
            <div class="agent-card-social fl-wrap">
                <ul>
                    @if($_agent->whatsapp)
                    <li><a href="https://wa.me/{{ $_agent->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                    @endif
                    @if($_agent->telegram)
                    <li><a href="{{ $_agent->telegram }}" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
                    @endif
                    @if($_agent->facebook)
                    <li><a href="{{ $_agent->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if($_agent->instagram)
                    <li><a href="{{ $_agent->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    @endif
                    @if($_agent->twitter)
                    <li><a href="{{ $_agent->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    @endif
                    @if($_agent->tiktok)
                    <li><a href="{{ $_agent->tiktok }}" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a></li>
                    @endif
                    @if($_agent->linkedin)
                    <li><a href="{{ $_agent->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                    @endif
                    @if($_agent->youtube)
                    <li><a href="{{ $_agent->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    @endif
                    @if($_agent->pinterest)
                    <li><a href="{{ $_agent->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                    @endif

                </ul>
            </div>
            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
        </div>
        <div class="geodir-category-content fl-wrap">
            <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Onaylı"><i class="fal fa-user-check"></i></div>
            <div class="agent_card-title fl-wrap">
                <h4><a href="{{ $_agent->url() }}" >{{ $_agent->name }}</a></h4>
                <h5><a href="{{ $_agent->url() }}">{{ $_agent->title }}</a></h5>
            </div>
            <p>
                {!! mb_strtolower( mb_substr( strip_tags($_agent->about), 0, 90) ) !!}
            </p>
            <div class="geodir-category-footer fl-wrap">
                <a href="{{ $_agent->url() }}" class="btn float-btn color-bg small-btn">Profili Gör</a>
                <a href="mailto:{{ $_agent->email }}" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="E-posta Gönder"><i class="fal fa-envelope"></i></a>
                <a href="tel:{{ $_agent->phone }}" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Hemen Ara"><i class="fal fa-phone"></i></a>	
            </div>
        </div>
    </article>
</div>