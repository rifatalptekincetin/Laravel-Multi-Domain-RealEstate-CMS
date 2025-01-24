<section class="small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title fl-wrap">
                    <h2>{{ $data['title'] }}</h2>
                    {!! $data['description'] !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-form fl-wrap">
                    <div id="message"></div>
                    <form class="custom-form ajax-submit">
                        @csrf
                        <input type="hidden" name="form_type" value="contact">
                        <fieldset>
                            @foreach ($data["form_fields"] as $key=>$field)
                                @if($field["type"] == "email")
                                    <label><span class="dec-icon"><i class="fas fa-at"></i></span></label>
                                    <input type="email" name="{{slugify($field["label"])}}" id="email_{{$key}}" placeholder="{{$field["label"]}}" value="" />
                                
                                @elseif($field["type"] == "number")
                                    <label><span class="dec-icon"><i class="fas fa-hashtag"></i></span></label>
                                    <input type="number" name="{{slugify($field["label"])}}" id="number_{{$key}}" placeholder="{{$field["label"]}}" value="" />
                                
                                @elseif($field["type"] == "text")
                                    <label><span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                    <input type="text" name="{{slugify($field["label"])}}" id="text_{{$key}}" placeholder="{{$field["label"]}}" value="" />

                                @elseif($field["type"] == "textarea")
                                    <textarea name="{{slugify($field["label"])}}" id="textarea_{{$key}}" cols="40" rows="3"
                                    placeholder="{{$field["label"]}}"></textarea>

                                @elseif($field["type"] == "checkbox")
                                    <div class="filter-tags ft-list">
                                        <input id="checkbox_{{$key}}" type="checkbox" name="{{slugify($field["label"])}}" value="{{$field["label"]}}" style="margin-top:15px">
                                        <label for="checkbox_{{$key}}" style="margin-top:15px">{{$field["label"]}}</label>
                                    </div>
                                @endif

                            @endforeach
                            
                        </fieldset>
                        @include('partials.kvkk')
                        <div class="clearfix"></div>
                        <button class="btn float-btn color-bg" style="margin-top:20px;" name="submit">
                            Gönder
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>