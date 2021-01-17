@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#D4184C" />
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
<div class="city d-none d-md-block">
    <div class="container">
        <div class="d-block d-md-flex justify-content-between">
            <span class="h-100 city-left d-block d-md-inline">
                <div class="dropdown">
                    <span class="dropdown-title">
                        <span>
                            Biratnagar
                        </span>
                        <span class="icon">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </span>
                    <div class="dropdown-content">
                        <div>
                            Kakadvitta
                        </div>
                        <div>
                            Belbari
                        </div>
                        <div>
                            Biratchowk
                        </div>
                    </div>
                </div>
            </span>
            <span class="h-100 city-right href d-none d-md-inline" data-target="/all-cities">All Cities</span>
        </div>
    </div>
</div>

@include('public.home.search')


<div class="features d-none d-xl-block">
    <div class="container">
        <div class="feature-holder">

            <div class="feature-head">

                <span class="feature-title">ABTEST</span>
                <span class="feature-subtitle">Feature</span>
                <span class="feature-desc">somthing to write</span>
            </div>
            <div class="feature-items">
                    <span class="feature-item">
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div>

                            adsfasd
                        </div>
                    </span>
                    <span class="feature-item" >
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div>

                            adsfasd
                        </div>
                    </span>
                    <span class="feature-item">
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div>

                            adsfasd
                        </div>
                    </span>
            </div>
        </div>
    </div>
</div>


<div class="main ">

    <div class="mt-3 mb-3">
        <div  style="height:75px;background:red;color:white;font-weight:600;text-align:center;">
            <h2>
                Here will ne banner
            </h2>
        </div>
    </div>
    <br>


    <div class="feature-vendors">
        <div class="f-header" >
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

    <div class="data-services">
        <div class="title" >
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
    </div>

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
    <div class="feature-services">
        <div class="fs-header" >
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
