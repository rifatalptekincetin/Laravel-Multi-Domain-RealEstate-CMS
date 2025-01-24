@extends('sub.layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)

@section('content')
<div id="wrapper">
    <div class="content">
        @php
            $links=[
                ["title"=>"Anasayfa","url"=>route("sub.home",get_subdomain())],
                ["title"=>settings('agents_title'),"url"=>route("sub.agency.agents",get_subdomain())],
            ];
        @endphp
        @include('sub.partials.breadcrumbs',['links'=>$links,'title'=>$title])
        
        
        <section class="gray-bg small-padding ">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-info smpar fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg"  data-bg="{{ $agent->banner->url }}"></div>
                            </div>
                            <div class="card-info-media">
                                <div class="bg"  data-bg="{{ $agent->image->medium_url }}"></div>
                            </div>
                            <div class="card-info-content">
                                <div class="agent_card-title fl-wrap">
                                    <h4> {{ $agent->name }} </h4>
                                    <div class="geodir-category-location fl-wrap">
                                        <h5>{{ $agent->title }}</h5>
                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    </div>
                                </div>
                                <div class="list-single-stats">
                                    <ul class="no-list-style">
                                        <li><span class="bookmark-counter"><i class="fas fa-comment-alt"></i> Yorumlar -  0 </span></li>
                                        <li><span class="bookmark-counter"><i class="fas fa-sitemap"></i> İlanlar -  {{ $agent->listings()->count() }} </span></li>
                                    </ul>
                                </div>
                                <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Onaylı"><i class="fal fa-user-check"></i></div>
                            </div>
                        </div>
                        <div class="list-single-main-container fl-wrap">
                            <div class="list-single-main-item fl-wrap">
                                <div class="list-single-main-item-title">
                                    <h3>{{ $agent->name }} Hakkında</h3>
                                </div>
                                <div class="list-single-main-item_content fl-wrap">
                                    {!! $agent->about !!}
                                    @if($agent->site)
                                        <br>
                                        <div class="list-single-main-item-title">
                                            <h3>{{ $agent->name }} Ofisi</h3>
                                        </div>
                                        <div class="listing-item-container one-column-grid-wrap  box-list_ic agency-list fl-wrap" style="padding:0px">
                                            @include('sub.partials.agency',['_agency'=>$agent->site])
                                        </div>
                                    @endif
                                </div>
                            </div>           						
                        </div>
                        <div class="content-tabs-wrap tabs-act fl-wrap">
                            <div class="content-tabs fl-wrap">
                                <ul class="tabs-menu fl-wrap no-list-style">
                                    <li class="current"><a href="#tab-listing">  İlanlar  </a></li>
                                    <li><a href="#tab-reviews">Yorumlar</a></li>
                                </ul>
                            </div>
                  
                            <div class="tabs-container">
                                <div class="tab">
                                    <div id="tab-listing" class="tab-content first-tab">
                                        @php
                                            $listings=$agent->listings()->where('site_id',get_subsite()->id)->paginate(4);
                                        @endphp
                                        <div class="listing-item-container fl-wrap">
                                            @foreach($listings as $listing)
                                                @include('sub.partials.listing-vertical',["_listing"=>$listing])
                                            @endforeach
                                        </div>
                                        
                                        {{ $listings->links('partials.pagination') }}
                                    </div>
                                </div>

                                <div class="tab">
                                    <div id="tab-reviews" class="tab-content">
                                        <div class="list-single-main-container fl-wrap" style="margin-top: 30px;">

                                            <div class="list-single-main-item fl-wrap" id="sec6">
                                                <div class="list-single-main-item-title">
                                                    <h3>Yorumlar <span>{{ $agent->reviews()->count() }}</span></h3>
                                                </div>
                                                <div class="">
                                                <div class="reviews-comments-wrap fl-wrap">
                                                        <div class="review-total">
                                                            <span class="review-number blue-bg">
                                                                @if($agent->reviews()->count())
                                                                    {{ number_format($agent->reviews()->average('rating'),1) }}
                                                                @else
                                                                5.0
                                                                @endif
                                                            </span>
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="@if($agent->reviews()->count()) {{ number_format($agent->reviews()->average('rating'),1) }} @else 5 @endif"></div>
                                                        </div>


                                                        @foreach($agent->reviews as $review)
                                                        <div class="reviews-comments-item">
                                                            <div class="review-comments-avatar">
                                                                <img src="https://ui-avatars.com/api/?background=18181b&color=fff&name={{$review->name}}">
                                                            </div>
                                                            <div class="reviews-comments-item-text smpar">
                                                                <h4><a href="javascript:;">{{$review->name}}</a></h4>
                                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="{{$review->rating}}"></div>
                                                                <div class="clearfix"></div>
                                                                <p>" {{ $review->content }} "</p>
                                                                <div class="reviews-comments-item-date"><span class="reviews-comments-item-date-item"><i class="far fa-calendar-check"></i>{{ $review->created_at->format("Y-m-d") }}</span></div>
                                                            </div>
                                                        </div>
                                                        @endforeach



                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-single-main-item fl-wrap" id="sec5">
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3>Yorum Ekleyin</h3>
                                                </div>

                                                <div id="add-review" class="add-review-box">
                                                    <div class="leave-rating-wrap">
                                                        <span class="leave-rating-title">Bu danışmana puanınız: </span>
                                                        <div class="leave-rating">
                                                            <input type="radio" data-ratingtext="" name="rating" id="rating-1" value="5" onclick="document.querySelector('#rating').value = 5;"/>
                                                            <label for="rating-1" class="fal fa-star"></label>
                                                            <input type="radio" data-ratingtext="" name="rating" id="rating-2" value="4" onclick="document.querySelector('#rating').value = 4;"/>
                                                            <label for="rating-2" class="fal fa-star"></label>
                                                            <input type="radio" name="rating" data-ratingtext="" id="rating-3" value="3" onclick="document.querySelector('#rating').value = 3;"/>
                                                            <label for="rating-3" class="fal fa-star"></label>
                                                            <input type="radio" data-ratingtext="" name="rating" id="rating-4" value="2" onclick="document.querySelector('#rating').value = 2;"/>
                                                            <label for="rating-4" class="fal fa-star"></label>
                                                            <input type="radio" data-ratingtext="" name="rating" id="rating-5" value="1" onclick="document.querySelector('#rating').value = 1;"/>
                                                            <label for="rating-5" class="fal fa-star"></label>
                                                        </div>
                                                        <div class="count-radio-wrapper">
                                                            <span id="count-checked-radio"></span>  
                                                        </div>
                                                    </div>
                                                    
                                                    <form class="add-comment custom-form ajax-submit">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $agent->id }}">
                                                        <input type="hidden" name="site_id" value="{{ $agent->site_id }}">
                                                        <input type="hidden" name="form_type" value="comment">
                                                        <input type="hidden" name="rating" id="rating" value="5">
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Adınız <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                                                    <input name="isim" type="text" onClick="this.select()" value="" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>E-posta Adresiniz <span class="dec-icon"><i class="fas fa-envelope"></i></span></label>
                                                                    <input name="eposta" type="text" onClick="this.select()" value="" required>
                                                                </div>
                                                            </div>
                                                            <textarea cols="40" rows="3" placeholder="Yorumuz:" name="yorum" required></textarea>
                                                        </fieldset>
                                                        @include('partials.kvkk')
                                                        <button class="btn big-btn color-bg float-btn">Yorumu Gönder <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                                         										
                                        </div>
                                    </div>
                                </div>
                                							
                            </div>
                              
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-md-4">
                        
                        <div class="box-widget bwt-first fl-wrap">
                            <div class="box-widget-title fl-wrap box-widget-title-color color-bg no-top-margin">İletişim Bilgileri</div>
                            <div class="box-widget-content fl-wrap">
                                <div class="contats-list clm fl-wrap">
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Telefon :</span> <a href="tel:{{ $agent->phone }}">{{ $agent->phone }}</a></li>
                                        <li><span><i class="fal fa-envelope"></i> E-posta :</span> <a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a></li>
                                    </ul>
                                </div>
                                <div class="profile-widget-footer fl-wrap">
                                    <div class="card-info-content_social ">
                                        <ul>
                                            @if($agent->whatsapp)
                                            <li><a href="https://wa.me/{{ $agent->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                            @endif
                                            @if($agent->telegram)
                                            <li><a href="{{ $agent->telegram }}" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
                                            @endif
                                            @if($agent->facebook)
                                            <li><a href="{{ $agent->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                            @if($agent->instagram)
                                            <li><a href="{{ $agent->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            @endif
                                            @if($agent->twitter)
                                            <li><a href="{{ $agent->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            @endif
                                            @if($agent->tiktok)
                                            <li><a href="{{ $agent->tiktok }}" target="_blank">
                                                <i class="fab fa-tiktok"></i>
                                            </a></li>
                                            @endif
                                            @if($agent->linkedin)
                                            <li><a href="{{ $agent->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                            @endif
                                            @if($agent->youtube)
                                            <li><a href="{{ $agent->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                            @endif
                                            @if($agent->pinterest)
                                            <li><a href="{{ $agent->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                            @endif
                                            
                                        </ul>
                                    </div>
                                    <a href="#sec-contact" class="custom-scroll-link tolt csls" data-microtip-position="left" data-tooltip="Mesaj Gönder"><i class="fal fa-paper-plane"></i></a>
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
                                            <input type="hidden" name="user_id" value="{{ $agent->id }}">
                                            <input type="hidden" name="site_id" value="{{ $agent->site_id }}">
                                            <input type="hidden" name="form_type" value="contact">
                                            <fieldset>
                                                <label>Adınız* <span class="dec-icon"><i
                                                            class="fas fa-user"></i></span></label>
                                                <input name="isim" type="text" onClick="this.select()" value="" required>
                                                <label>Telefonunuz * <span class="dec-icon"><i
                                                            class="fas fa-phone"></i></span></label>
                                                <input name="telefon" type="text" onClick="this.select()" value="" required>
                                                <textarea name="mesaj" cols="40" rows="3"
                                                    placeholder="Mesajınız" required></textarea>
                                            </fieldset>
                                            @include('partials.kvkk')
                                            <button type="submit" class="btn float-btn color-bg fw-btn"> Gönder</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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
            <div class="limit-box fl-wrap"></div>
        </section>


    </div>
</div>
@endsection