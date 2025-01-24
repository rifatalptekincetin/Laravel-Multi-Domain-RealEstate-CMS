<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <meta name="robots" content="index, follow">

        <script>
            // Define dataLayer and the gtag function.
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}

            // Set default consent to 'denied' as a placeholder
            // Determine actual values based on your own requirements
            gtag('consent', 'default', {
            'ad_storage': 'denied',
            'ad_user_data': 'denied',
            'ad_personalization': 'denied',
            'analytics_storage': 'denied'
            });

            function allConsentGranted() {
                gtag('consent', 'update', {
                    'ad_user_data': 'granted',
                    'ad_personalization': 'granted',
                    'ad_storage': 'granted',
                    'analytics_storage': 'granted'
                });
            }
        </script>

        
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JKVFCX8N9B"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-JKVFCX8N9B');
        </script>

        <link rel="icon" type="image/png" href="{{ asset('appico.png') }}" />

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Grand Gayrimenkul">
        <meta name="msapplication-TileImage" content="{{ asset('appico.png') }}">
        <meta name="msapplication-TileColor" content="#c79058">

        <link rel="manifest" href="/manifest.json">
        <link rel="apple-touch-icon" href="{{ asset('appico.png') }}">

        <title>@yield('meta_title')</title>
        <meta property="og:locale" content="tr_TR" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="@yield('meta_title')" />
        <meta property="og:description" content="@yield('meta_description')" />
        <meta property="og:url" content="{{url()->full()}}" />
        <meta property="og:site_name" content="{{env('APP_NAME')}}" />
        <meta property="og:image" content="@yield('futured_image')" />
        <meta property="og:image:secure_url" content="@yield('futured_image')" />

        @vite('resources/css/app.css')
        @stack('styles')
        <style>
            .services-product{
                padding:1rem!important;
            }

            .services-product img{
                width:100%;
                margin-bottom:2rem;
            }

            .editor h1,.editor h2,.editor h3,.editor h4{
                margin-bottom:1rem;
            }

            .editor ul{
                list-style:initial;
                padding-left: 1rem;
            }

            .details-list.full-width .boxed {
                display: inline-block;
            }
        </style>
    </head>
    <body class="" style="max-width: 100%;overflow-x: hidden;">
        <div id="main">
            @include('partials.header')
            @yield('content')
            @include('partials.footer')
            @include('partials.login-modal')

            @if(1)
            <div class="app-install" style="float: left;width: 100%;border-top: solid 1px #c79058;padding: 10px;text-align: left;display:block;position:relative;bottom:0px;left:0px;right:0px;background:#18181b;z-index:5">
                <div class="row">
                    <div class="col-xs-8">
                        <h4 style="
                            font-weight: 900;
                            font-size: 16px;
                        ">Uygulamayı Kur</h4>
                        <p style="
                            line-height: 13px;
                            margin-top: 5px;
                            font-size: 11px;
                        ">
                        GG uygulamasını ana ekrana ekleyin.</p>
                    </div>
                    <div class="col-xs-4" style="position:relative;">
                        <button class="btn color-bg float-btn small-btn" id="installApp" style="
                            margin-top: 0px;
                            border: none;
                            border-radius: 99px;
                            width: 100%;
                        ">Yükle</button>

                        <button id="closeApp" style="
                            margin-top: 0px;
                            width: 30px;
                            height: 30px;
                            border-radius: 99px;
                            border: solid 1px #fff5;
                            background: #18181b;
                            color: white;
                            position: absolute;
                            top: -35px;
                            right: 10px;
                        ">x</button>
                    </div>
                </div>
                
            </div>
            <script>
                window.mobileCheck = function() {
                    let check = false;
                    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
                    return check;
                };

                let deferredPrompt;
                window.addEventListener('beforeinstallprompt', (e) => {
                    deferredPrompt = e;
                });

                const installApp = document.getElementById('installApp');
                installApp.addEventListener('click', async () => {
                    localStorage.setItem('installclick',true);
                    if (deferredPrompt !== null) {
                        if (deferredPrompt) {
                            deferredPrompt.prompt();
                            const { outcome } = await deferredPrompt.userChoice;
                            if (outcome === 'accepted') {
                                deferredPrompt = null;
                            }
                        }
                    }
                });

                const closeApp = document.getElementById('closeApp');
                closeApp.addEventListener('click', async () => {
                    localStorage.setItem('installclick',true);
                    document.querySelector('.app-install').style.position = 'relative';
                    document.querySelector('#closeApp').style.display = 'none';
                });

                if(localStorage.getItem('installclick')){
                    document.querySelector('.app-install').style.position = 'relative';
                    document.querySelector('#closeApp').style.display = 'none';
                }

                if(mobileCheck()){
                    if (!window.matchMedia('(display-mode: standalone)').matches) {
                        document.querySelector('.app-install').style.display = 'block';
                    }
                }
            </script>
            @endif

        </div>

        <div class="pricing-column fl-wrap cookie-policy"
            style="
                position: fixed;
                width: 90%;
                bottom: 10px;
                right: 10px;
                max-width: 300px;
                z-index: 9;
                margin: 0px;
                display:none;
            ">
            <div class="pricing-header">
                <h3><span>01.</span> Çerez İzinleri</h3>
                <p>Merhaba, çerez politikamız hakkında sizi bilgilendirmek istiyoruz.
                    Grand Gayrimenkul kullanıcı deneyimini güzelleştirmek ve kolaylaştırmak için çerezleri kullanıyor.
                    Aşağıdaki butona tıklayıp çerez kullanımını onaylayabilirsiniz.  </p>
            </div>
            <a href="javascript:;" class="price-link color-bg fl-wrap" onclick="allConsentGranted();$('.cookie-policy').hide();localStorage.setItem('consentGranted', true);">Onaylıyorum</a> 
        </div>

        <a target="_blank" href="https://www.grandgayrimenkul.ai/">
            <img src="{{ asset('grandai-btn.png') }}" style="position: fixed;left: 5px;bottom: 5px;width: 120px;z-index: 8;">
        </a>

        <script>
            if(localStorage.getItem('consentGranted')){
                document.querySelector('.cookie-policy').style.display = 'none';
            }else{
                document.querySelector('.cookie-policy').style.display = 'block';
            }
        </script>
        
        <script>
            if (typeof navigator.serviceWorker !== 'undefined') {
                navigator.serviceWorker.register('sw.js?asdf')
            }
        </script>

        <div id="google_translate_element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({ pageLanguage: 'tr' }, 'google_translate_element');
            }

            function change_lang(lng) {
                var languageSelect = document.querySelector("select.goog-te-combo");
                languageSelect.value = lng;
                languageSelect.dispatchEvent(new Event("change"));
            }
        </script>
        <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        @vite('resources/js/app.js')
        <script defer src="{{ asset('theme/js/plugins.js') }}?v=5"></script>
        <script defer src="{{ asset('theme/js/scripts.js') }}?v=7"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env("GOOGLE_MAPS_API_KEY") }}&libraries=places"></script>
        <script defer src="{{ asset('theme/js/map-single.js') }}?v=black"></script>
        <script defer src="{{ asset('theme/js/map-plugins.js') }}"></script>
        {{-- <script defer src="{{ asset('theme/js/map-listing.js') }}"></script> --}}
        @stack('scripts')
        <script>
            window.suggest_route = '{{ route('listing.ajax.suggest') }}';
            window.short_data_route = '{{ route('listing.ajax.short-data') }}';
            window.form_submit_route = '{{ route('form.submit') }}';
        </script>
        <script defer src="{{ asset('theme/js/layout.js') }}?v=3"></script>
    </body>
</html>