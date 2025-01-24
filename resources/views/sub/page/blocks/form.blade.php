<section class="small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title st-center fl-wrap">
                    <h2>{{ $data['title'] }}</h2>
                    <h4>{{ $data['description'] }}</h4>
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
                        <input type="hidden" name="site_id" value="{{ get_subsite()->id }}">
                        <fieldset>
                            <div class="row">
                            @foreach ($data["form_fields"] as $key=>$field)
                                @if($field["type"] == "email")
                                    <div class="col-md-{{$field["column"]}}">
                                        <label>
                                            {{$field["label"]}}
                                            <span class="dec-icon"><i class="fas fa-at"></i></span>
                                        </label>
                                        <input type="email" name="{{slugify($field["label"])}}" id="email_{{$key}}" placeholder="{{$field["label"]}}"
                                        value="" @if($field["required"]) required @endif @if($field["helper"]) style="margin-bottom:10px;" @endif />
                                        @if($field["helper"])
                                        <small style="display: block;text-align: left;margin-bottom: 20px;opacity: 0.5;">
                                            {{ $field["helper"] }}
                                        </small>
                                        @endif
                                    </div>
                                @elseif($field["type"] == "number")
                                    <div class="col-md-{{$field["column"]}}">
                                        <label>
                                        {{$field["label"]}}
                                        <span class="dec-icon"><i class="fas fa-hashtag"></i></span></label>
                                        <input type="number" name="{{slugify($field["label"])}}" id="number_{{$key}}" placeholder="{{$field["label"]}}"
                                        value="" @if($field["required"]) required @endif @if($field["helper"]) style="margin-bottom:10px;" @endif />
                                        @if($field["helper"])
                                        <small style="display: block;text-align: left;margin-bottom: 20px;opacity: 0.5;">
                                            {{ $field["helper"] }}
                                        </small>
                                        @endif
                                        </div>
                                @elseif($field["type"] == "text")
                                    <div class="col-md-{{$field["column"]}}">
                                        <label>
                                        {{$field["label"]}}
                                        <span class="dec-icon"><i class="fas fa-pencil"></i></span></label>
                                        <input type="text" name="{{slugify($field["label"])}}" id="text_{{$key}}" placeholder="{{$field["label"]}}"
                                        value="" @if($field["required"]) required @endif @if($field["helper"]) style="margin-bottom:10px;" @endif  />
                                        @if($field["helper"])
                                        <small style="display: block;text-align: left;margin-bottom: 20px;opacity: 0.5;">
                                            {{ $field["helper"] }}
                                        </small>
                                        @endif
                                        </div>
                                @elseif($field["type"] == "textarea")
                                    <div class="col-md-{{$field["column"]}}">
                                        <label>{{$field["label"]}}</label>
                                        <textarea name="{{slugify($field["label"])}}" id="textarea_{{$key}}" cols="40" rows="3"
                                        placeholder="{{$field["label"]}}" @if($field["required"]) required @endif></textarea>
                                        @if($field["helper"])
                                        <small style="display: block;text-align: left;margin-bottom: 20px;opacity: 0.5;">
                                            {{ $field["helper"] }}
                                        </small>
                                        @endif
                                    </div>
                                @elseif($field["type"] == "checkbox")
                                    <div class="col-md-{{$field["column"]}}">
                                        <div class="filter-tags ft-list">
                                            <input id="checkbox_{{$key}}" type="checkbox" name="{{slugify($field["label"])}}"
                                            @if($field["required"]) required @endif style="margin-top:15px">
                                            <label for="checkbox_{{$key}}" style="margin-top:15px">{{$field["label"]}}</label>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
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