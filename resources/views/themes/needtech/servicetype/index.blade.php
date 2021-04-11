@extends('themes.needtech.layout')
@section('subtitle',"Service - ".$roomtype->name)
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/singlevendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/singleservices.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\nouislider.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        body{
            background:white !important;
        }
        .coll-header{
            top:35% !important;
            bottom:auto !important;


        }
        .shadowonhover{
            box-shadow:0px 0px 10px 0px black;
            border-radius: 5px;
        }

        .owl-feature-vendor{
        }


    </style>
@endsection
@section('content')
    <div class="vendor-main">
        <div class="vendor-header">
            <div id="owl-vendor-header p-5 text-center" style="background:#c22319;">
                <div style="text-align:Center;padding:30px 20px;color:white;">
                    <img src="{{asset('uploads/vendor/room_type/icons/'.$roomtype->icon)}}" alt="" style="width:100px;border-radius:10px;">
                    <h2 class="vendor-name">{{$roomtype->name}}</h2>
                </div>
            </div>
            {{-- <div class="header-overlay d-none d-md-block">
                <div class="main-desc coll-header text-center">

                            <div class="vendor-name">{{$roomtype->name}}</div>
                            <div class="vendor-address">

                                {{$roomtype->description}}
                            </div>
                        </div>
            </div> --}}
        </div>

        <div class="container d-m pt-3 pt-md-5 ">
            <div class="row">
                @foreach ($roomtype->rooms as $room)
                    <div class="col-md-6 col-lg-3 pb-5 col-12 col-sm-6 ">
                        <div class="shadowonhover">
                            @include('themes.needtech.servicetype.single',['service'=>$room])
                        </div>
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
