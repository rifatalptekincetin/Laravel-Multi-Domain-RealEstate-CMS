<section class="gray-bg small-padding ">
    <div class="container">
        <div class="row">
            @if($data['is_navigation'])
            <div class="col-md-4">
                <div class="box-widget fl-wrap fixed-column_menu-init">
                    <div class="box-widget-content fl-wrap  ">
                        <div class="box-widget-title fl-wrap">{{ $data['navigation_title'] }}</div>
                        <div class="faq-nav scroll-init fl-wrap">
                            <ul>
                                @foreach($data['faq_section'] as $key=>$section)
                                    <li><a @if(!$key) class="act-scrlink" @endif href="#faq{{$key}}">{{ $section['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="@if($data['is_navigation']) col-md-8 @else col-md-12 @endif">
                <div class="list-single-main-container">
                    @foreach($data['faq_section'] as $key=>$section)
                    <div class="list-single-main-item fl-wrap" id="faq{{$key}}">
                        <div class="list-single-main-item-title big-lsmt fl-wrap">
                            <h3>{{ $section['title'] }}</h3>
                        </div>
                        @foreach($section['faq'] as $faq)
                        <div class="accordion-lite-container fl-wrap">
                            <div class="accordion-lite-header fl-wrap">{{ $faq['question'] }}<i class="fas fa-plus"></i></div>
                            <div class="accordion-lite_content fl-wrap">
                                {!! $faq['answer'] !!}
                            </div>
                        </div>
                        @endforeach									
                    </div>
                    @endforeach                            
                </div>
            </div>
        </div>
    </div>
    <div class="limit-box fl-wrap"></div>
</section>