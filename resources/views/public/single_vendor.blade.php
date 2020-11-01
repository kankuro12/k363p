@extends('layouts.public.index')
@section('content')
<section class="hotel-banner-section">
    <img src="{{asset('uploads/vendor/cover_img/'.$vendor->cover_img)}}" class="img-fluid" />
    <div class="h-b-detail-wrapper">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-7 pb-4">
                    <div class="h-n-a">
                        <h1 class="mb-3">{{$vendor->name}}</h1>
                        <span class="h-loc"><i class="ion-android-pin mr-2"></i> {{$vendor->location?$vendor->location->name:'N/A'}}</span>
                    </div>
                </div>
                <div class="col-md-3 pb-4">
                    {{-- <div class="h-avg-cost">
                        <span class="avg-cost-txt">Avg. Cost</span>
                        <div><span class="cost">Rs.{{$vendor->average_cost}}</span><span> / Package</span></div>
                    </div> --}}
                </div>
                <div class="col-md-2 pb-4">
                    <div class="h-rev text-center">
                        <span class="rating-circle mx-auto mb-2"><span>{{$vendor->average_review()['avg_rating']}}</span></span>
                        @php
                            $reviewscount=$vendor->reviews()->where('status','approved')->count();
                        @endphp
                        <div><a href="#" class="text-white">{{$reviewscount>0?$reviewscount :" No "}} reviews</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="h-d-nav-wrapper sticky-top">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link scroll-anim active" href="#h-gallery">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link scroll-anim" href="#h-about">Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link scroll-anim" href="#h-amenities">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link scroll-anim" href="#h-rooms">Packages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link scroll-anim" href="#h-map">Map</a>
            </li>
            <li class="nav-item">
                <a class="nav-link scroll-anim" href="#h-reviews">Reviews</a>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if($vendor->galleries->count()>0)
            <section class="h-gallery-section mt-4" id="h-gallery">
                <div class="h-gallery-carousel owl-carousel">
                	@foreach($vendor->galleries()->where('status','active')->get() as $vg)
                    <div class="h-gallery-item">
                        <img src="{{asset('uploads/vendor/gallery/263x160/'.$vg->photo)}}" alt="{{$vg->caption}}">
                    </div>
                    @endforeach                   
                </div>
            </section>
            @endif
            <section class="h-details-section mt-4" id="h-about">
                <div class="d-p-heading">
                    <h2>About</h2>
                </div>
                <p>{!!$vendor->description!!}</p>
            </section>
            @if($vendor->amenities->count()>0)
                <div class="h-amenities-section mt-4" id="h-amenities">
                    <div class="d-p-heading">
                        <h2>Services</h2>
                    </div>
                    <div class="row">
                    	@foreach($vendor->amenities as $fam)                	
                    	<div class="col-sm-4 mt-3">
                    	    <img src="{{asset('uploads/vendor/amenities/icons/200x200/'.$fam->icon)}}" class="mr-2" width="20px" height="20px" />
                    	    <span class="am-title">{{$fam->name}}</span>
                    	</div>
                    	@endforeach
                    </div>
                </div>
            @endif
            @if($vendor->rooms->count()>0)
            <div class="h-select-room-section mt-4" id="h-rooms">
                <div class="d-p-heading">
                    <h2>Select Packages</h2>
                </div>
                @foreach($vendor->rooms as $vr)
                <div class="h-room-div">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="h-room-img-wrapper">
                                <img src="{{asset('uploads/vendor/roomphotos/263x160/'.$vr->roomphotos[0]->image)}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="room-title">{{$vr->name}}</h3>
                                </div>
                                <div class="col-md-7">
                                    {{-- <div class="room-detail-wrapper">
                                        <div class="n-o-guest">{{$vr->bed_details()}}</div>
                                    </div> --}}
                                </div>
                                <div class="col-md-5">
                                    <div class="pricing-wrapper text-right">
                                       @if($vr->discount!=0)
                                         <div class="old-price">Rs.{{$vr->price}}</div>
                                       @endif
                                        <div class="new-price">Rs.{{$vr->getNewPrice()}}</div>
                                        {{-- <div class="per-night">per Package</div> --}}
                                    </div>
                                    <a href="{{route('public.get_room',['vslug'=>$vendor->slug,'rslug'=>$vr->slug])}}" class="btn btn-success float-right mt-2">View Detail ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            @endif
            <div class="mt-4" style="background-color:#fff;padding:20px" id="h-map">
                <div class="d-p-heading">
                    <h2>Location</h2>
                </div>
                <div id="map" style="height:300px"></div>
            </div>
            <div class="h-reviews-section mt-4 mb-4" id="h-reviews">
                <div class="d-p-heading">
                    <h2>Reviews</h2>
                </div>
                <div class="total-rating-wrapper d-flex">
                    <div class="t-r-b-wrapper">
                        <div class="total-rating">
                            {{$vendor->average_review()['avg_rating']}}
                        </div>
                    </div>
                    <div class="i-r-wrapper">
                        {{-- <div class="individual-rating">
                            <span class="r-title">Cleanliness</span>
                            <div class="i-r-container">
                                <div class="i-r-progress" data-pct="{{$vendor->average_review()['avg_clean']}}"></div>
                            </div>
                        </div> --}}
                        <div class="individual-rating">
                            <span class="r-title">Comfort</span>
                            <div class="i-r-container">
                                <div class="i-r-progress" data-pct="{{$vendor->average_review()['avg_comfort']}}"></div>
                            </div>
                        </div>
                        {{-- <div class="individual-rating">
                            <span class="r-title">Food</span>
                            <div class="i-r-container">
                                <div class="i-r-progress" data-pct="{{$vendor->average_review()['avg_food']}}"></div>
                            </div>
                        </div> --}}
                        <div class="individual-rating">
                            <span class="r-title">Facilities</span>
                            <div class="i-r-container">
                                <div class="i-r-progress" data-pct="{{$vendor->average_review()['avg_facility']}}"></div>
                            </div>
                        </div>
                        <div class="individual-rating">
                            <span class="r-title">Staff Behaviour</span>
                            <div class="i-r-container">
                                <div class="i-r-progress" data-pct="{{$vendor->average_review()['avg_sbehaviour']}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5" />
                <div id="data_reviews">
                    @foreach($reviews as $vr)
                    <div class="user-reviews">
                        <div class="user-review">
                            <div class="user-img-name mb-2">
                                <div class="user-img-wrapper">
                                    <img src="{{asset('uploads/user/profile_img/200x200/'.$vr->vendor_user->profile_img)}}" class="img-fluid">
                                </div>
                                <span class="user-name">{{$vr->vendor_user->fname." ".$vr->vendor_user->lname}}</span>
                            </div>
                            <div class="review-title">
                                {{$vr->review_title}}
                            </div>
                            <div class="review-desc mt-2">
                                {{$vr->review_description}}
                            </div>
                            <div class="user-rat">{{$vr->rating()}}</div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
                @if($reviews->hasMorePages() == 1)
                <button id="load-more" data-page="{{ $reviews->currentPage() }}" class="btn btn-block btn-success" > Load More </button>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="share-and-contact mt-4">
                <div class="s-a-c-share">
                    <div class="d-p-heading">
                        <h2>Connect with us</h2>
                    </div>
                    <ul class="list-unstyled list-inline">
                        @if($vendor->website)
                        <li class="list-inline-item"><a href="{{$vendor->website}}" target="_blank" data-toggle="tooltip" title="website"><i class="ion-android-globe"></i></a></li>
                        @endif
                        @if($vendor->facebook_url)
                        <li class="list-inline-item"><a href="{{$vendor->facebook_url}}" target="_blank" data-toggle="tooltip" title="facebook"><i class="ion-social-facebook"></i></a></li>
                        @endif
                        @if($vendor->twitter_url)
                        <li class="list-inline-item"><a href="{{$vendor->twitter_url}}" target="_blank" data-toggle="tooltip" title="twitter"><i class="ion-social-twitter"></i></a></li>
                        @endif
                        @if($vendor->instagram_url)
                        <li class="list-inline-item"><a href="{{$vendor->instagram_url}}" target="_blank" data-toggle="tooltip" title="instagram"><i class="ion-social-instagram"></i></a></li>
                        @endif
                    </ul>
                    @if($vendor->tripadvisor_url)
                    <div class="mt-4 mb-2 font-weight-bold">
                        <span class="icon-circle"><img src="{{asset('assets/public/img/tripadvisor.svg')}}" height="30px"></span><a href="{{$vendor->tripadvisor_url}}" target="_blank" class="color1"><span class="ml-2">Trip Advisor</span></a>
                    </div>
                    @endif
                    @if($vendor->phone_number)
                    <div class="mb-3 font-weight-bold d-flex align-items-center">
                        <span class="icon-circle mr-2"><i class="ion-android-call"></i></span><span  class="d-inline-block"><a href="tel:{{$vendor->phone_number}}" class="color1">{{$vendor->phone_number}}</a>@if($vendor->secondary_phone_number),<a href="tel:{{$vendor->secondary_phone_number}}" class="color1"> {{$vendor->secondary_phone_number}}</a>@endif</span>
                    </div>
                    @endif
                    <div class="mb-3 font-weight-bold d-flex align-items-center">
                        <span class="icon-circle mr-2"><i class="ion-android-mail"></i></span><span  class="d-inline-block"><a href="mailto:{{$vendor->user->email}}" class="color1">{{$vendor->user->email}}</a></span>
                    </div>
                    @if(Auth::check())
                        @if(Auth::user()->role->name=="user")
                            @if(count(Auth::user()->vendoruser->favourites->where('vendor_id',$vendor->id)->all())>0)
                            <button class="btn btn-secondary mr-2" id="add_to_fav" data-vendor-id="{{$vendor->id}}"><i class="ion-heart"></i><span id="add_to_fav_text"> Bookmarked </span> </button>
                            @else
                             <button class="btn btn-secondary mr-2" id="add_to_fav" data-vendor-id="{{$vendor->id}}"><i class="ion-heart"></i> <span id="add_to_fav_text"> Bookmark </span></button>
                            @endif
                        @endif                                                             
                    @else
                    <a href="{{ url('user/login?next='.route('public.single_vendor',['slug'=>$vendor->slug])) }}" class="btn btn-secondary mr-2">Bookmark</a>
                    @endif
                   
                    <a href="#" class="btn btn1"><i class="ion-android-map"></i> View on map</a>
                </div>
            </div>
            <div class="hotel-policy mt-4">
                <div class="d-p-heading">
                   <h2>Hotel Policy</h2>
                </div> 
                <div class="mt-3">
                    <div>Check-in: {{$vendor->policy?$vendor->policy->check_in_time:'11:00 AM'}}</div>
                    <div>Check-out: {{$vendor->policy?$vendor->policy->check_out_time:'12:00 PM'}}</div>
                    @if($vendor->policy)
                    <a href="#policy_modal" data-toggle="modal">see more...</a>
                    @endif
                </div>
            </div>
            <div class="hotel-essential-places mt-4">
                <div class="d-p-heading">
                   <h2>Essential Places</h2>
                </div> 
                <div class="essential-place mt-3">
                    <div class="place-title">
                        Biratnagar Airport
                        <span class="place-badge">airport</span>
                    </div>
                    <div class="place-loc">
                        <i class="ion-android-pin"></i>
                        <span>1.2 km</span>
                    </div>
                </div>
                <div class="essential-place mt-3">
                    <div class="place-title">
                        NIC Asia ATM
                        <span class="place-badge">ATM</span>
                    </div>
                    <div class="place-loc">
                        <i class="ion-android-pin"></i>
                        <span>1.5 km</span>
                    </div>
                </div>
                <div class="essential-place mt-3">
                    <div class="place-title">
                        Public Transport
                        <span class="place-badge">transportaion</span>
                    </div>
                    <div class="place-loc">
                        <i class="ion-android-pin"></i>
                        <span>1.2 km</span>
                    </div>
                </div>
                <div class="essential-place mt-3">
                    <div class="place-title">
                        Birat Nurshing Home
                        <span class="place-badge">hospital</span>
                    </div>
                    <div class="place-loc">
                        <i class="ion-android-pin"></i>
                        <span>1.3 km</span>
                    </div>
                </div>
            </div>
            @if($nearbies->count()>0)
            <div class="nearby-res-cafe mt-4">
                <div class="d-p-heading">
                   <h2>Nearby Restaurants / Cafe</h2>
                </div> 
                @foreach($nearbies as $nearby)
                @php
                $id=$nearby->vendor_id;
                $nvendor=App\Model\Vendor\Vendor::find($id);
                $dist=$vendor->vincentyGreatCircleDistance($vendor->location->lay,$vendor->location->lng,$nvendor->location->lat,$nvendor->location->lng);
                @endphp
                <a href="{{route('public.single_vendor',['v'=>$nvendor->slug])}}">
                    <div class="res-cafe">
                        <div class="d-flex">
                            <div class="r-c-img-wrapper">
                                <img src="{{asset('uploads/vendor/logo/263x160/'.$nvendor->logo)}}">
                            </div>
                            <div class="r-c-detail-wrapper">
                                <div class="r-c-title">{{$nvendor->name}}</div>
                                <div class="r-c-loc"><i class="ion-android-pin"></i> {{$dist}}</div>
                                <div class="r-c-avg">avg. cost: Rs. {{$nvendor->average_cost}} </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<section class="social-icon-section text-center py-4">
    <div class="container">
        <span class="social-icon"><i class="ion-social-facebook"></i></span>
        <span class="social-icon"><i class="ion-social-twitter"></i></span>
        <span class="social-icon"><i class="ion-social-instagram"></i></span>
    </div>
</section>
<!--policy modal-->
<div class="modal fade" id="policy_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title color1">Hotel Policy</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <ul>
            @if($vendor->policy)
            <li style="margin-bottom: 5px;"><span class="font-weight-bold">Check In Check Out Policy</span>: {{$vendor->policy->check_in_out_policy}}</li>
            <li style="margin-bottom: 5px;"><span class="font-weight-bold">Cancellation Policy:</span> {{$vendor->policy->cancelation_policy}}</li>
            <li style="margin-bottom: 5px;"><span class="font-weight-bold">Extra Bed Policy:</span> {{$vendor->policy->extra_bed_policy}}</li>
            <li style="margin-bottom: 5px;"><span class="font-weight-bold">Payment Mode:</span> {{$vendor->policy->payment_mode}}</li>
            <li style="margin-bottom: 5px;"><span class="font-weight-bold">Description: </span>{{$vendor->policy->description}}</li>
            @endif
        </ul>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn1" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('click','#add-review',function(){
      $("#review-form-mdl").modal('show');
    });
    
  $(document).on('click','#add_to_fav',function(e){
    var vendor_id=$(this).attr('data-vendor-id');    
    $.ajax({
        type: "post",
        url: "{{route('user.add_to_favourites')}}",
        data:{'vendor_id':vendor_id},
        cache: false,
        success: function (data){
            $("#load-data").html(data);
            if(data.bookmarked){
                $("#add_to_fav_text").text(" Bookmarked");
            }else{
                $("#add_to_fav_text").text(" Bookmark");
            }
            toastr.success(data.message);
          },
          error:function(data){
            console.log(data);
          }
      });
  });

</script>
 <script>
    function initMap() {
      var lat={{$vendor->location->lat?$vendor->location->lat:26.4524746}};
      var lng={{$vendor->location->lng?$vendor->location->lng:87.271781}};

      var myLatLng = {lat: lat, lng: lng};

      // Create a map object and specify the DOM element
      // for display.
      var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 13,
        styles: [
             {
                     "featureType": "administrative.locality",
                     "elementType": "all",
                     "stylers": [
                         {
                             "hue": "#2c2e33"
                         },
                         {
                             "saturation": 7
                         },
                         {
                             "lightness": 19
                         },
                         {
                             "visibility": "on"
                         }
                     ]
                 }
                 
        ]
      });

      // Create a marker and set its position.
      var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Hello World!'
      });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBahYsHxb42lOZjgo5bN04hX7hXCAJCUl8&libraries=places&callback=initMap"></script> 
<script>
    let defaultPage = 2;
    $('#load-more').click(function () {
        $.ajax({
            type: 'GET',
            url: '{{route('public.get_review',['slug'=>$vendor->slug])}}',
            data: {
                page:defaultPage,
            },
            dataType: 'json',            
            success: function (data) {
                defaultPage = data.page +1
                $('#data_reviews').append(data.html);
                if(data.hasMorePages==false){
                   $('#load-more').remove()
                }
            },
            error: function (xhr, type) {
                console.log('Ajax error!')
            }
        });
    });
</script>

@endsection