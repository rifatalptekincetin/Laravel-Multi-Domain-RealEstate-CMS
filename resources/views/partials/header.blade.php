<header class="main-header">
    
    <div class="logo-holder"><a href="{{ route('home') }}"><img src="{{ asset('gg.png') }}" alt=""></a></div>
    
    
    <div class="nav-button-wrap color-bg nvminit">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    
    
    <div class="add-list_wrap">
        <a href="/ilanlar" class="add-list color-bg"><i class="fal fa-list"></i> <span>
            İlanlar</span></a>
    </div>
    
    <div class="header-opt_btn tolt" data-microtip-position="bottom"  data-tooltip="Dil">
        <span><i class="fal fa-globe"></i></span>
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
                @if(settings('main_menu'))
                    @foreach(settings('main_menu') as $_link)
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
    

    <div class="header-opt-modal novis_header-mod">
        <div class="header-opt-modal-container hopmc_init" translate="no">
            <a class="header-opt-modal-item lang-item fl-wrap flag_link tr" href="javascript:;" data-lantext="TR" onclick="change_lang('tr')">
                <h4><img src="{{ asset('flags/tr.png') }}">Türkçe <span>TR</span></h4>
            </a>
            <a class="header-opt-modal-item lang-item fl-wrap flag_link en" href="javascript:;" data-lantext="EN" onclick="change_lang('en')">
                <h4><img src="{{ asset('flags/gb.png') }}">English <span>EN</span></h4>
            </a>

        </div>
    </div>

</header>