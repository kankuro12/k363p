<div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 mb-4 service">
    <div class="shadow">
        <div class="image-holder owl-carousel" >
            @foreach ($service->roomphotos as $photo)
            <img src="{{asset('uploads/vendor/roomphotos/263x160/'.$photo->image)}}" alt="service image">
            @endforeach
        </div>
        <div class="owl-feature-description href" data-target="{{route('public.get_room',['vslug'=>$vendor->slug,'rslug'=>$service->slug])}}">
            <div class="fs-title" title="{{$service->name}}">
                {{$service->name}}
            </div>
            <div class="fs-subtitle">
                {{$service->vendor->name}}
            </div>
            <div class="fs-rating">
                
                <span class="fs-rating-count">
                    ({{$service->bookings()->count()}} Bookings)
                </span>
            </div>
            <div class="fs-price">
                @if($service->discount!=0)
                <span class="new">
                    
                    Nrs. {{$service->getNewPrice()}} 
                </span>
                <span  class="old">
                    Nrs.  {{$service->price}}
                </span>
                <span class="discount">
                    {{$service->discount}}% off
                </span>
                @else
                <span class="new">Nrs.{{$service->price}}</span>
                @endif       
            </div>
        </div>
    </div>
</div>