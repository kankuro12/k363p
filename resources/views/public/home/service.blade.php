<div class="owl-feature-service href" data-target="/service/data">
    <div class="image-holder">
        <img src="img/restro.png" alt="">

    </div>
    <div class="owl-feature-description">
        <div class="fs-title" title="aa">
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
            <span class="new">
                
                Nrs. {{$service->getNewPrice()}} 
            </span>
            
            <span  class="old">
                Nrs.  {{$service->price}}
            </span>
            <span class="discount">
                {{$service->discount}}% off
            </span>
           
        </div>
    </div>
</div>