@php
if($data["user_ids"]){
    $agents = \App\Models\User::whereNotNull('image_id')->where('site_id',get_subsite()->id)->whereIn('id',$data["user_ids"])->get();
}
else{
    $agents = \App\Models\User::whereNotNull('image_id')->where('site_id',get_subsite()->id)->get();
}
@endphp
<section >
    <div class="container">
        
        <div class="section-title st-center fl-wrap">
            <h2>{{ $data["title"] }}</h2>
            <h4>{{ $data["description"] }}</h4>
        </div>
        
        <div class="clearfix"></div>
        <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
            <div class="listing-carousel carousel ">
                @foreach($agents as $agent)
                    <div class="slick-slide-item">
                        @include('sub.partials.agent-vertical',["_agent"=>$agent])
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
            <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
        </div>
    </div>
</section>