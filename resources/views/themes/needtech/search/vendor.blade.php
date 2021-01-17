<div class="all-vendors">
    @foreach ($all as $vendor)

    <div class="single-vendor">
        <div  class="owl-carousel owl-services service-container" id="vendor_{{$vendor->id}}">
            @foreach ($vendor->services as $service)
                <div  class="service" data-price="{{$service->getNewPrice()}}" data-type="{{$service->roomtype_id}}">
                    <div class="image">
                        <img src="{{asset('uploads/vendor/roomphotos/263x160/'.$service->roomphotos[0]->image)}}" alt="">
                        <div class="description">
                            <div class="name">
                                {{$service->name}} | Rs. {{round($service->getNewPrice())}}
                            </div>
                        </div>
                    </div>

                    <div class="link">
                        <a href="">Book Now</a>
                    </div>

                </div>
            @endforeach
        </div>
        <div>
            <div class="title ">
                <span>
                    {{$vendor->name}}
                </span>

            </div>

            @php
                $rating=$vendor->average_review();
            @endphp
            <div class="subtitle ">
                <span>
                    {{$vendor->location->name??"NA"}}
                </span>

            </div>
            <div class="subtitle " style="font-weight:700;">
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
