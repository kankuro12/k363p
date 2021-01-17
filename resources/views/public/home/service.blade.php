<div class="owl-feature-service href" data-target="/service/data">
    <div class="image-holder">
        <img src="{{asset('uploads/vendor/roomphotos/263x160/'.$service->roomphotos[0]->image)}}" alt="">

    </div>
    <div class="owl-feature-description">
        <div class="fs-title" title="{{$service->name}}">
            {{$service->name}}
        </div>
        <div class="fs-subtitle">
            {{$service->vendor->name}}
        </div>
        <div class="fs-rating">

            <span class="fs-rating-count">
                {{$service->bookings()->count()}} Bookings
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
            <span class="new">Nrs. {{$service->price}}</span>

            @endif
        </div>
    </div>
</div>