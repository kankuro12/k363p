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
</div>


@endsection