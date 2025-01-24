@extends('layout')

@section('meta_title', 'Talep Oluştur | '.env('APP_NAME'))

@section('content')
<div id="wrapper">
   <div class="content">
         @include('partials.title',["title"=>'Talep Oluştur',"description"=>Null,'image'=>Null])
         @php
               $links=[
                  ["title"=>"Anasayfa","url"=>route("home")],
               ];
         @endphp
         @include('partials.breadcrumbs',['links'=>$links,'title'=>'Talep Oluştur'])


        <section class="small-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title st-center fl-wrap">
                            <h2>Talep Formu</h2>
                            <h4>Gayrimenkul almak, satmak, kiralamak için aşağıdaki bilgileri doldurup bize mesaj gönderebilirsiniz.</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form fl-wrap">
                            <div id="message"></div>
                            <form class="custom-form ajax-submit">
                                @csrf
                                <input type="hidden" name="form_type" value="contact">
                                <fieldset>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                        İsim Soyisim
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="isim-soyisim" id="text_1" placeholder="İsim Soyisim"
                                        value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label>
                                        Telefon
                                        <span class="dec-icon"><i class="fas fa-hashtag"></i></span></label>
                                        <input type="number" name="telefon" id="text_2" placeholder="053XXXXXXX"
                                        value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label>
                                            E-posta
                                        <span class="dec-icon"><i class="fas fa-at"></i></span></label>
                                        <input type="email" name="eposta" id="text_3" placeholder="isim@saglayici.com"
                                        value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label>
                                            Talep Konumu
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="adres" id="text_4" placeholder="İl, ilçe, mahalle"
                                        value=""/>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Notlarınız</label>
                                        <textarea name="notlar" id="textarea_5" cols="40" rows="3"
                                        placeholder="Eklemeniz gereken notları buraya ekleyiniz"></textarea>
                                    </div>

                                    </div>
                                </fieldset>
                                @include('partials.kvkk')
                                <button class="btn float-btn color-bg" style="margin-top:20px;" name="submit">
                                    Gönder
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

   </div>
</div>
@endsection