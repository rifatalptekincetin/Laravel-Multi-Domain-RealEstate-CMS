@php
if($data["site_ids"]){
    $agencies = \App\Models\Site::whereNotNull('image_id')->whereIn('id',$data["site_ids"])->get();
}
else{
    $agencies = \App\Models\Site::whereNotNull('image_id')->get();
}
@endphp
<section >
    <div class="container">
        
        <div class="section-title st-center fl-wrap">
            <h2>{{ $data["title"] }}</h2>
            <h4>{{ $data["description"] }}</h4>
        </div>
        
        <div class="clearfix"></div>

        <div class="listing-item-container one-column-grid-wrap  box-list_ic agency-list fl-wrap">
            <div class="row">
                @foreach($agencies as $agency)
                    <div class="col-lg-6">
                        @include('partials.agency',['_agency'=>$agency])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>