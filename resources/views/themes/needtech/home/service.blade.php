
<div class="owl-service href" data-target="{{route('n.servicetype',['slug'=>$roomtype->slug])}}">
    <div class="image-holder">
        <img src="{{asset('uploads/vendor/room_type/icons/'.$roomtype->icon)}}" alt="">
    </div>
    <div class="service-title">

        {{$service->name}}
    </div>

</div>

