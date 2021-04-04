<div class="owl-feature-vendor href" data-target="{{route('n.single_vendor',['slug'=>$vendor->slug])}}">
    <div class="image-holder">
        <img  src="{{asset('uploads/vendor/logo/'.$vendor->logo)}}" alt="">

    </div>
    <div class="owl-feature-description">
        <div class="f-title">
            {{$vendor->name}}
        </div>
        <div class="f-subtitle">
            {{$vendor->location!=null?$vendor->location->name??'N/A':'N/A'}}
        </div>

        @php
            $rating=$vendor->average_review();
        @endphp
        <div class="f-rating">
            <span class="f-rating-display">
                <span class="f-num">
                    {{$rating['avg_rating']}}
                </span>
                <span>
                    <i class="fas fa-star"></i>
                </span>

            </span>
            <span class="d-none d-md-inline-block">

                <i class="fas fa-circle"></i>
            </span>
            <span class="f-rating-count d-inline-block">
                ( {{$rating['reviews']}} reviews )
            </span>
            <span >

                <i class="fas fa-circle"></i>
            </span>
            <span class="d-inline-block">
                ( {{$rating['services']}} services )
            </span>
        </div>
    </div>
</div>
