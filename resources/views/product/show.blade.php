@extends('layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)
@section('futured_image', $futured_image)

@section('content')
<div id="wrapper">
    <div class="content">
        @include('partials.title',["title"=>$product->title,"description"=>$product->description,'image'=>$futured_image])
        @php
            $links=[
                ["title"=>"Anasayfa","url"=>route("home")],
            ];
        @endphp
        @include('partials.breadcrumbs',['links'=>$links,'title'=>$product->title])

        <div class="gray-bg small-padding fl-wrap">
            <div class="container">
                <div class="col-md-12">
                    <article class="post-article fl-wrap">
                        <div class="list-single-main-media fl-wrap">
                           <img class="w-100" src="{{$product->image->url}}" alt="{{$product->image->alt}}">
                        </div>
                        <div class="list-single-main-item fl-wrap block_box">
                           <div class="single-article-header fl-wrap">
                                <h2 class="post-opt-title">{{ $product->title }}</h2>
                                <span class="fw-separator"></span> 
                                <div class="clearfix"></div>
                                <div class="post-opt">
                                    <ul class="no-list-style">
                                        <li><i class="fal fa-calendar"></i> <span> {{ $product->event_time->format("H:i d/m/Y") }} </span> </li>
                                        <li><i class="fal fa-map-marker"></i>
                                            <span> {{ $product->address }} </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <span class="fw-separator fl-wrap"></span> 

                            {!! $product->content !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <section class="small-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title st-center fl-wrap">
                            <h2>Başvuru Formu</h2>
                            <h4>Hemen bilgilerinizi doldurun ve katılmak için başvuru yapın.</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form fl-wrap">
                            <div id="message"></div>
                            <form class="custom-form ajax-submit">
                                @csrf
                                <input type="hidden" name="form_type" value="{{ $product->type }}">
                                <fieldset>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                        İsim Soyisim
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="isim" id="text_1" placeholder="İsim Soyisim"
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
                                            İş Ünvanı
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="unvan" id="text_4" placeholder="İş Ünvanı"
                                        value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label>
                                            Daha Önce Gayrimenkul Sektöründe Tecrübeniz Oldu Mu?
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="tecrube" id="text_5" placeholder="Daha Önce Gayrimenkul Sektöründe Tecrübeniz Oldu Mu?"
                                        value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label>
                                            Franchise Alabilecek Sermayeniz Var Mı?
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="sermaye" id="text_6" placeholder="Franchise Alabilecek Sermayeniz Var Mı?"
                                        value=""/>
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