<footer class="main-footer fl-wrap">
    <div class="footer-inner fl-wrap">
        <div class="container">
            <div class="row">
                
                <div class="col-md-3">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-logo fl-wrap">
                            <img src="{{ get_image_url(settings("footer_logo")) }}" alt="">
                        </div>
                        {!! settings("footer_description") !!}
                        <div class="footer-social fl-wrap">
                            <ul>
                                @if(settings("footer_facebook"))
                                    <li><a href="{{ settings("footer_facebook") }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if(settings("footer_instagram"))
                                    <li><a href="{{ settings("footer_instagram") }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if(settings("footer_linkedin"))
                                    <li><a href="{{ settings("footer_linkedin") }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if(settings("footer_youtube"))
                                    <li><a href="{{ settings("footer_youtube") }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-2">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ settings("footer_menu_title") }}</h4>
                        </div>
                        <ul class="footer-list fl-wrap">
                            @if(settings("footer_menu_links"))
                                @foreach(settings("footer_menu_links") as $_link)
                                    <li><a href="{{ $_link["url"] }}">{{ $_link["title"] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
                
                <div class="col-md-2">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ settings("footer_menu2_title") }}</h4>
                        </div>
                        <ul class="footer-list fl-wrap">
                            @if(settings("footer_menu2_links"))
                                @foreach(settings("footer_menu2_links") as $_link)
                                    <li><a href="{{ $_link["url"] }}">{{ $_link["title"] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ settings("footer_menu3_title") }}</h4>
                        </div>
                        <ul class="footer-list fl-wrap">
                            @if(settings("footer_menu3_links"))
                                @foreach(settings("footer_menu3_links") as $_link)
                                    <li><a href="{{ $_link["url"] }}">{{ $_link["title"] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="footer-widget fl-wrap">
                        <div class="footer-widget-title fl-wrap">
                            <h4>{{ settings("footer_contact_title") }}</h4>
                        </div>
                        <ul class="footer-contacts fl-wrap">
                            <li>
                                <span><i class="fal fa-envelope"></i> E-posta :</span>
                                <a href="malto:{{ settings("footer_email") }}" target="_blank">
                                    {{ settings("footer_email") }}
                                </a>
                            </li>

                            <li>
                                <span><i class="fal fa-map-marker"></i> Türkiye Merkez Ofis :</span>
                                <a style="line-height:18px;display:contents;">
                                    {{ settings("footer_address") }}
                                </a>
                            </li>

                            <li>
                                <span><i class="fal fa-phone"></i> Telefon :</span>
                                <a href="tel:{{ settings("footer_phone") }}">{{ settings("footer_phone") }}</a>
                            </li>
                        </ul>
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
                            <li><a href="{{ $_link["url"] }}">{{ $_link["title"] }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    
</footer>