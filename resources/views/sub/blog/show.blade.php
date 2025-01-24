@extends('sub.layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)
@section('futured_image', $futured_image)

@section('content')
<div id="wrapper">
    <div class="content">
        @include('sub.partials.title',["title"=>$blog->title,"description"=>Null,'image'=>$blog->image->url])
        @php
            $links=[
                ["title"=>"Anasayfa","url"=>route("sub.home",get_subdomain())],
                ["title"=>"Blog","url"=>route("sub.blog.index",get_subdomain())],
            ];
        @endphp
        @include('sub.partials.breadcrumbs',['links'=>$links,'title'=>$blog->title])

        <div class="gray-bg small-padding fl-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        


                    <article class="post-article fl-wrap">
                        <div class="list-single-main-media fl-wrap">
                           <img class="w-100" src="{{$blog->image->url}}" alt="{{$blog->image->alt}}">
                        </div>
                        <div class="list-single-main-item fl-wrap block_box">
                           <div class="single-article-header fl-wrap">
                                 <h2 class="post-opt-title">{{ $blog->title }}</h2>
                                 <span class="fw-separator"></span> 
                                 <div class="clearfix"></div>
                                 
                                 <div class="post-opt">
                                    <ul class="no-list-style">
                                       <li><i class="fal fa-calendar"></i> <span> {{ $blog->created_at->format("d/m/Y") }} </span></li>
                                       <li><i class="fal fa-tags"></i>
                                          @foreach($blog->categories as $cat)
                                             <a href="{{ $cat->url(get_subdomain()) }}">{{ $cat->title }}</a>
                                          @endforeach
                                       </li>
                                       <li><i class="fal fa-user"></i>
                                          @if($blog->user)
                                             <a href="{{ $blog->user->url(get_subdomain()) }}">{{ $blog->user->name }}</a>
                                          @endif
                                       </li>
                                    </ul>
                                 </div>
                           </div>
                           <span class="fw-separator fl-wrap"></span> 
                            {!! $blog->content !!}
                           <div class="clearfix"></div>
                           <span class="fw-separator fl-wrap"></span> 
                           <div class="list-single-tags tags-stylwrap">
                                 <span class="tags-title">  Etiketler : </span>
                                 @foreach($blog->tags as $tag)
                                 <a href="{{ $tag->url(get_subdomain()) }}">{{ $tag->title }}</a>
                                 @endforeach                                                                           
                           </div>
                        </div>
                     </article>
                      						
                                 
                     <div class="content-nav_holder fl-wrap color-bg">
                        <div class="content-nav">
                           <ul>
                           @if($blog->previous())
                                 <li>
                                    <a href="{{ $blog->previous()->url(get_subdomain()) }}" class="ln"><i class="fal fa-long-arrow-left"></i><span> <strong>{{$blog->previous()->title}}</strong></span></a>
                                    <div class="content-nav-media">
                                       <div class="bg"  data-bg="{{ $blog->previous()->image->medium_url }}"></div>
                                    </div>
                                 </li>
                            @endif
                            @if($blog->next())
                                 <li>
                                    <a href="{{$blog->next()->url(get_subdomain())}}" class="rn"><span ><strong>{{$blog->next()->title}}</strong></span> <i class="fal fa-long-arrow-right"></i></a>
                                    <div class="content-nav-media">
                                       <div class="bg"  data-bg="{{ $blog->next()->image->medium_url }}"></div>
                                    </div>
                                 </li>
                            @endif
                           </ul>
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