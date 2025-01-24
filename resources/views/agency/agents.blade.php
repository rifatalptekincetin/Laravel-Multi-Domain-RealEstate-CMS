@extends('layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)

@section('content')
<div id="wrapper">
    <div class="content">
        @php
            $links=[
                ["title"=>"Anasayfa","url"=>route("home")],
            ];
        @endphp
        @include('partials.breadcrumbs',['links'=>$links,'title'=>$title])
        
        <section class="gray-bg small-padding ">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="list-main-wrap-header box-list-header fl-wrap">
                            <div class="accordion-lite-container fl-wrap" style="padding:0px;">
                                <div class="accordion-lite-header fl-wrap">
                                    <div class="list-main-wrap-title">
                                        <h2>{{ $title }}<strong>{{$agents->total()}}</strong></h2>
                                    </div>
                                    <i class="far fa-sliders-h" style="font-size: 24px;"></i>
                                </div>
                                <div class="accordion-lite_content fl-wrap">
                                    <div class="block-box fl-wrap search-sb" id="filters-column">
                                        <form method="get" class="row">
                                            <div class="col-md-4">
                                                <div class="listsearch-input-item">
                                                    <label>Danışman Ara</label>
                                                    <input name="search" type="text" onclick="this.select()" placeholder="İsim, soyisim..." value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="listsearch-input-item">
                                                    <div class="listsearch-input-item">
                                                        <label>İl</label>
                                                        <select data-placeholder="Tüm İller" class="chosen-select on-radius no-search-select" style="display: none;">
                                                            <option>Tüm İller</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="listsearch-input-item">
                                                    <button type="submit" class="btn small-btn float-btn color-bg w-100" style="margin-top: 25px;line-height: 24px;">
                                                        Filtrele
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                  
                        </div>
					
                        
                        <div class="listing-item-container  box-list_ic fl-wrap">
                            @foreach($agents as $agent)
                                @include('partials.agent-vertical',["_agent"=>$agent])
                            @endforeach
                            @if(!$agents->count())
                                <div class="alert text-align-left">
                                    <h2 class="alert-heading">Uyarı!</h2>
                                    <p>Aradığınız kriterlere sahip bir danışmanımız bulunmamaktadır. Sizin için çalışma yapmamızı dilerseniz, lütfen talep formunu doldurunuz.</p>
                                    <p></p>
                                    <p><a class="underline" href="{{ route('page.talep') }}">Formu Doldur</a></p>
                                </div>
                            @endif
                        </div>
                        
                        {{ $agents->links('partials.pagination') }}
                        					
                    </div>

                    <div class="col-md-4">
                        @if(settings('agents_futured'))
                        <div class="box-widget fl-wrap">
                            <div class="box-widget-title fl-wrap">Öne Çıkanlar</div>
                            <div class="box-widget-content fl-wrap">
                                <div class="widget-posts  fl-wrap">
                                    <ul class="no-list-style">
                                        @foreach(get_agents(settings('agents_futured')) as $fa)
                                        <li>
                                            <div class="widget-posts-img"><a href="{{ $fa->url() }}">
                                                <img src="{{ $fa->image->medium_url }}" alt="{{ $fa->name }}"></a>  
                                            </div>
                                            <div class="widget-posts-descr agent-post_descr">
                                                <h4><a href="{{ $fa->url() }}">{{ $fa->name }}</a></h4>
                                                <div class="agent-post_descr_counter fl-wrap"><span>{{ $fa->listings()->count() }}</span> ilan</div>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
                                                <a href="mailto:{{ $fa->email }}" class="tolt ftr-btn" data-microtip-position="top-left" data-tooltip="E-posta Gönder"><i class="fal fa-envelope"></i></a>
                                                <a href="tel:{{ $fa->phone }}" class="tolt ftr-btn" data-microtip-position="top-left" data-tooltip="Hemen Ara"><i class="fal fa-phone"></i></a>									
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="box-widget fl-wrap">
                            <div class="banner-widget fl-wrap">
                                <div class="bg-wrap bg-parallax-wrap-gradien">
                                    <div class="bg"  data-bg="{{ get_image_url(settings('become_agent_image'),'medium_url') }}"></div>
                                </div>
                                <div class="banner-widget_content">
                                    <h5>{{ settings('become_agent_title') }}</h5>
                                    <a href="{{ settings('become_agent_button_url') }}" class="btn float-btn color-bg small-btn">{{ settings('become_agent_button_text') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="limit-box fl-wrap"></div>

    </div>
</div>
@endsection