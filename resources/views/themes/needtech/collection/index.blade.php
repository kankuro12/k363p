@extends('themes.needtech.layout')
@section('subtitle',$collection->name)
@section('meta')
    <meta name="theme-color" content="#ED2A24" />
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

                <div >
                    <img src="{{asset('uploads/vendor/collections/'.$collection->image)}}" class="img-fluid">
                </div>


            </div>
            <div class="header-overlay d-none d-md-block">
                <div class="main-desc">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="vendor-name">{{$collection->name}}</div>
                            <div class="vendor-address">

                                {{$collection->description}}
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <div class="header-overlay-mobile mb-2 mb-md-3 py-3 d-block d-md-none p-md-0">
            <div class="container-fluid">
                <div class="name mb-1">
                    {{$collection->name}}
                </div>
                <div class="address mb-1">
                    {{$collection->description}}
                </div>

            </div>
        </div>
        <div class="container d-m pt-0 pt-md-5 ">

            <div class="row">
                @foreach ($collection->collectionvendors as $cvendor)
                    <div class="col-md-4">
                        @include('public.home.featured',['vendor'=>$cvendor->vendor])
                    </div>
                @endforeach
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
