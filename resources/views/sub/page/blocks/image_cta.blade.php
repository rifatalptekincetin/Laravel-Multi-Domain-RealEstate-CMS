<section>
    <div class="container">
        <div class="about-wrap">
            <div class="row">
                @if($data["image_position"] ==  "right")
                <div class="col-md-6 text-align-left">
                    <div class="editor" style="margin-bottom: 20px;">
                        {!! $data["description"] !!}
                    </div>
                    <a href="{{ $data["button_link"] }}" class="btn color-bg small-btn">
                        {{ $data["button_text"] }}
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="about-img fl-wrap">
                        <img src="{{ get_image_url($data["image_id"]) }}" class="respimg" alt="">
                    </div>
                </div>
                @else
                <div class="col-md-6">
                    <div class="about-img fl-wrap">
                        <img src="{{ get_image_url($data["image_id"]) }}" class="respimg" alt="">
                    </div>
                </div>
                <div class="col-md-6 text-align-left">
                    <div class="editor" style="margin-bottom: 20px;">
                        {!! $data["description"] !!}
                    </div>
                    <a href="{{ $data["button_link"] }}" class="btn color-bg small-btn">
                        {{ $data["button_text"] }}
                    </a>
                </div>
                @endif
            </div>
        </div>						
    </div>
</section>