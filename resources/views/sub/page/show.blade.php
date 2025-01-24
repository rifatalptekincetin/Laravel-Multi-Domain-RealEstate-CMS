@extends('sub.layout')

@section('meta_title', $meta_title)
@section('meta_description', $meta_description)

@section('content')
<div id="wrapper">
   <div class="content">
      @foreach($page->content as $block)
         @include('sub.page.blocks.'.$block["type"],['data'=>$block["data"]])
      @endforeach
   </div>
</div>
@endsection