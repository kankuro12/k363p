@extends('layouts.public.index1')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/singlevendor.css')}}">
<style>
    
    span.new{
        font-size:1.8rem;
        color:#ffffff;
        font-weight:700;
       
    }
    span.old{
        text-decoration:line-through;
                    font-weight:500;
                    color:rgb(206, 206, 206);
                    font-size:15px;
                    margin:0px 1px;
    }
    span.discount{
        font-size:15px;
                    color:#bea721;
                    font-weight:700;
    }

    .space-top{
        padding-top:3rem;
        padding-bottom:3rem;
    }

    .price{
        font-size:1.2rem;
        font-weight: 700;
    }
    @media (max-width: 768px) {
        span.new{
            font-size:1.3rem;
        }
        .space-top{
            padding-top:0.2rem;
            padding-bottom:1.2rem;
        }
        .section{
            margin-bottom:0rem;
        }

    }
    @media (max-width: 576px){
        .section{
            margin-bottom:0rem !important; 
        }
    }
</style>
@endsection
@section('content')
<div class="vendor-main">
    <div class="vendor-header">
        <div id="owl-vendor-header" class="owl-carousel">
            @foreach($room->roomphotos as $rp)
                <div >
                    <img src="{{asset('uploads/vendor/roomphotos/'.$rp->image)}}" class="img-fluid">
                </div>
            @endforeach
            
        </div>
        <div class="header-overlay">
            <div class="main-desc">
                <div class="row">
                    <div class="col-md-6">
                        <div class="vendor-name">
                            {{$room->roomtype->name}}
                            -
                            {{$room->name}}</div>
                      
                        <div class="vendor-address">
                            {{-- <i class="fas fa-building"></i> --}}
                            {{$vendor->name}} 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rating">
                            <span class="text-center d-inline-block">
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
                    </div>
                    
                </div>
              
            </div>
        </div>

    </div>
    <div class="container space-top">
        
        <div class="row">
            <div class="col-md-7 col-lg-8 order-1 order-md-0">
                <section class="section pb-3">
                    <div class="title">
                        <h2><span>
                            About Package
                        </span></h2>
                    </div>
                    <div class="body">
                        <p>

                            {!! $room->description !!}
                        </p>
                        @if ($room->roomamenities->count()>0)
                        <div style="height:1px;padding:1px 0px;background:#ee2e2466;margin:10px 0px 10px 0px;" ></div>
                            @foreach ($room->roomamenities as $am) 	
                                        <span class="d-inline-block mb-1 mr-2  pr-2 pl-2 pt-1 pb-1" style="border-radius:5px;background:#f1f1f1;">
                                            <span class="am-title">{{$am->amenity}}</span>
                                        </span>
                            
                            @endforeach
                        @endif
                    </div>
                </section>
            </div>
            <div class="col-md-5 col-lg-4 order-0 order-md-1">
                <section class="section pb-3">
                    <form id="checkAvailabitlityForm" method="get" action="{{route('get_booking_process_start',['vslug'=>$vendor->slug,'rslug'=>$room->slug])}}">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <span class="color1 price" >
                                Price
                            </span>
                            <span class="color1 price">
                                Nrs. {{$room->getNewPrice()}} 
                            </span>
                        </div>
                        <hr style="margin:0.5rem 0rem;">
                        <div class="">
                            <label class="price" >Start From</label>
                            <input type="date" class="form-control" name="check_in_time" required value="{{date("Y-m-d")}}">
                        </div>
                        <input type="submit" value="Start Booking" class="btn btn-success mt-2">
                      </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection