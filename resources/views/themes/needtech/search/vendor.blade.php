<div class="all-vendors">
    @foreach ($all as $vendor)

    <div class="single-vendor">
        <div  class="owl-carousel owl-services service-container" id="vendor_{{$vendor->id}}">
            @foreach ($vendor->services as $service)
                <div  class="service" data-price="{{$service->getNewPrice()}}" data-type="{{$service->roomtype_id}}">
                    <div class="image" style="max-height:130px;overflow:hidden;">
                        <img  src="{{asset('uploads/vendor/roomphotos/263x160/'.$service->roomphotos[0]->image)}}" alt="">
                        <div class="description">
                            <div class="name">
                                {{$service->name}} | Rs. {{round($service->getNewPrice())}}
                            </div>
                        </div>
                    </div>

                    <div class="link">
                        <a href="{{route('n.single_service',['r_slug'=>$service->slug,'v_slug'=>$vendor->slug])}}">View Detail</a>
                    </div>

                </div>
            @endforeach
        </div>
        <div>
            <div class="title d-block d-md-inline">
                <span>
                    {{$vendor->name}}<span class="d-none d-md-inline">,</span>
                </span>

            </div>

            @php
                $rating=$vendor->average_review();
            @endphp
            <div class="subtitle d-block d-md-inline">
                <span>
                    {{$vendor->location->name??"NA"}}
                </span>

            </div>
            <style>
                .md-right{
                    float:right;

                }
                @media(max-width:768px){
                    .md-right{
                        float:none;

                    }  
                }
            </style>
            <div class="subtitle d-block d-md-inline" style="font-weight:700;">
                <span >
                    <a href="{{route('n.single_vendor',['slug'=>$vendor->slug])}}">View Detail</a>
                </span>

            </div>
        </div>
        <div class="divider my-2" ></div>
    </div>
    @endforeach
</div>
<div style="height:50px;"></div>
