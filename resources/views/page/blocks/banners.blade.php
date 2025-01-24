<section>
    <div class="container">
        <div class="about-wrap">
            <div class="row">
                @foreach($data["banner"] as $banner)
                <div class="col-md-6" style="margin-bottom:10px;">
                    <a href="{{$banner['banner_link']}}">
                        <img class="w-100" src="{{ get_image_url($banner["image_id"]) }}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
        </div>						
    </div>
</section>