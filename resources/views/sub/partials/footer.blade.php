@php
$footer = get_subsite()->footer;
@endphp

<footer class="main-footer fl-wrap">
    <div class="footer-inner fl-wrap">
        <div class="container">
            <div class="row">
                
                <div class="col-md-3">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-logo fl-wrap">
                            <img src="{{ get_image_url($footer['footer_logo']) }}" alt="{{get_subsite()->title}}">
                        </div>
                        {!! $footer["footer_description"] !!}
                    </div>
                </div>
                
                
                <div class="col-md-3">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ $footer["footer_menu_title"] }}</h4>
                        </div>
                        <ul class="footer-list fl-wrap">
                            @if($footer["footer_menu_links"])
                                @foreach($footer["footer_menu_links"] as $_link)
                                    <li><a href="{{ $_link["url"] }}">{{ $_link["title"] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
                
                <div class="col-md-3">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ $footer["footer_menu2_title"] }}</h4>
                        </div>
                        <ul class="footer-list fl-wrap">
                            @if($footer["footer_menu2_links"])
                                @foreach($footer["footer_menu2_links"] as $_link)
                                    <li><a href="{{ $_link["url"] }}">{{ $_link["title"] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                </li>
                
                <div class="col-md-3">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ $footer["footer_contact_title"] }}</h4>
                        </div>
                        <ul class="footer-contacts fl-wrap">
                            <li>
                                <span><i class="fal fa-envelope"></i> E-posta :</span>
                                <a href="malto:{{ $footer["footer_email"] }}" target="_blank">
                                    {{ $footer["footer_email"] }}
                                </a>
                            </li>

                            <li>
                                <span><i class="fal fa-map-marker"></i> Adres :</span>
                                <a href="#" target="_blank">
                                    {{ $footer["footer_address"] }}
                                </a>
                            </li>

                            <li>
                                <span><i class="fal fa-phone"></i> Telefon :</span>
                                <a href="tel:{{ $footer["footer_phone"] }}">{{ $footer["footer_phone"] }}</a>
                            </li>
                        </ul>
                        <div class="footer-social fl-wrap">
                            <ul>
                                @if($footer["footer_facebook"])
                                    <li><a href="{{ $footer["footer_facebook"] }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($footer["footer_instagram"])
                                    <li><a href="{{ $footer["footer_instagram"] }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if($footer["footer_linkedin"])
                                    <li><a href="{{ $footer["footer_linkedin"] }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                @endif
                                @if($footer["footer_youtube"])
                                    <li><a href="{{ $footer["footer_youtube"] }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
    
    <div class="sub-footer gray-bg fl-wrap">
        <div class="container">
            <div class="copyright"> {{ settings("copyright") }} </div>
            <div class="subfooter-nav">
                <ul class="no-list-style">
                    @if(settings("copyright_menu_links"))
                        @foreach(settings("copyright_menu_links") as $_link)
                            <li><a href="{{ $_link["url"] }}" target="_blank">{{ $_link["title"] }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    
</footer>