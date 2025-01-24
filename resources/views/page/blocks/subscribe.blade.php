<section class="gray-bg small-padding">

    <div class="subscribe-wrap fl-wrap">
        <div class="container">
            <div class="subscribe-container fl-wrap color-bg">
                <div class="pwh_bg"></div>
                <div class="mrb_dec mrb_dec3"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="subscribe-header">
                            <h4>{{ $data['title'] }}</h4>
                            <h3>{{ $data['description'] }}</h3>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="footer-widget fl-wrap">
                            <div class="subscribe-widget fl-wrap">
                                <div class="subcribe-form">
                                    <form id="subscribe" novalidate="true">
                                        <input class="enteremail fl-wrap" name="EMAIL" id="subscribe-email"
                                            placeholder="{{ $data["input_placeholder"] }}" spellcheck="false" type="text">
                                        <button type="submit" id="subscribe-button" class="subscribe-button color-bg">
                                        {{ $data["button_text"] }}</button>
                                        <label for="subscribe-email" class="subscribe-message"></label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>