<section class="gray-bg ">
    <div class="container">
        <div class="section-title st-center text-center fl-wrap">
            <h2>{{ $data['title'] }}</h2>
            <h4>{{ $data['description'] }}</h4>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="testimonials-slider-wrap">
        <div class="testimonials-slider">
            @foreach($data["testimonial"] as $testimonial)
            <div class="slick-item">
                <div class="text-carousel-item fl-wrap">
                    <div class="text-carousel-item-header fl-wrap">
                        <div class="popup-avatar"><img src="{{ get_image_url($testimonial["image_id"]) }}" alt=""></div>
                        <div class="review-owner fl-wrap">{{ $testimonial["name"] }} <br> {{ $testimonial["title"] }}</div>
                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
                    </div>
                    <div class="text-carousel-content fl-wrap">
                        <p> "{{ $testimonial["review"] }}"</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>