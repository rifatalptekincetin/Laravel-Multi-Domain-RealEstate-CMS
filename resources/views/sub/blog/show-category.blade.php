@extends('sub.layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)
@section('futured_image', $futured_image)

@section('content')
<div id="wrapper">
    <div class="content">
        @include('partials.title',["title"=>$category->title,"description"=>$category->content,'image'=>$category->image->url])
        @php
            $links=[
                ["title"=>"Anasayfa","url"=>route("sub.home",get_subdomain())],
                ["title"=>"Blog","url"=>route("sub.blog.index",get_subdomain())],
            ];
        @endphp
        @include('sub.partials.breadcrumbs',['links'=>$links,'title'=>$category->title])

        <div class="gray-bg small-padding fl-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="post-container fl-wrap">
                            <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-md-6">
                                    @include('sub.partials.post-vertical',["post"=>$blog])
                                </div>
                            @endforeach
                                <div class="col-md-12">
                                    {{ $blogs->links('sub.partials.pagination') }}
                                </div>
                            </div>
                            					
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="box-widget-wrap fl-wrap fixed-bar">								
                            
                            <div class="box-widget fl-wrap">
                                <div class="box-widget-title fl-wrap">Güncel Yazılar</div>
                                <div class="box-widget-content fl-wrap">
                                    
                                    <div class="widget-posts  fl-wrap">
                                        <ul class="no-list-style">
                                            @foreach(get_posts(5,True) as $post)
                                            <li>
                                                <div class="widget-posts-img"><a href="{{$post->url(get_subdomain())}}"><img src="{{ $post->image->medium_url }}" alt="{{ $post->image->alt }}"></a></div>
                                                <div class="widget-posts-descr">
                                                    <h4><a href="{{$post->url(get_subdomain())}}">{{ $post->title }}</a></h4>
                                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i>{{ $post->created_at->format("Y-m-d") }}</a></div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                                                                            
                                </div>
                            </div>
                             
                            
                            <div class="box-widget fl-wrap">
                                <div class="box-widget-title fl-wrap">Kategoriler</div>
                                <div class="box-widget-content fl-wrap">
                                    <ul class="cat-item no-list-style">
                                        @foreach(get_post_categories() as $cat)
                                        <li><a href="{{ $cat->url(get_subdomain()) }}">{{ $cat->title }}</a> <span> </span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            								
                            
                            <div class="box-widget fl-wrap">
                                <div class="box-widget-title fl-wrap">Etiketler</div>
                                <div class="box-widget-content fl-wrap">
                                    
                                    <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 20px;">
                                        @foreach(get_post_tags() as $tag)
                                        <a href="{{ $tag->url(get_subdomain()) }}">{{ $tag->title }}</a>
                                        @endforeach
                                    </div>
                                                                                            
                                </div>
                            </div>
                             									

                        </div>
                        								
                    </div>
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>

    </div>
</div>
@endsection