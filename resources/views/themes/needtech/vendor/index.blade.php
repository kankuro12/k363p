@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/singlevendor.css?v=1.1')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\nouislider.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

@endsection
@section('subtitle',$vendor->name)

@section('content')
    <div class="vendor-main">
        <div class="vendor-header">
            <div id="owl-vendor-header" class="owl-carousel">
                @for ($i = 0; $i < 10; $i++)
                <div>
                    <img src="{{asset('uploads/vendor/cover_img/'.$vendor->cover_img)}}" class="img-fluid" />
                </div>

                @endfor

            </div>
            <div class="header-overlay d-none d-md-block">
                <div class="main-desc">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="vendor-name">{{$vendor->name}}</div>
                            <div class="vendor-address">
                                <i class="fas fa-map-marker-alt"></i>
                                {{$vendor->location?$vendor->location->name:'----'}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rating">
                                @php
                                    $rating=$vendor->average_review();
                                @endphp
                                <span class="text-center d-inline-block">
                                    <span class="point">
                                        {{$rating['avg_rating']}}
                                    </span>
                                    <div class="divider"></div>
                                    <span class="count">
                                        {{$rating['reviews']}} reviews
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="header-overlay-mobile mb-2 mb-md-3 py-3 d-block d-md-none p-md-0">
            <div class="container-fluid">
                <div class="name mb-1">
                    {{$vendor->name}}
                </div>
                <div class="address mb-1">
                    {{$vendor->location?$vendor->location->name:'----'}}
                </div>
                <div class="my-2 pt-1">
                    <span class="rating px-3 py-2 " ]>
                        <span class="point px-1">
                            {{$rating['avg_rating']}}
                            <i class="fas fa-star px-1"></i>
                        </span>
                        <span class="px-1">|</span>
                        <span class="count px-1">
                            {{$rating['reviews']}} reviews
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="container d-m pt-0 pt-md-5 ">

            <div class="row">
                <div class="col-md-8 p-mobile-0">
                    <div class="description d-block py-3  mb-2 mb-md-3">
                        <div class="container-fluid">

                            <div class="title">
                                Description
                                <div class="bar"></div>
                            </div>
                            <div class="desc">
                                {!!$vendor->description!!}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="section  mb-2 mb-md-3 py-3">
                        <div class="container-fluid">
                            <div class="title">
                                {{App\Model\Vendor\RoomType::find($key)->name}}
                                <div class="bar"></div>
                            </div>
                            <div class="body "> --}}


                                @foreach ($services as $key=>$item)
                                        @foreach ($item as $service)
                                                {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-5 " data-aos="zoom-out">

                                                    <div  class="single-service my-2" >
                                                        <div class="image">
                                                            <img class="w-100" src="{{asset('uploads/vendor/roomphotos/263x160/'.$service->roomphotos[0]->image)}}" alt="">
                                                            <div class="service-description">
                                                                <div class="name">
                                                                    {{$service->name}} | Rs. {{round($service->getNewPrice())}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="link"><a href="">Book Now</a></div>
                                                    </div>
                                                </div> --}}

                                                @php
                                                $logged=Auth::check();
                                                $isuser=false;
                                                if($logged){
                                                    $user=Auth::user();
                                                    $isuser=$user->checkIfUserRole('user');
                                                    if($isuser){
                                                        $data=$user->vendoruser;
                                                    }
                                                }
                                            @endphp

                                                    <div class="row m-0 single-service mb-2" >
                                                        <div class="col-6 col-md-5 p-0" >
                                                            <div class="image" style="">
                                                                <img class="w-100" src="{{asset('uploads/vendor/roomphotos/263x160/'.$service->roomphotos[0]->image)}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="service-description col-6 col-md-7 " >
                                                            <div class="d-md-flex  d-block justify-content-between">

                                                                <span class="name">
                                                                    {{$service->name}}
                                                                </span>
                                                                <span class="price ">
                                                                    Rs. {{round($service->getNewPrice())}}
                                                                </span>
                                                            </div>
                                                            <div class="roomtype">
                                                                {{$service->roomtype->name}} .   {{$service->bookings()->count()}} Bookings
                                                            </div>
                                                            <hr class="my-1 d-none d-md-block">

                                                            <div class="row d-none d-md-flex" >
                                                                @foreach($service->roomamenities as $ra)
                                                                <div class="mx-2">
                                                                    <span class="feature-item">{{$ra->amenity}}</span>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            {{-- <div class="desc d-none d-md-block">
                                                                {!!$service->description!!}
                                                            </div> --}}
                                                            <div class="links">

                                                                <span  >
                                                                    <form action="{{route('n.single_service',['r_slug'=>$service->slug,'v_slug'=>$vendor->slug])}}">

                                                                        <input class="link" type="submit" value="View Detail" />
                                                                    </form action>
                                                                </span>
                                                                <span  >
                                                                    <form action="{{route('n.startbooking')}}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="isuser" value="{{$isuser?1:0}}">
                                                                        <input type="hidden" name="room_id" value="{{$service->id}}">
                                                                        <input type="submit" class="link" value="booknow">
                                                                    </form>
                                                                    {{-- <a class="link " href="{{route('n.single_service',['r_slug'=>$service->slug,'v_slug'=>$vendor->slug])}}">Book Now</a> --}}
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>


                                        @endforeach
                                    @endforeach


                                {{-- </div>
                            </div>
                        </div> --}}

                    <div class="section mb-2 mb-md-3 py-3" >
                        <div class="container-fluid">

                            <div class="title">
                                Reviews
                                <div class="bar"></div>
                            </div>
                            <div class="body">
                                @if (count($reviews)>0)

                                        @foreach ($reviews as $review)
                                            <div class="review">

                                                <div class="review_title">
                                                    <span class="image" style="background-image: url('{{asset('uploads/user/profile_img/'.$review->vendor_user->profile_img)}}')">
                                                        {{-- <img src="{{asset('uploads/user/profile_img/'.$review->vendor_user->profile_img)}}" alt=""> --}}
                                                    </span>
                                                    <span class="name" style="line-height:1rem;">
                                                        <span>
                                                            {{$review->vendor_user->fname}}
                                                            {{$review->vendor_user->lname}}
                                                        </span>
                                                        <br>

                                                        <span style="color:#009700;">

                                                            <span>
                                                                {{$review->avg_rating}}
                                                            </span>

                                                            <span style="display:flex;width:{{round(23*$review->avg_rating)}}px;overflow:hidden;display:inline-block;white-space: nowrap;">
                                                                <i class="fas fa-star " style="width:21px;"></i>
                                                                <i class="fas fa-star " style="width:21px;"></i>
                                                                <i class="fas fa-star " style="width:21px;"></i>
                                                                <i class="fas fa-star " style="width:21px;"></i>
                                                                <i class="fas fa-star " style="width:21px;"></i>

                                                            </span>

                                                        </span>
                                                        {{-- <span class="ml-4" style="color:#b9b9b9;font-size:0.7rem;">- {{$review->updated_at->diffForHumans()}}</span> --}}
                                                    </span>
                                                </div>
                                                <div class="review_body">
                                                    {{$review->review_description}}
                                                </div>
                                            </div>
                                        @endforeach
                                @else
                                    @if(Auth::check())
                                        <div class="py-2">
                                            No Reviews Yet
                                        </div>
                                    @else
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-mobile-0 ">
                    <div class="section py-3  mb-2 mb-md-3">
                        <div class="container-fluid">

                            <div class="title mb-2">
                                Contact
                                <div class="bar"></div>
                            </div>
                            <div class="body">
                                @if($vendor->phone_number)
                                <div class="contact">
                                    <span class="icon"><i class="fas fa-phone-alt"></i></span>
                                    <span class="text">
                                        <a href="tel:{{$vendor->phone_number}}" >{{$vendor->phone_number}}</a>
                                        @if($vendor->secondary_phone_number)
                                        ,<a href="tel:{{$vendor->secondary_phone_number}}" > {{$vendor->secondary_phone_number}}</a>
                                        @endif
                                    </span>
                                </div>

                                @endif

                                <div class="contact">
                                    <span class="icon"><i class="fas fa-envelope"></i></span>
                                    <span class="text">
                                        <a href="mailto:{{$vendor->user->email}}" >{{$vendor->user->email}}</a>
                                    </span>
                                </div>
                                <div style="padding-top:1px;background:#f1f1f1;" class="mt-2"></div>
                                <div class="d-flex mt-2 justify-content-center">
                                    <span class="ml-1">
                                        <a href="" >
                                            <img style="width:35px;"  src=" {{cdn_asset('social-fb.png')}}" alt="">

                                        </a>
                                    </span>
                                    <span class="ml-1">
                                        <a href="" >
                                            <img style="width:35px;"  src=" {{cdn_asset('social-insta.png')}}" alt="">

                                        </a>
                                    </span>
                                    <span class="ml-1">
                                        <a href="" >
                                            <img style="width:35px;"  src=" {{cdn_asset('social-twitter.png')}}" alt="">

                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($vendor->policy)
                    <div class="section py-2">
                        <div class="container-fluid">

                            <div class="title">
                                Policies
                                <div class="bar"></div>
                            </div>
                            <div class="body">

                                    <dl>
                                        <dt>
                                            Service Enroll Policy
                                        </dt>
                                        <dd style="text-indent: 20px;">
                                            {{$vendor->policy->check_in_out_policy}}
                                        </dd>
                                        <dt>
                                            Cancellation Policy
                                        </dt>
                                        <dd style="text-indent: 20px;">
                                            {{$vendor->policy->cancelation_policy}}
                                        </dd>
                                        <dt>
                                            Payment Policy
                                        </dt>
                                        <dd style="text-indent: 20px;">
                                            {{$vendor->policy->payment_mode}}
                                        </dd>
                                    </dl>
                                    @if($vendor->policy->description)
                                        <div style="padding-top:1px;background:#f1f1f1;" class="mt-2"></div>

                                        <p style="text-indent: 20px;">

                                            {{$vendor->policy->description}}
                                        </p>
                                    @endif

                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div></div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets\public\js\nouislider.js')}}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script>
        AOS.init();
        $('[data-aos]').parent().addClass('hideOverflowOnMobile');
         //single vendor header image
        $('#owl-vendor-header').owlCarousel({
            items:1,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            loop:true,
            autoplay:true,
            nav:true
        });


    </script>
@endsection
