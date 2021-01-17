@extends('layouts.public.index1')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/singlevendor.css')}}">
@endsection
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
        <div class="header-overlay">
            <div class="main-desc">
                <div class="row">
                    <div class="col-md-6">
                        <div class="vendor-name">{{$vendor->name}}</div>
                        <div class="vendor-address">
                            <i class="fas fa-map-marker-alt"></i>
                            {{$vendor->location?$vendor->location->name:'N/A'}}
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">

                {{-- @if($vendor->amenities->count()>0)
                    <section class="section">
                        <div class="body">
                                <div style="height:1px;padding:1px 0px;background:#ee2e2466;margin:10px 0px 5px 0px;" ></div>
                                <div class="row">
                                    @for ($i = 0; $i < 12; $i++)
                                         @foreach($vendor->amenities as $fam)
                                            <div class="col-md-4 col-sm-6 col-lg-4 pb-2">
                                                <div class="d-inline-block mb-1 mr-2  pr-2 pl-2 pt-1 pb-1">
                                                    <img src="{{asset('uploads/vendor/amenities/icons/200x200/'.$fam->icon)}}" class="mr-1" width="20px" height="20px" />
                                                    <span class="am-title color1">{{$fam->name}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endfor
                                </div>
                        </div>
                    </section>
                @endif --}}

                <!-- service section -->

                @foreach ($vendor->roomTypeRooms() as $name=>$section)

                    <section class="section">
                        <div class="title">
                            <h2>
                                <span>
                                    {{$name}}
                                </span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                {{-- @php
                                    dd($section);
                                @endphp --}}
                                @foreach ($section['data'] as $service)
                                    @include('public.singlevendor.service',['service'=>$service])
                                @endforeach


                            </div>
                        </div>
                    </section>
                @endforeach
                <!-- end services section -->



            </div>
            <div class="col-lg-4">
                <!-- about section -->
                <section class="section" id="about ">
                    <div class="title mb-2">
                        <h2>
                            <span>
                                About Us
                            </span>
                        </h2>
                    </div>
                    <div class="body pb-4" style="word-wrap: break-word;">
                        <p>
                            {!!$vendor->description!!}
                        </p>

                        @if($vendor->amenities->count()>0)
                            <div style="height:1px;padding:1px 0px;background:#ee2e2466;margin:10px 0px 5px 0px;" ></div>
                                <div class="">
                                    {{-- @for ($i = 0; $i < 12; $i++) --}}
                                        @foreach($vendor->amenities as $fam)
                                            <span class="d-inline-block mb-1 mr-2  pr-2 pl-2 pt-1 pb-1" style="border-radius:5px;background:#f1f1f1;">
                                                <img src="{{asset('uploads/vendor/amenities/icons/200x200/'.$fam->icon)}}" class="mr-1" width="20px" height="20px" />
                                                <span class="am-title">{{$fam->name}}</span>
                                            </span>
                                        @endforeach
                                    {{-- @endfor --}}
                                </div>

                        @endif
                    </div>

                </section>
                <!-- end about section -->
                 <!-- contact us section -->
                 <section class="section" id="contact">
                    <div class="title">
                        <h2>
                            <span>
                                Contact Us
                            </span>
                        </h2>
                    </div>
                    <div class="body contact pb-4">
                        @if($vendor->phone_number)
                        <div class="mb-1 font-weight-bold d-flex align-items-center">
                            <span class="icon-circle mr-2"><i class="fas fa-phone-alt"></i></span><span  class="d-inline-block"><a href="tel:{{$vendor->phone_number}}" class="color1">{{$vendor->phone_number}}</a>@if($vendor->secondary_phone_number),<a href="tel:{{$vendor->secondary_phone_number}}" class="color1"> {{$vendor->secondary_phone_number}}</a>@endif</span>
                        </div>
                        @endif
                        <div class="mb-1 font-weight-bold d-flex align-items-center">
                            <span class="icon-circle mr-2"><i class="fas fa-envelope"></i></span><span  class="d-inline-block"><a href="mailto:{{$vendor->user->email}}" class="color1">{{$vendor->user->email}}</a></span>
                        </div>
                        @if($vendor->website)
                            <div class="mb-1 font-weight-bold d-flex align-items-center">
                                <span class="icon-circle mr-2">
                                    <i class="fab fa-internet-explorer"></i>
                                </span>
                                <span  class="d-inline-block">
                                    <a href="{{$vendor->website}}" class="color1">{{$vendor->website}}</a>
                                </span>
                            </div>
                        @endif
                        <div style="height:1px;padding:1px 0px;background:#ee2e2466;margin:10px 0px 5px 0px;" >

                        </div>
                        <div class="socials ">
                            @if($vendor->facebook_url)
                                <span class="d-inline-block">
                                    <i class="fab fa-facebook href p-1 color1" data-target="{{$vendor->facebook_url}}"></i>
                                </span>
                            @endif
                            @if($vendor->twitter_url)
                                <span class="d-inline-block">
                                    <i class="fab fa-twitter href p-1 color1" data-target="{{$vendor->twitter_url}}"></i>
                                </span>
                            @endif
                            @if($vendor->instagram_url)
                                <span class="d-inline-block">
                                    <i class="fab fa-instagram href p-1 color1" data-target="{{$vendor->instagram_url}}"></i>
                                </span>
                            @endif

                        </div>





                    </div>
                </section>
                <!-- end about section -->

            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
    <script>
        $('.image-holder').each(function(){
            $(this).owlCarousel({
                items:1,
                loop:true,
                autoHeight:true,
                responsiveClass:true,
                nav:false,
                margin:2
            });
        });
    </script>
@endsection
