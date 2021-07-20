@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#D4184C" />
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{custom_config('share_title')->value}}" />
    <meta property="og:description"   content="{{custom_config('share_description')->value}}" />
    <meta property="og:image"         content="{{asset(custom_config('share_image')->value)}}" />
@endsection
@section('content')
    {{-- <div class="city d-block d-md-none pl-4 pt-2 pb-2 pr-3">
    <div class="d-flex" style="justify-content: space-between">
        <span class="badge">
            Biratnagar
        </span>
        <span class="href badge" data-target="/all-cities">
            all cities
        </span>
    </div>
</div> --}}
    @php
    $cities = \App\Model\Vendor\City::all();
    $othercities = $cities->slice(1);
    @endphp
    @if ($cities->count()>0)

    <div class="city d-none d-md-block">
        <div class="container">
            <div class="d-block d-md-flex justify-content-between">
                <span class="h-100 city-left d-block d-md-inline">
                    <div class="dropdown">
                        <span class="dropdown-title">
                            <span class="href" data-target="{{ route('n.search') }}?location={{ $cities->first()->name }}">
                                {{ $cities->first()->name }}
                            </span>
                            <span class="icon">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </span>
                        <div class="dropdown-content">
                            @foreach ($othercities as $city)
                                <div class="href text-right pr-5"
                                    data-target="{{ route('n.search') }}?location={{ $city->name }}">
                                    {{ $city->name }}
                                </div>
                            @endforeach

                        </div>
                    </div>
                </span>
                <span class="h-100 city-right href d-none d-md-inline" data-target="/all-cities">All Cities</span>
            </div>
        </div>
    </div>
    @endif

    @include('public.home.search')


    <div class="features d-none d-xl-block">
        <div class="container">
            <div class="feature-holder">


                <div class="feature-items">
                    @foreach ($roomtypes as $roomtype)
                    <span class="feature-item href" data-target="{{route('n.servicetype',['slug'=>$roomtype->slug])}}">
                        <div class="icon">
                            <div class="thumbnail">

                                <img   src="{{asset($roomtype->icon)}}" alt="">
                            </div>
                        </div>
                        <div class="text">

                            {{$roomtype->name}}
                        </div>
                    </span>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <div class="main ">

        <div class="mt-3 mb-3">
            <div >
                @foreach (\App\Banner::where('position',0)->get() as $banner)

                    <picture class="w-100 href" data-target="{{$banner->link}}" class="mt-2">
                        <source media="(max-width:650px)" srcset="{{asset($banner->mobile_image)}}" class="w-100">

                        <img src="{{asset($banner->image)}}" alt="Flowers" class="w-100">
                    </picture>
                @endforeach
            </div>
        </div>
        <br>


        <div class="feature-vendors">
            <div class="f-header">
                <h1>
                    <span>
                        Featured Vendors
                    </span>
                </h1>
            </div>
            <div class="p-0">
                <div id="owl-feature-vendors" class="owl-carousel">

                    @foreach ($featured_vendors as $vendor)
                        @include('public.home.featured',['vendor'=>$vendor])
                    @endforeach
                </div>
            </div>
        </div>

        {{-- <div class="data-services">
            <div class="title">
                <h1>
                    <span>
                        Services
                    </span>
                </h1>
            </div>
            <div class="p-0">
                <div id="owl-services" class="owl-carousel">
                    @foreach ($roomtypes as $roomtype)
                        @include('themes.needtech.home.service',['service'=>$roomtype])
                    @endforeach
                </div>
            </div>
        </div> --}}

        <div class="collections">
            <div class="title">
                <h1>

                    <span>
                        Our Collections
                    </span>
                </h1>
            </div>
            <div class="p-0">
                <div id="owl-collections" class="owl-carousel">
                    @foreach ($collections as $collection)
                        @include('themes.needtech.home.collection',['collection'=>$collection])
                    @endforeach

                </div>
            </div>
        </div>
        <div class="mt-4 "
            style="border-radius:10px;overflow:hidden;cursor: pointer;">
            @foreach (\App\Banner::where('position',1)->get() as $banner)
                <picture class="w-100 href" data-target="{{$banner->link}}" class="mt-2">
                    <source media="(max-width:650px)" srcset="{{asset($banner->mobile_image)}}" class="w-100">
                    <img src="{{asset($banner->image)}}" alt="Flowers" class="w-100">
                </picture>
            @endforeach
        </div>
        <div class="feature-services">
            <div class="fs-header">
                <h1>
                    <span>
                        Trending Services
                    </span>
                </h1>
            </div>
            <div class="p-0">
                <div id="owl-feature-services" class="owl-carousel">
                    @foreach ($trs as $service)
                        @include('public.home.service',['service'=>$service])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
