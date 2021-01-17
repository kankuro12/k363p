@if ($vendors->count() > 0)
    <div class="vendors">
        @foreach ($vendors as $vendor)
            @php
            $rating=$vendor->average_review();
            @endphp
            <div class="">
                <div class="name">
                    {{ $vendor->name }}
                </div>
                <div class="address">
                    <span class="d-inline-block">

                        {{ $vendor->location->name ?? '--' }}
                    </span>
                    <span class="d-inline-block">
                        . <i class="fas fa-star"></i>  {{$rating['avg_rating']}}
                    </span>
                    <span class="d-inline-block">
                        . {{$rating['reviews']}} reviews
                    </span>
                </div>
            </div>
            <hr class="p-0 m-0">
        @endforeach
    </div>
@endif
@if ($cities->count()>0)
    @foreach ($cities as $city)
        <div class="search-city">
            <span class="search-name">{{$city->name}} </span>
            <span class="search-link">
                <span>
                    <a href="#">Vendors</a>
                </span>
                |
                <span>
                    <a href="#">Services</a>
                </span>
            </span>
        </div>
        <hr class="p-0 m-0">
    @endforeach
@endif
