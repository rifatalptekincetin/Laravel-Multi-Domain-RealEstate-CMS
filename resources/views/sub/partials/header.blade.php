<header class="main-header">
    <div class="logo-holder"><a href="{{ route('home') }}">
        <img src="{{ get_image_url(get_subsite()->logo_id) }}" alt="{{get_subsite()->title}}"></a>
    </div>
    <div class="nav-button-wrap color-bg nvminit">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    
    
    <div class="add-list_wrap">
        <a href="/ilanlar" class="add-list color-bg"><i class="fal fa-list"></i> <span>
            İlanlar</span></a>
    </div>
    
    
    <div class="cart-btn tolt show-header-modal" data-microtip-position="bottom" data-tooltip="Beğendikleriniz">
        <i class="fal fa-bell"></i>
        <span class="cart-btn_counter color-bg">0</span>
    </div>
    
    @if(auth()->user())
        <a href="{{auth()->user()->panel_url()}}" class="show-reg-form">
            <i class="fas fa-user"></i>
            <span>Panel</span>
        </a>
    @else
    <a href="/app" class="show-reg-form">
        <i class="fas fa-user"></i>
        <span>Giriş</span>
    </a>
    @endif
    
    <div class="nav-holder main-menu">
        <nav>
            <ul class="no-list-style">
                @if(isset(get_subsite()->menu["menu"]) && get_subsite()->menu["menu"])
                    @foreach(get_subsite()->menu["menu"] as $_link)
                        <li>
                            <a href="{{ $_link["url"] }}"
                                @if(current_url() == $_link["url"])
                                class="act-link"
                                @endif
                                >
                                {{ $_link["title"] }}
                                @if($_link["sub_menu"])
                                    <i class="fa fa-caret-down"></i>
                                @endif
                            </a>
                            @if($_link["sub_menu"])
                                <ul>
                                @foreach($_link["sub_menu"] as $_sub_link)
                                    <li><a href="{{ $_sub_link["url"] }}">{{ $_sub_link["title"] }}</a></li>
                                @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
    </div>
    
    
    <div class="header-modal novis_wishlist tabs-act">
        <ul class="tabs-menu fl-wrap no-list-style">
            <li class="current"><a href="#tab-wish"> Beğendiklerim <span>- <span id="wishlist_count">0</span></span></a></li>
            <li><a href="#tab-compare"> Karşılaştır <span>- <span id="compare_count">0</span></span></a></li>
        </ul>
        
        <div class="tabs-container">
            <div class="tab">
                
                <div id="tab-wish" class="tab-content first-tab">
                    
                    <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                        
                        <div class="widget-posts  fl-wrap">
                            <ul class="no-list-style wishlist-holder">
                                
                            </ul>
                        </div>
                        
                    </div>
                    
                    <div class="header-modal-top fl-wrap">
                        <div class="clear_wishlist color-bg"><i class="fal fa-trash-alt"></i> Tümünü Sil</div>
                    </div>
                </div>
                
                
                <div class="tab">
                    <div id="tab-compare" class="tab-content">
                        
                        <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                            
                            <div class="widget-posts  fl-wrap">
                                <ul class="no-list-style compare-holder">
                                    
                                </ul>
                            </div>
                            
                        </div>
                        
                        <div class="header-modal-top fl-wrap">
                            <a class="clear_wishlist color-bg" href="#"><i class="fal fa-random"></i>
                                Karşılaştır</a>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    
</header>