@extends('layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)
@section('futured_image', $futured_image)

@section('content')
<div id="wrapper">
    <div class="content">
        @include('partials.title',["title"=>$title,"description"=>$description,'image'=>$futured_image])
        @php
            $links=[
                ["title"=>"Anasayfa","url"=>route("home")],
            ];
        @endphp
        @include('partials.breadcrumbs',['links'=>$links,'title'=>$title])

        <div class="gray-bg small-padding fl-wrap">
            <div class="container">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-6">
                            <div class="services-item fl-wrap services-product">
                                <img src="{{ $product->image->medium_url }}">
                                <h4>{{$product->title}}
                                    <span>
                                        @if($product->price > 0)
                                            {{$product->price}} ₺
                                        @else
                                            Ücretsiz
                                        @endif
                                    </span>
                                </h4>
                                <p>{{ $product->address }}</p>
                                <a href="{{ $product->url() }}" class="btn small-btn color-bg" style="display:block;">
                                    Başvurmak İçin Tıklayınız.
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>

    </div>
</div>
@endsection