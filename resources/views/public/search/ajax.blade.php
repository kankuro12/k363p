@if($vendors->count()>0)
    @foreach($vendors as $vendor)
    <div class="h-room-div">
        <div class="row">
            <div class="col-md-4">
                <div class="h-room-img-wrapper">
                    <img src="{{asset('uploads/vendor/logo/263x160//'.$vendor->logo)}}" class="img-fluid">
                    @if($vendor->average_review()['avg_rating']>0.0)
                    <div class="circle-rating">
                        {{$vendor->average_review()['avg_rating']}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                   
                    <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <h3 class="room-title">{{$vendor->name}}</h3>
                                    </div>
                                    <div class="room-detail-wrapper">
                                        {{-- <div class="avg-cost">
                                            Avg. price: Rs.{{$vendor->average_cost}} / Package
                                        </div> --}}
            
                                        <div class="featured-item-loc mb-1">
                                           <i class="ion-android-pin"></i>
                                           <span> {{$vendor->location?str_limit($vendor->location->name,25,'...'):'N/A'}}</span>
                                         </div>
                                        <div class="mt-3">
                                            @foreach($vendor->amenities->take(5) as $fam)
                                            <span class="mr-2"><img src="{{asset('uploads/vendor/amenities/icons/200x200/'.$fam->icon)}}" width="20px"/></span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>Packages</h3>
                                    <ul>
                                        @foreach ($vendor->rooms as $room)
                                            <li>
                                                <div style="display: flex;justify-content: space-between">
                                                    <span><a href="">{{$room->name}}</a></span>
                                                    <span>200</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                        </div>
                    {{-- </div>
                    <div class="col-md-5"> --}}
                        {{-- <div class="pricing-wrapper text-right">
                            <div class="new-price">Rs.{{$vendor->average_cost}}</div>
                            <div class="per-night">per Package</div>
                        </div> --}}
                        <a href="{{route('public.single_vendor',['slug'=>$vendor->slug])}}" class="btn btn-success float-right mt-2">View Detail ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
    {{$vendors->links()}}
@else
<p>No Matching Properties Found!!!.</p>
@endif
