@extends('sub.layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)
@section('futured_image', $futured_image)

@section('content')
<div id="wrapper">
    <div class="content">

        <section class="hidden-section   single-hero-section" data-scrollax-parent="true" id="sec1">
            <div class="bg-wrap bg-parallax-wrap-gradien">
                <div class="bg par-elem " data-bg="{{ $listing->image->url }}" data-scrollax="properties: { translateY: '30%' }">
                </div>
            </div>
            <div class="container">
                
                <div class="list-single-opt_header fl-wrap">
                    <ul class="list-single-opt_header_cat">
                    @foreach($listing->categories()->orderBy('parent_id','asc')->get() as $category)
                        <li><a href="{{$category->url(get_subdomain())}}" class="cat-opt blue-bg">{{$category->title}}</a></li>
                    @endforeach
                    </ul>
                </div>
                
                
                <div class="list-single-header-item no-bg-list_sh fl-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>{{ $listing->title }} <span class="verified-badge tolt"
                                    data-microtip-position="bottom" data-tooltip="Onaylanmış"><i
                                        class="fas fa-check"></i></span></h1>
                            <div class="geodir-category-location fl-wrap">
                                <a href="#" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"
                                data-microtip-position="top-left" data-tooltip="Haritada Aç"><i class="fas fa-map-marker-alt"></i>
                                <span>
                                {{$listing->district->title}},
                                {{$listing->city->title}},
                                {{$listing->state->title}}
                                </span></a>
                            </div>
                            <div class="share-holder hid-share">
                                <a href="#" class="share-btn showshare sfcs"> <i class="fas fa-share-alt"></i> Paylaş
                                </a>
                                <div class="share-container  isShare"></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-single-header-footer fl-wrap">
                        @if($listing->price)
                            <div class="list-single-header-price" data-propertyprise="{{number_format($listing->price,0,'','')}}"><strong>Fiyat:</strong>
                            {{number_format($listing->price,2,',','.')}}
                            <span>₺ @if($listing->price_type == 'monthly') / Ay @elseif($listing->price_type == 'yearly') / Yıl @endif </span></div>
                        @endif
                        <div class="list-single-header-date"><span>Yayınlanma:</span>{{$listing->created_at->format("d.m.Y") }}</div>
                    </div>
                </div>
            </div>
        </section>
        <div class="breadcrumbs fw-breadcrumbs smpar fl-wrap">
            <div class="container">
                <div class="breadcrumbs-list">
                    <a href="{{ route('sub.home',get_subdomain()) }}">Anasayfa</a>
                    <a href="{{ route('sub.listing.index',get_subdomain()) }}">İlanlar</a>
                    @foreach($listing->categories()->orderBy('parent_id','asc')->get() as $category)
                    <a href="{{$category->url(get_subdomain())}}">{{$category->title}}</a>
                    @endforeach
                    <span>{{ $listing->title }}</span>
                </div>
                <div class="show-more-snopt smact"><i class="fal fa-ellipsis-v"></i></div>
                <div class="show-more-snopt-tooltip">
                    <a href="#sec-contact" class="custom-scroll-link"> <i class="fas fa-comment-alt"></i> Mesaj bırak</a>
                    <a href="#"> <i class="fas fa-exclamation-triangle"></i> Şikayet et </a>
                </div>
                <a class="print-btn tolt" href="javascript:window.print()" data-microtip-position="bottom"
                    data-tooltip="Yazdır"><i class="fas fa-print"></i></a>
                <a class="compare-top-btn tolt add_compare" data-slug="{{$listing->slug}}" data-microtip-position="bottom" data-tooltip="Karşılaştır" href="#"><i
                        class="fas fa-random"></i></a>
                <a class="compare-top-btn tolt add_wishlist" data-slug="{{$listing->slug}}" data-microtip-position="bottom" data-tooltip="Kaydet" href="#"><i
                        class="fas fa-heart"></i></a>
            </div>
        </div>
        <div class="gray-bg small-padding fl-wrap">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="list-single-main-wrapper fl-wrap">
                            
                            <div class="scroll-nav-wrap">
                                <nav class="scroll-nav scroll-init fixed-column_menu-init">
                                    <ul class="no-list-style">
                                        <li><a class="act-scrlink" href="#sec1"><i
                                                    class="fal fa-home-lg-alt"></i></a><span>Giriş</span></li>
                                        <li><a href="#sec2"><i class="fal fa-image"></i></a><span>Galeri</span></li>
                                        <li><a href="#sec3"><i class="fal fa-info"></i> </a><span>Detaylar</span></li>
                                        <li><a href="#sec5"><i class="fal fa-video"></i></a><span>Video</span></li>
                                        <li><a href="#sec6"><i class="fal fa-map-pin"></i></a><span>Lokasyon</span></li>
                                    </ul>
                                    <div class="progress-indicator">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
                                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
                                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__progress 
                                                            js-progress-bar" />
                                        </svg>
                                    </div>
                                </nav>
                            </div>

                            <div class="list-single-main-media fl-wrap" id="sec2">

                                <div class="single-slider-wrapper carousel-wrap fl-wrap">
                                    <div class="slider-for fl-wrap carousel lightgallery"  >

                                        <div class="slick-slide-item">
                                            <div class="box-item">
                                                <a href="{{$listing->image->url}}" class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                <img src="{{$listing->image->url}}" alt="{{$listing->image->alt}}">
                                            </div>
                                        </div>

                                        @foreach($listing->images as $img)
                                        <div class="slick-slide-item">
                                            <div class="box-item">
                                                <a href="{{$img->url}}" class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                <img src="{{$img->url}}" alt="{{$img->alt}}">
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                    <div class="swiper-button-prev ssw-btn"><i class="fas fa-caret-left"></i></div>
                                    <div class="swiper-button-next ssw-btn"><i class="fas fa-caret-right"></i></div>
                                </div>
                                <div class="single-slider-wrapper fl-wrap">
                                    <div class="slider-nav fl-wrap">
                                        <div class="slick-slide-item"><img src="{{$listing->image->thumbnail_url}}" alt="{{$listing->image->alt}}"></div>
                                        @foreach($listing->images as $img)
                                        <div class="slick-slide-item"><img src="{{$img->thumbnail_url}}" alt="{{$img->alt}}"></div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="list-single-main-container fl-wrap" id="sec3">

                                <div class="list-single-main-item fl-wrap">
                                    <div class="list-single-main-item_content fl-wrap">
                                        {!! $listing->content !!}
                                    </div>
                                </div>

                                <div class="list-single-main-item fl-wrap">
                                    <div class="list-single-main-item-title">
                                        <h3>Özellikler</h3>
                                    </div>
                                    <div class="list-single-main-item_content fl-wrap">
                                        <div class="details-list">
                                            <ul>
                                                
                                                <li><span>Fiyat:</span>
                                                    {{number_format($listing->price,2,',','.')}} ₺ @if($listing->price_type == 'monthly') / Ay @elseif($listing->price_type == 'yearly') / Yıl @endif 
                                                </li>
                                                <li><span>İl / İlçe:</span>
                                                    {{ $listing->state->title }}, {{ $listing->city->title }}
                                                </li>
                                                <li><span>Mahalle:</span>
                                                    {{ $listing->district->title }}
                                                </li>
                                                @foreach ($listing->metas as $meta)
                                                    @if($meta->option->type != "textarea" && $meta->option->type != "checkbox" && $meta->option->type != "multiselect")
                                                    <li><span>{{$meta->option->title}}:</span>
                                                    {{ implode(', ',$meta->meta_value) }}
                                                    </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="details-list full-width">
                                            <ul>
                                                @foreach ($listing->metas as $meta)
                                                @if($meta->option->type == "checkbox" || $meta->option->type == "multiselect")
                                                    <li><span>{{$meta->option->title}}:</span>
                                                        @foreach($meta->meta_value as $val)
                                                            <div class="boxed"> <i class="fa fa-check-square"></i> {{ $val }} </div>
                                                        @endforeach
                                                    </li>
                                                @elseif($meta->option->type == "textarea")
                                                    <li><span>{{$meta->option->title}}:</span>
                                                    {!! implode(', ',$meta->meta_value) !!}
                                                    </li>
                                                @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if($listing->video_url)
                                    <div class="list-single-main-item fl-wrap" id="sec5">
                                        <div class="list-single-main-item-title">
                                            <h3>Video</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <iframe width="100%" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                                                src="https://www.youtube.com/embed/{{ yt_vid_id($listing->video_url) }}" 
                                                onload="this.style.height=parseInt(this.getBoundingClientRect().width*0.5625)+'px';" >
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                                <div class="list-single-main-item fw-lmi fl-wrap" id="sec6">
                                    <div class="map-container mapC_vis mapC_vis2">
                                        <div id="singleMap" data-latitude="{{ $listing->latitude }}"
                                            data-longitude="{{ $listing->longitude }}"
                                            data-mapTitle="{{$listing->title}}"
                                            data-infotitle="{{$listing->title}}"
                                            data-infotext="{{$listing->district->title}},{{$listing->city->title}},{{$listing->state->title}}"></div>
                                        <div class="scrollContorl"></div>
                                    </div>
                                    <input id="pac-input" class="controls fl-wrap controls-mapwn" autocomplete="on"
                                        type="text" placeholder="Yakınlarında ara... " value="">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        
                        <div class="box-widget fl-wrap">
                            <div class="profile-widget">
                                <div class="profile-widget-header color-bg smpar fl-wrap">
                                    <div class="pwh_bg"></div>
                                    <div class="call-btn"><a href="tel:{{$listing->user->phone}}" class="tolt color-bg"
                                            data-microtip-position="right" data-tooltip="Call Now"><i
                                                class="fas fa-phone-alt"></i></a></div>
                                    <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                    <div class="show-more-snopt-tooltip bxwt">
                                        <a href="#sec-contact" class="custom-scroll-link"> <i class="fas fa-comment-alt"></i> Mesaj bırak</a>
                                        <a href="#"> <i class="fas fa-exclamation-triangle"></i> Şikayet et </a>
                                    </div>
                                    <div class="profile-widget-card">
                                        <div class="profile-widget-image">
                                            <img src="{{ $listing->user->image->thumbnail_url }}" alt="{{ $listing->user->image->alt }}">
                                        </div>
                                        <div class="profile-widget-header-title">
                                            <h4><a href="{{ $listing->user->url(get_subdomain()) }}">{{ $listing->user->name }}</a></h4>
                                            <div class="clearfix"></div>
                                            <div class="pwh_counter"><span>{{$listing->user->listings()->count()}}</span> İlan</div>
                                            <div class="clearfix"></div>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-widget-content fl-wrap">
                                    <div class="contats-list fl-wrap">
                                        <ul class="no-list-style">
                                            <li><span><i class="fal fa-phone"></i> Telefon :</span> <a
                                                    href="tel:{{$listing->user->phone}}">{{$listing->user->phone}}</a></li>
                                            <li><span><i class="fal fa-envelope"></i> E-posta :</span> <a
                                                    href="mailto:{{$listing->user->email}}">{{$listing->user->email}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="profile-widget-footer fl-wrap">
                                        <a href="{{$listing->user->url(get_subdomain())}}" class="btn float-btn color-bg small-btn">Profili Gör</a>
                                        <a href="#sec-contact" class="custom-scroll-link tolt"
                                            data-microtip-position="left" data-tooltip="Mesaj Gönder"><i
                                                class="fal fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="box-widget fl-wrap">
                            <div class="fl-wrap" id="sec-contact">
                                <div class="box-widget-title fl-wrap box-widget-title-color color-bg">İletişim
                                </div>
                                <div class="box-widget-content fl-wrap">
                                    <div class="custom-form">
                                        <form class="contact-property-form ajax-submit">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $listing->user->id }}">
                                            <input type="hidden" name="site_id" value="{{ $listing->site_id }}">
                                            <input type="hidden" name="form_type" value="contact">
                                            <fieldset>
                                                <label>Adınız* <span class="dec-icon"><i
                                                            class="fas fa-user"></i></span></label>
                                                <input name="isim" type="text" onClick="this.select()" value="">
                                                <label>Telefonunuz * <span class="dec-icon"><i
                                                            class="fas fa-phone"></i></span></label>
                                                <input name="telefon" type="text" onClick="this.select()" value="">
                                                <textarea name="mesaj" id="message" cols="40" rows="3"
                                                    placeholder="Mesajınız"></textarea>
                                            </fieldset>
                                            @include('partials.kvkk')
                                            <button type="submit" class="btn float-btn color-bg fw-btn"> Gönder</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="fl-wrap limit-box"></div>
                <div class="listing-carousel-wrapper carousel-wrap fl-wrap">
                    <div class="list-single-main-item-title">
                        <h3>Benzer İlanlar</h3>
                    </div>
                    <div class="listing-carousel carousel ">
                        <div class="slick-slide-item">
                        @include('sub.partials.listing-vertical',['_listing'=>$listing])
                        </div>
                        
                    </div>
                    <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
                    <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection