@extends('themes.needtech.layout')
@section('subtitle',$room->name)
@section('meta')
    <meta name="theme-color" content="#c22319" />
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{custom_config('share_title')->value}} - {{$room->name}}, {{$vendor->name}} " />
    <meta property="og:description"   content="{{html_entity_decode(strip_tags($room->description))}}" />
    <meta property="og:image"         content="{{asset($room->roomphotos[0]->image)}}" />
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/singlevendor.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\nouislider.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

@endsection
@section('content')
    <div class="vendor-main">
        <div class="vendor-header">
            <div id="owl-vendor-header" class="owl-carousel">
                @foreach($room->roomphotos as $rp)
                <div >
                    <img src="{{asset($rp->image)}}" class="img-fluid" >
                </div>
            @endforeach

            </div>
            <div class="header-overlay d-none d-md-block">
                <div class="main-desc">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="vendor-name">{{$room->name}}</div>
                            <div class="vendor-address">

                                {{$vendor->name}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="vendor-address text-right">

                                {{$room->bookings()->count()}} Bookings
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="header-overlay-mobile mb-2 mb-md-3 py-3 d-block d-md-none p-md-0">
            <div class="container-fluid">
                <div class="name mb-1">
                    {{$room->name}}
                </div>
                <div class="address mb-1">
                    {{$vendor->name}}
                </div>
                <div class="my-2 pt-1">
                    <span class="rating px-3 py-2 " ]>

                        <span class="point px-1">
                            {{$room->bookings()->count()}} Bookings
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
                                {!!$room->description!!}
                            </div>
                        </div>
                    </div>
                    <div class="section d-block py-3  mb-2 mb-md-3">
                        <div class="container-fluid">

                            <div class="title">
                                Features
                                <div class="bar"></div>
                            </div>
                            <div class="desc">
                                <div class="row">
                                    @foreach($room->roomamenities as $ra)
                                    <div class="col-md-4 mt-2">
                                        <span>{{$ra->amenity}}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 p-mobile-0 ">
                    <div class="section py-3  mb-2 mb-md-3">
                        <div class="container-fluid">

                            <div class="title mb-2">
                                Book Now
                                <div class="bar"></div>
                            </div>
                            <div class="body">

                                <div class="d-flex justify-content-between pricing">
                                    <span class="price-title">
                                        price
                                    </span>
                                    <span>
                                        @if($room->discount!=0)
                                            <span class="new  d-block" >
                                                Nrs. {{$room->getNewPrice()}}
                                            </span>

                                            <span  class="old">
                                                Nrs.  {{$room->price}}
                                            </span>
                                            <span class="discount">
                                                {{$room->discount}}% off
                                            </span>
                                        @else
                                            <span class="new">Nrs.{{$room->price}}</span>
                                        @endif
                                    </span>

                                </div>
                                <div>
                                    <hr>
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
                                    <form action="{{route('n.startbooking')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="isuser" value="{{$isuser?1:0}}">
                                        <input type="hidden" name="room_id" value="{{$room->id}}">

                                        {{-- <div class="form-group">
                                            <label for="name">Start Date</label>
                                            <input class="form-control" type="date" name="start_date" id="start_date" required >
                                        </div> --}}

                                        <div class="form-group">
                                            <button class="btn btn-success">
                                                {{-- {{$isuser?"Book Now":"Signin and Book"}} --}}
                                                Book Now
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">

                        @if(Auth::user())



                            <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}?ref_id={{$user->id}}" target="_blank" class="btn btn-secondary mx-0 mx-md-2 mb-2 text-left" style="background:#0E8CF1;border:none" >
                                <img style="width:25px;" src="{{asset('images/fb_share.svg')}}" alt=""> Share
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{Request::url()}}?ref_id={{$user->id}}" class="btn btn-secondary mx-0 mx-md-2 mb-2 " style="background:#1DA1F2;border:none;color:white;" > <img style="width:25px;" src="{{asset('images/twitter_share.svg')}}" alt=""> Share</a>

                        @else
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank" class="btn btn-secondary mx-1 mb-2 text-left" style="background:#0E8CF1;border:none" >
                            <img style="width:25px;" src="{{asset('images/fb_share.svg')}}" alt=""> Share
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{Request::url()}}" class="btn btn-secondary mx-1 mb-2 " style="background:#1DA1F2;border:none;color:white;" > <img style="width:25px;" src="{{asset('images/twitter_share.svg')}}" alt=""> Share</a>
                        @endif
                    </div>

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
