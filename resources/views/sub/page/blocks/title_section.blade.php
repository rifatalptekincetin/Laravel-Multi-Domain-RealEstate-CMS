@include('sub.partials.title',["title"=>$data["title"],"description"=>$data["description"],'image'=>get_image_url($data["image_id"])])
@php
    $links=[
        ["title"=>"Anasayfa","url"=>route("sub.home",get_subdomain())],
    ];
@endphp
@include('sub.partials.breadcrumbs',['links'=>$links,'title'=>$data["title"]])