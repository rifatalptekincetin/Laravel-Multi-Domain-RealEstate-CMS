@include('partials.title',["title"=>$data["title"],"description"=>$data["description"],'image'=>get_image_url($data["image_id"])])
@php
    $links=[
        ["title"=>"Anasayfa","url"=>route("home")],
    ];
@endphp
@include('partials.breadcrumbs',['links'=>$links,'title'=>$data["title"]])