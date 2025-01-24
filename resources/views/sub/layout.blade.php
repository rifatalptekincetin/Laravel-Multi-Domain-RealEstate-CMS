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

        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

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
            @include('sub.partials.header')
            @yield('content')
            @include('sub.partials.footer')
            @include('sub.partials.login-modal')
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

        <script>
            if(localStorage.getItem('consentGranted')){
                document.querySelector('.cookie-policy').style.display = 'none';
            }else{
                document.querySelector('.cookie-policy').style.display = 'block';
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
        <script defer src="{{ asset('theme/js/plugins.js') }}?v=2"></script>
        <script defer src="{{ asset('theme/js/scripts.js') }}?v=6"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env("GOOGLE_MAPS_API_KEY") }}&libraries=places"></script>
        <script defer src="{{ asset('theme/js/map-single.js') }}?v=black"></script>
        <script defer src="{{ asset('theme/js/map-plugins.js') }}"></script>
        @stack('scripts')
        <script>
            window.suggest_route = '{{ route('sub.listing.ajax.suggest',get_subdomain()) }}';
            window.short_data_route = '{{ route('sub.listing.ajax.short-data',get_subdomain()) }}';
            window.form_submit_route = '{{ route('sub.form.submit',get_subdomain()) }}';
        </script>
        <script defer src="{{ asset('theme/js/layout.js') }}?v=3"></script>
    </body>
</html>