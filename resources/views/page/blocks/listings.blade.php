@php
$listings = get_listings($data["number_of_listing"]);
$categories = get_categories($data["category_ids"]);
@endphp

<section class="gray-bg small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="section-title fl-wrap">
                    <h2>{{ $data['title'] }}</h2>
                    <h4>{{ $data['description'] }}</h4>
                </div>
            </div>
            <div class="col-md-8">
                <div class="listing-filters gallery-filters">
                    @foreach($categories as $category)
                        <a href="{{$category->url()}}" class="gallery-filter"> <span>{{$category->title}}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="grid-item-holder gallery-items gisp fl-wrap">

            @foreach($listings as $listing)
                <div class="gallery-item default">
                    @include('partials.listing-vertical',['_listing'=>$listing])															
                </div>
            @endforeach

        </div>

    </div>
</section>