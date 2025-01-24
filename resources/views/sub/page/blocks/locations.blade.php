<section class="hidden-section no-padding-section">
    <div class="half-carousel-wrap">
        <div class="half-carousel-title color-bg">
            <div class="half-carousel-title-item fl-wrap">
                <h2>{{ $data["title"] }}</h2>
                <h5 class="text-white">{{ $data["description"] }}</h5>
            </div>
            <div class="pwh_bg"></div>
        </div>
        <div class="half-carousel-conatiner">
            <div class="half-carousel fl-wrap full-height">
                @foreach($data["location"] as $location)
                    
                    <div class="slick-item">
                        <div class="half-carousel-item fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg" data-bg="{{ get_image_url($location["image_id"]) }}"></div>
                            </div>
                            <div class="half-carousel-content">
                                <h3><a href="{{$location["button_link"]}}">{{$location["title"]}}</a></h3>
                                <p>{{$location["description"]}}</p>
                                <a class="btn float-btn color-bg small-btn" href="{{$location["button_link"]}}">{{$location["button_text"]}}</a>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>
</section>