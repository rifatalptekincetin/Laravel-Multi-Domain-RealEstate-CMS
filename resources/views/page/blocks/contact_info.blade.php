<section class="gray-bg small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="services-item fl-wrap">
                    <i class="fal fa-envelope"></i>
                    <h4>E-Posta Adresimiz <span>01</span></h4>
                    <a href="mailto:{{ $data["email"] }}" class="serv-link sl-b">{{ $data["email"] }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-item fl-wrap">
                    <i class="fal fa-phone-rotary"></i>
                    <h4>Telefon Numaramız<span>02</span></h4>
                    <a href="tel:{{ $data["phone"] }}" class="serv-link sl-b">{{ $data["phone"] }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-item fl-wrap">
                    <i class="fal fa-map-marked"></i>
                    <h4>Ofis Adresimiz <span>03</span></h4>
                    <a href="#" class="serv-link sl-b">{{ $data["address"] }}</a>
                </div>
            </div>
        </div>
    </div>
</section>