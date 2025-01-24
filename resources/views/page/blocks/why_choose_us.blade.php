<section class="gray-bg small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title fl-wrap">
                    <h2>{{ $data['title'] }}</h2>
                    <h4>{{ $data['description'] }}</h4>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="grid-item-holder gisp fl-wrap">
            <div class="services-opions fl-wrap">
                <ul>
                    @foreach($data["item"] as $item)
                        <li>
                            <i>
                                <img src="{{ get_image_url($item["image_id"]) }}">
                            </i>
                            <h4>{{ $item["title"] }}</h4>
                            <p>{{ $item["description"] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</section>