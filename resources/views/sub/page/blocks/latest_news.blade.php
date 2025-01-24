@php
$posts = get_posts($data["number_of_news"]);
@endphp

<section class="gray-bg small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title st-center fl-wrap">
                    <h2>{{ $data['title'] }}</h2>
                    <h4>{{ $data['description'] }}</h4>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="grid-item-holder gallery-items gisp fl-wrap">

            @foreach($posts as $post)
                <div class="gallery-item default">
                    @include('sub.partials.post-vertical',['post'=>$post])															
                </div>
            @endforeach

        </div>

    </div>
</section>