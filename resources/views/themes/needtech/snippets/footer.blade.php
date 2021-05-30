<div class="footer d-none d-md-block">
    <div class="title">
        <h1>
            <img class="f-logo" src="{{asset(custom_config('logo')->value)}}">
            <span>
                {{custom_config('footer_title_text')->value}}
            </span>

        </h1>
        <div class="links">
            @php
                $links=[];
                $data=custom_config('footer_title_links');
                if($data!=null && $data->value!=null){

                    $links= json_decode(custom_config('footer_title_links')->value);
                }
            @endphp
            @foreach ($links as $link)
                
                <span class="link href" data-target="{{$link->link}}" >{{$link->text}}</span>
            @endforeach
         
        </div>
    </div>
    <div class="description">
        <div class="row">
            <div class="col-md-5 pb-2">
                <h5>
                    {{custom_config('footer_app_title')->value}}

                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset(custom_config('footer_app_android')->value)}}" class="w-100 href" data-target="{{custom_config('footer_app_android')->secondary_value}}" alt="">
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset(custom_config('footer_app_ios')->value)}}" class="w-100 href" data-target="{{custom_config('footer_app_android')->secondary_value}}" alt="">

                    </div>
                </div>
            </div>
            <div class="col-md-7 pb-2">
                <div class="row h-100">
                    <div class="col-md-6">
                       <div class="important-links h-100">
                           @php
                                $links=[];
                                if(custom_config('footer_2_links')->value!=null){

                                    $links= json_decode(custom_config('footer_2_links')->value);
                                }
                           @endphp
                           @foreach ($links as $link)
                               
                            <span class="link href" data-target="{{$link->link}}" >{{$link->text}}</span>
                           @endforeach
                            {{-- <span class="link">something</span>
                            <span class="link">something</span>
                            <span class="link">something</span>
                            <span class="link">something</span>
                            <span class="link">something</span> --}}
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" h-100" style="padding-top:1rem;">
                            @php
                               $links=[];
                                if(custom_config('footer_3_links')->value!=null){

                                    $links= json_decode(custom_config('footer_3_links')->value);
                                }
                           @endphp
                           @foreach ($links as $link)
                               
                            <span class="link href" data-target="{{$link->link}}" >{{$link->text}}</span>
                           @endforeach
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pb-2">
                <hr style="background:white;">
                <div class="row" >
                    <div class="col-md-6 long-link">
                        {{custom_config('footer_text_left')->value??""}}
                    </div>
                    <div class="col-md-6">
                        {{custom_config('footer_text_right')->value??""}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 pb-2">
                <hr style="background:white;">
                <div class="row" >
                    <div class="col-md-6 ">
                        @php
                               $links=[];
                                if(custom_config('footer_social')->value!=null){

                                    $links= json_decode(custom_config('footer_social')->value);
                                }
                           @endphp
                           @foreach ($links as $link)
                               
                            <img src="{{asset($link->image)}}" class="link href" data-target="{{$link->link}}"  style="width:50px;margin-right:10px;"/>
                           @endforeach
                    </div>
                    <div class="col-md-6 text-right">
                        copyright&#169;{{env('APP_NAME')}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
