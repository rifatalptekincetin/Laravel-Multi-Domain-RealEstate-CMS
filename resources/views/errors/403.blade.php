@extends('layout')
@section('content')
<div id="wrapper">
    <div class="content">
        <section class="parallax-section color-bg" data-scrollax-parent="true" style="overflow:hidden;">
            <div class="container">
                <div class="error-wrap">
                    <div class="hero-text-big">
                        <h6>403</h6>
                    </div>
                    <p>Üzügünüz ama buraya erişim izniniz yok.</p>
                    <div class="clearfix"></div>
                    <form action="#">
                        <input name="se" id="se" type="text" class="search" placeholder="Ara..">
                        <button class="search-submit" id="submit_btn"><i class="fal fa-search"></i> </button>
                    </form>
                    <div class="clearfix"></div>
                    <p>Ve Ya</p>
                    <a href="{{ route('home') }}" class="btn   color-bg">Anasayfaya Gidin</a>
                </div>
            </div>
            <div class="pwh_bg fw-pwh">
                <div class="mrb_pin vis_mr mrb_pin3 "></div>
                <div class="mrb_pin vis_mr mrb_pin4 "></div>
            </div>
        </section>
    </div>
</div>
@endsection