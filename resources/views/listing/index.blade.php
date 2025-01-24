@extends('layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)
@section('futured_image', $futured_image)

@section('content')
<div id="wrapper">
    <div class="content">
        
        <div class="categoties-column">
            <div class="categoties-column_container cat-list">
                <ul>
                    {{-- 
                    @foreach ($categories as $category)
                        <li><a href="{{$category->url()}}"><i class="" style="font-size: 12px;">{{$category->title}}</i><span>{{$category->title}}</span></a></li>
                    @endforeach
                    --}}
                </ul>
            </div>
            <div class="progress-indicator">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="-1 -1 34 34">
                    <circle cx="16" cy="16" r="15.9155"
                        class="progress-bar__background" />
                    <circle cx="16" cy="16" r="15.9155"
                        class="progress-bar__progress 
                        js-progress-bar" />
                </svg>
            </div>
        </div>
        
        
        <div class="map-container column-map   hid-mob-map">
            <div id="map-main"></div>
            <ul class="mapnavigation no-list-style">
                <li><a href="#" class="prevmap-nav mapnavbtn"><span><i class="fas fa-caret-left"></i></span></a></li>
                <li><a href="#" class="nextmap-nav mapnavbtn"><span><i class="fas fa-caret-right"></i></span></a></li>
            </ul>
            <div class="scrollContorl mapnavbtn tolt"   data-microtip-position="top-left" data-tooltip="Enable Scrolling"><span><i class="fal fa-unlock"></i></span></div>
            <div class="location-btn geoLocation tolt" data-microtip-position="top-left" data-tooltip="Your location"><span><i class="fal fa-location"></i></span></div>
            <div class="map-close"><i class="fas fa-times"></i></div>
        </div>
        					
        
        <form action="{{ route('listing.index') }}" class="top-search-content">
            <div class="top-search-dec color-bg"><i class="far fa-sliders-h"></i></div>
            <div class="top-search-content-title">Ara:</div>
            <div class="close_sb-filter"><i class="fal fa-times"></i></div>
            <div class="custom-form fl-wrap">
                <div class="row">
                    
                    <div class="col-sm-3">
                        <div class="listsearch-input-item search-suggest-holder">
                            <input class="search-suggest" type="text" onClick="this.select()" placeholder="Adres, İl, Kategori..." value=""/>	
                            <div class="search-suggest-results">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="listsearch-input-item">
                            <select data-placeholder="İl Seçin" name="state" class="chosen-select on-radius change-submit" >
                                <option value="">Tüm İller</option>
                                @foreach ($states as $_state)
                                    <option value="{{$_state->slug}}"
                                    @if(isset($state) && $state->id == $_state->id)
                                    selected
                                    @endif
                                    >{{$_state->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="listsearch-input-item">
                            <select data-placeholder="İlçe Seçin" name="city" class="chosen-select on-radius change-submit" >
                                <option value="">Tüm İlçeler</option>
                                @if(isset($cities))
                                    @foreach ($cities as $_city)
                                        <option value="{{$_city->slug}}"
                                        @if(isset($city) && $city->id == $_city->id)
                                        selected
                                        @endif
                                        >{{$_city->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="listsearch-input-item">
                            <select data-placeholder="Mahalle Seçin" name="district" class="chosen-select on-radius change-submit" >
                                <option value="">Tüm Mahalleler</option>
                                @if(isset($districts))
                                    @foreach ($districts as $_district)
                                        <option value="{{$_district->slug}}"
                                        @if(isset($district) && $district->id == $_district->id)
                                        selected
                                        @endif
                                        >{{$_district->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="listsearch-input-item">
                            <select data-placeholder="Kategori" name="category" class="chosen-select on-radius change-submit" >
                                <option value="">Tüm Kategoriler</option>
                                @foreach ($categories as $_category)
                                    <option value="{{$_category->slug}}"
                                    @if( (isset($category) && $category->id == $_category->id) || (isset($category->parent) && $category->parent_id == $_category->id) || (isset($category->parent->parent) && $category->parent->parent_id == $_category->id))
                                    selected
                                    @endif
                                    >{{$_category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="more-opt_btn mor-opt-btn_act">Detaylı Arama<span><i class="fas fa-caret-down"></i></span></div>
            
            <div class="more-search-opt-wrap more-hidden_wrap">
                <div class="msotw_title fl-wrap"><i class="far fa-sliders-h"></i>Detaylı Arama</div>
                <div class="close_msotw"><i class="fal fa-times"></i></div>
                <div class="clearfix"></div>
                @if(isset($category))
                    @if($category->parent)
                        @if($category->parent->parent)
                            <div class="col-md-3">
                                <div class="listsearch-input-item">
                                    <label>{{$category->parent->parent->title}} Kategorileri</label>
                                    <select data-placeholder="{{$category->parent->parent->title}} Kategorileri" name="category" class="chosen-select on-radius change-submit" >
                                        <option value="{{ $category->parent->parent->slug }}">Tüm {{$category->parent->parent->title}} Kategorileri</option>
                                        @foreach ($category->parent->parent->children as $_category)
                                            <option value="{{$_category->slug}}"
                                            @if($category->parent->id == $_category->id) selected @endif
                                            >{{$_category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3">
                            <div class="listsearch-input-item">
                                <label>{{$category->parent->title}} Kategorileri</label>
                                <select data-placeholder="{{$category->parent->title}} Kategorileri" name="category" class="chosen-select on-radius change-submit" >
                                    <option value="{{ $category->parent->slug }}">Tüm {{$category->parent->title}} Kategorileri</option>
                                    @foreach ($category->parent->children as $_category)
                                        <option value="{{$_category->slug}}"
                                        @if($category->id == $_category->id) selected @endif
                                        >{{$_category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    @if($category->children()->count())
                        <div class="col-md-3">
                            <div class="listsearch-input-item">
                                <label>{{$category->title}} Kategorileri</label>
                                <select data-placeholder="{{$category->title}} Kategorileri" name="category" class="chosen-select on-radius change-submit" >
                                    <option value="{{$category->slug}}">Tüm {{$category->title}} Kategorileri</option>
                                    @foreach ($category->children as $_category)
                                        <option value="{{$_category->slug}}">{{$_category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    @foreach($category->listingOptionsWithParents() as $option)
                        @if($option->type == 'select')
                        <div class="col-md-3">
                            <div class="listsearch-input-item">
                                <label>{{$option->title}}</label>
                                <select data-placeholder="{{$option->title}}" class="chosen-select on-radius no-search-select" name="option[{{$option->id}}]" >
                                    <option value="">@if($option->helper) {{$option->helper}} @else {{$option->title}} @endif</option>
                                    @foreach($option->answers as $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @elseif($option->type == 'multiselect')
                        <div class="col-md-3">
                            <div class="listsearch-input-item">
                                <label>{{$option->title}}</label>
                                <select multiple data-placeholder="{{$option->title}}" class="chosen-select on-radius no-search-select" name="option[{{$option->id}}]" >
                                    <option value="">@if($option->helper) {{$option->helper}} @else {{$option->title}} @endif</option>
                                    @foreach($option->answers as $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @elseif($option->type == 'number')
                        <div class="col-md-6">
                            <div class="listsearch-input-item">
                                <label>{{$option->title}}</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="option[{{$option->id}}][min]" placeholder="Min" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="option[{{$option->id}}][max]" placeholder="Max" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($option->type == 'checkbox')
                        <div class="col-md-12">
                            <div class="listsearch-input-item">
                                <label>{{$option->title}}</label>
                                <div class=" fl-wrap filter-tags">
                                    <ul class="no-list-style">
                                        @foreach($option->answers as $key=>$value)
                                        <li>
                                            <input id="option_{{$option->id}}_{{$key}}" type="checkbox" name="option[{{$option->id}}][]" value="{{$value}}">
                                            <label for="option_{{$option->id}}_{{$key}}">{{$value}}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @elseif($option->type == 'radio')
                        <div class="col-md-12">
                            <div class="listsearch-input-item">
                                <label>{{$option->title}}</label>
                                <div class=" fl-wrap filter-tags">
                                    <ul class="no-list-style">
                                        @foreach($option->answers as $key=>$value)
                                        <li>
                                            <input id="option_{{$option->id}}_{{$key}}" type="radio" name="option[{{$option->id}}][]" value="{{$value}}">
                                            <label for="option_{{$option->id}}_{{$key}}">{{$value}}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <p>Lütfen ilk olarak bir kategori seçin</p>
                    <p style="padding: 5px;">
                        @foreach ($categories as $_category)
                            <a href="javascript:;" class="btn small-btn color-bg" onclick="$('select[name=\'category\']').val('{{$_category->slug}}').trigger('change')" style="line-height: 40px;white-space: nowrap;">{{$_category->title}}</a>
                        @endforeach
                    </p>
                @endif
                <div class="msotw_footer">
                    <button type="submit" class="btn small-btn float-btn color-bg">Ara</button>
                    <a href="{{route('listing.index')}}" class="reset-form reset-btn"> <i class="far fa-sync-alt"></i> Filtreleri Sıfırla</a>
                </div>
            </div>
        </form>
        <div class="col-list-wrap gray-bg ">
            <div class="col-list-wrap_opt fl-wrap">
                <div class="show-hidden-filter col-list-wrap_opt_btn color-bg">Filtrele</div>
                <div class="show-hidden-map not-vis_lap col-list-wrap_opt_btn color-bg">Haritayı Aç</div>
            </div>
            
            <div class="list-main-wrap-header fl-wrap fixed-listing-header">
                <div class="container">
                    
                    <div class="list-main-wrap-title">
                        <h2>{{ $title }} <strong>{{$listings->total()}}</strong></h2>
                    </div>
                    
                    
                    <div class="list-main-wrap-opt">
                        
                        <div class="price-opt">
                            <span class="price-opt-title">Sırala:</span>
                            <div class="listsearch-input-item">
                                <select data-placeholder="Popularity" class="chosen-select no-search-select" >
                                    <option>En yeni</option>
                                    <option>En eski</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="grid-opt">
                            <ul class="no-list-style">
                                <li class="grid-opt_act"><span class="two-col-grid act-grid-opt tolt" data-microtip-position="bottom" data-tooltip="Izgara"><i class="far fa-th"></i></span></li>
                                <li class="grid-opt_act"><span class="one-col-grid tolt" data-microtip-position="bottom" data-tooltip="Liste"><i class="far fa-list"></i></span></li>
                            </ul>
                        </div>
                        
                    </div>
                                        
                </div>
            </div>
            					
            
            <div class="listing-item-container fl-wrap">
                @foreach($listings as $key=>$listing)
                    @include('partials.listing-vertical',['_listing'=>$listing,'listing_key'=>$key+1])
                @endforeach   
                @if(!$listings->count())
                <div class="alert text-align-left">
                    <h2 class="alert-heading">Uyarı!</h2>
                    <p>Aradığınız kriterlere sahip bir portföyümüz bulunmamaktadır. Sizin için çalışma yapmamızı dilerseniz, lütfen talep formunu doldurunuz.</p>
                    <p></p>
                    <p><a class="underline" href="{{ route('page.talep') }}">Formu Doldur</a></p>
                </div>
                @endif
            </div>
            
            
            {{ $listings->links('partials.pagination') }}
            						
            <div class="small-footer fl-wrap">
                <div class="copyright"> {{ settings("copyright") }} </div>
                <a class="custom-to-top color-bg custom-scroll-link" href="#main"><i class="fas fa-caret-up"></i></a>
            </div>
        </div>
        
    </div>
</div>
<style>
.main-footer.fl-wrap{
    display:none!important;
}
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).on('change','select[name="category"]',function(){
            $('select[name="category"]').attr('disabled','disabled');
            //make this not disabled
            $(this).removeAttr('disabled');
        });

        $(document).on('click','.top-search-content button[type="submit"]',function(){
            $('select[name="category"]').attr('disabled','disabled');
            $($('select[name="category"]').last()).removeAttr('disabled');
        });

        var markerIcon = {
            anchor: new google.maps.Point(15, 42),
            url: '/pin.png',
        }
        function mainMap() {
            function locationData(locationURL, locationCategory, locationImg, locationTitle, locationPrice, locationAddress) {
                let locationStatus = "";
                locationCategory.forEach(element => {
                    locationStatus += '<div class="map-popup-status mp-cat color-bg">' + element + '</div>';
                });
                return ('<div class="map-popup-wrap"><div class="map-popup">'+locationStatus+'<div class="infoBox-close"><i class="fal fa-times"></i></div> <a href="' + locationURL + '" class="listing-img-content" style="background-image: url(' + locationImg + ')"> </a> <div class="listing-content">  <div class="listing-title">   <h4><a href=' + locationURL + '>' + locationTitle + '</a></h4><span class="map-popup-location-info"> ' + locationAddress + '</span> </div> <span class="map-popup-price fl-wrap">  ' + locationPrice + '  </span> </div> </div></div>')
            }
            //   locations ------------------
            var locations = [
                @foreach($listings as $_listing)
                    @include('partials.location-data',['_listing'=>$_listing])
                @endforeach
            ];
            //   Map Infoboxes end ------------------
            var map = new google.maps.Map(document.getElementById('map-main'), {
                zoom: 10,
                scrollwheel: false,
                @if($listings->count())
                center: new google.maps.LatLng({{$listings->avg('latitude')}}, {{$listings->avg('longitude')}}),
                @else
                center: new google.maps.LatLng(38.9573415, 35.240741),
                @endif
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                panControl: true,
                fullscreenControl: true,
                navigationControl: false,
                streetViewControl: true,
                animation: google.maps.Animation.BOUNCE,
                gestureHandling: 'cooperative',
                styles: [{featureType:"administrative",elementType:"labels",stylers:[{color:"#FFFFFF"},{visibility:"simplified"}]},{featureType:"landscape.man_made",elementType:"all",stylers:[{visibility:"simplified"},{color:"#303030"}]},{featureType:"landscape.natural",elementType:"geometry",stylers:[{color:"#000000"},{visibility:"simplified"}]},{featureType:"poi",elementType:"geometry",stylers:[{visibility:"off"}]},{featureType:"poi",elementType:"labels.text",stylers:[{visibility:"simplified"},{color:"#FFFFFF"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"},{color:"#808080"}]},{featureType:"road",elementType:"labels.text",stylers:[{color:"#FFFFFF"},{visibility:"simplified"}]},{featureType:"road",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{color:"#303030"}]}]
            });
            var boxText = document.createElement("div");
            boxText.className = 'map-box'
            var currentInfobox;
            var boxOptions = {
                content: boxText,
                disableAutoPan: true,
                alignBottom: true,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(-110, -45),
                zIndex: null,
                boxStyle: {
                    width: "260px"
                },
                closeBoxMargin: "0",
                closeBoxURL: "",
                infoBoxClearance: new google.maps.Size(1, 1),
                isHidden: false,
                pane: "floatPane",
                enableEventPropagation: false,
            };
            var markerCluster, marker, i;
            var allMarkers = [];
            var clusterStyles = [{
                textColor: 'white',
                url: '',
                height: 50,
                width: 50
            }];
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    icon: locations[i][4],
                    id: i
                });
                allMarkers.push(marker);
                var ib = new InfoBox();
    
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        ib.setOptions(boxOptions);
                        boxText.innerHTML = locations[i][0];
                        ib.close();
                        ib.open(map, marker);
                        currentInfobox = marker.id;
                        var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                        map.panTo(latLng);
                        map.panBy(0, -180);
                        google.maps.event.addListener(ib, 'domready', function () {
                            $('.infoBox-close').click(function (e) {
                                e.preventDefault();
                                ib.close();
                            });
                        });
                    }
                })(marker, i));
            }
            var options = {
                imagePath: 'images/',
                styles: clusterStyles,
                minClusterSize: 2
            };
            markerCluster = new MarkerClusterer(map, allMarkers, options);
            google.maps.event.addDomListener(window, "resize", function () {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
            });

            $('.nextmap-nav').on("click", function (e) {
                e.preventDefault();
                map.setZoom(15);
                var index = currentInfobox;
                if (index + 1 < allMarkers.length) {
                    google.maps.event.trigger(allMarkers[index + 1], 'click');
                } else {
                    google.maps.event.trigger(allMarkers[0], 'click');
                }
            });
            $('.prevmap-nav').on("click", function (e) {
                e.preventDefault();
                map.setZoom(15);
                if (typeof (currentInfobox) == "undefined") {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                } else {
                    var index = currentInfobox;
                    if (index - 1 < 0) {
                        google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                    } else {
                        google.maps.event.trigger(allMarkers[index - 1], 'click');
                    }
                }
            });
            $('.map-item').on("click", function (e) {
                e.preventDefault();
                map.setZoom(15);
                var index = currentInfobox;
                var marker_index = parseInt($(this).attr('href').split('#')[1], 10);
                google.maps.event.trigger(allMarkers[marker_index-1], "click");
                if ($(this).hasClass("scroll-top-map")){
                $('html, body').animate({
                    scrollTop: $(".map-container").offset().top+ "-70px"
                }, 500)
                }
                else if ($(window).width()<1064){
                $('html, body').animate({
                    scrollTop: $(".map-container").offset().top+ "-70px"
                }, 500)
                }
            });
        // Scroll enabling button
        var scrollEnabling = $('.scrollContorl');

        $(scrollEnabling).click(function(e){
            e.preventDefault();
            $(this).toggleClass("enabledsroll");

            if ( $(this).is(".enabledsroll") ) {
                map.setOptions({'scrollwheel': true});
            } else {
                map.setOptions({'scrollwheel': false});
            }
        });		
            var zoomControlDiv = document.createElement('div');
            var zoomControl = new ZoomControl(zoomControlDiv, map);
            function ZoomControl(controlDiv, map) {
                zoomControlDiv.index = 1;
                map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
                controlDiv.style.padding = '5px';
                var controlWrapper = document.createElement('div');
                controlDiv.appendChild(controlWrapper);
                var zoomInButton = document.createElement('div');
                zoomInButton.className = "mapzoom-in";
                controlWrapper.appendChild(zoomInButton);
                var zoomOutButton = document.createElement('div');
                zoomOutButton.className = "mapzoom-out";
                controlWrapper.appendChild(zoomOutButton);
                google.maps.event.addDomListener(zoomInButton, 'click', function () {
                    map.setZoom(map.getZoom() + 1);
                });
                google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                    map.setZoom(map.getZoom() - 1);
                });
            }
        }
        var map = document.getElementById('map-main');
        if (typeof (map) != 'undefined' && map != null) {
            google.maps.event.addDomListener(window, 'load', mainMap);
        }
    });
</script>
@endpush
@endsection