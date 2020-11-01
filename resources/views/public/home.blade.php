@extends('layouts.public.index')
@section('content')
<section class="hero-section">
   <div class="hero-search-caption">
     <div class="container">
      <h1 class="text-center">Search Services Near You At Cheap Rates</h1>
       <form action="{{route('public.get_search')}}">
           <div class="hero-search">
               <span class="search-location">
                 <input type="text" name="location" class="form-control" placeholder="Enter a Location" required>
                </span>

               {{-- <span class="check-in-out">
                   <input type="text" name="check-in-out" class="form-control" placeholder="Check-in / Check-out" id="search_drp" autocomplete="off">
                   <input type="hidden" name="check_in_time" id="ch-in">
                   <input type="hidden" name="check_out_time" id="ch-out">

               </span> --}}
               <span class="services">
                       <input type="text" name="service" class="form-control" placeholder="Enter a Service" autocomplete="off"  >
                
                   {{-- <input type="hidden" name="num_guest" id="num-guest-val" value="1">
                   <input type="hidden" name="num_rooms" id="num-room-val" value="1">
                   <div class="add_g_r_block hidden">
                       <div class="g_r_block_title">Guests</div>
                       <div class="add_sub_btns" data-val="1" data-type="Guest(s)">
                           <button class="sub_btn" data-id="guest-val" type="button">-</button>
                           <span id="guest-val">1</span>
                           <button class="add_btn" data-id="guest-val" type="button">+</button>
                       </div>
                       <div class="g_r_block_title">Rooms</div>
                       <div class="add_sub_btns" data-val="1" data-type="Room(s)">
                           <button class="sub_btn" data-id="room-val" type="button">-</button>
                           <span data-val="1" id="room-val">1</span>
                           <button class="add_btn" data-id="room-val" type="button">+</button>
                       </div>
                   </div> --}}
               </span>
               <span><button class="btn btn-block" type="submit">Search</button></span>
           </div>
       </form>
     </div>
   </div>
</section>

<section class="featured-hotel-section">
  <div class="container">
    <div class="section-header">
      <h2>Service Providers </h2>
    </div>  
    <div class="featured-hotel-carousel owl-carousel">
     @foreach(\App\Model\Vendor\Vendor::inRandomOrder()->take(8)->get() as $fv)
     <div class="featured-item">
       <div class="featured-item-img-wrapper">
         <img src="{{asset('uploads/vendor/logo/263x160/'.$fv->logo)}}" class="img-fluid">
         <div class="avg-cost">
           Avg. cost: Rs.{{$fv->average_cost}} / day
         </div>
         @if($fv->average_review()['avg_rating']>0.0)
         <div class="circle-rating">
             {{$fv->average_review()['avg_rating']}}
         </div>
         @endif
       </div>  
       <div class="featured-item-detail-wrapper">
         <h3>{{str_limit($fv->name,20,'...')}}</h3>
         <div class="featured-item-loc mb-1">
           <i class="ion-android-pin"></i>
           <span> {{$fv->location?str_limit($fv->location->name,25,'...'):'N/A'}}</span>
         </div>
         

         
         <div class="featured-amenities mb-2">
           @foreach($fv->amenities->take(5) as $fam)
           <span class="fai mr-2"><img src="{{asset('uploads/vendor/amenities/icons/200x200/'.$fam->icon)}}" height="20px" width="20px" /></span>
           @endforeach
         </div>
         <a href="{{route('public.single_vendor',['slug'=>$fv->slug])}}" class="btn btn-success btn-block">View Detail</a>
       </div>       
     </div> 
     @endforeach      

    </div>
  </div>
</section>

@if($featured_vendors->count()>0)
<section class="featured-hotel-section">
   <div class="container">
     <div class="section-header">
       <h2>Featured Businesses </h2>
     </div>  
     <div class="featured-hotel-carousel owl-carousel">
      @foreach($featured_vendors as $fv)
      <div class="featured-item">
        <div class="featured-item-img-wrapper">
          <img src="{{asset('uploads/vendor/logo/263x160/'.$fv->logo)}}" class="img-fluid">
          <div class="avg-cost">
            Avg. cost: Rs.{{$fv->average_cost}} / day
          </div>
          @if($fv->average_review()['avg_rating']>0.0)
          <div class="circle-rating">
              {{$fv->average_review()['avg_rating']}}
          </div>
          @endif
        </div>  
        <div class="featured-item-detail-wrapper">
          <h3>{{str_limit($fv->name,20,'...')}}</h3>
          <div class="featured-item-loc mb-1">
            <i class="ion-android-pin"></i>
            <span> {{$fv->location?str_limit($fv->location->name,25,'...'):'N/A'}}</span>
          </div>
          

          
          <div class="featured-amenities mb-2">
            @foreach($fv->amenities->take(5) as $fam)
            <span class="fai mr-2"><img src="{{asset('uploads/vendor/amenities/icons/200x200/'.$fam->icon)}}" height="20px" width="20px" /></span>
            @endforeach
          </div>
          <a href="{{route('public.single_vendor',['slug'=>$fv->slug])}}" class="btn btn-success btn-block">View Detail</a>
        </div>       
      </div> 
      @endforeach      

     </div>
   </div>
</section>
@endif
<div class="container py-4">
  <img src="{{asset('assets/public/img/ad.png')}}" class="img-fluid">
</div>
@if($popular_vendors->count()>0)
<section class="p-r-n-section pt-4 pb-5">
  <div class="container">
    <div class="section-header">
     <h2>Popular Right Now</h2>
    </div>  
    <div class="p-r-n-carousel owl-carousel">
      @foreach($popular_vendors as $pv)
      <a href="{{route('public.single_vendor',['v'=>$pv->slug])}}">
        <div class="p-r-n-item">
          <div class="p-r-n-img-wrapper">
            <img src="{{asset('uploads/vendor/cover_img/'.$pv->cover_img)}}" class="img-fluid" alt="{{$pv->name}}">
            @if($pv->average_review()['avg_rating']>0.0)
            <div class="circle-rating">
                {{$pv->average_review()['avg_rating']}}
            </div>
            @endif
            <div class="p-r-n-detail-wrapper">
              <h3>{{$pv->name}}</h3>
              <div class="p-r-n-item-loc mb-1">
                <i class="ion-android-pin"></i>
                <span> {{$pv->location->name}}</span>
              </div>
              <div class="avg-cost">
                Avg. cost: Rs.{{$pv->average_cost}} / day
              </div>
              
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif
<section class="vendor-signup-section">
   <div class="container">
     <div class="col-md-8 mx-auto">
       <h3>Are you Business Owner?</h3>
       <h3>Signup Now To List Your Services.</h3>
       <a href="{{route('vendor.getRegister')}}" class="btn btn-lg btn-white mt-4">Signup as Service Provider</a>
     </div>
   </div>
</section>
@if($collections->count()>0)
<section class="p-r-n-section pt-4 pb-5">
    <div class="container">
        <div class="section-header">
            <h2>Popular Collections</h2>
        </div>  
        <div class="owl-carousel collection-carousel">
          @foreach($collections as $collection)
            <div class="p-r-n-item">
                <a href="{{route('public.get_search',['collection'=>$collection->slug])}}">
                    <div class="p-r-n-img-wrapper">
                        <img src="{{asset('uploads/vendor/collections/263x160/'.$collection->image)}}" class="img-fluid" >
                        <div class="p-r-n-detail-wrapper">
                            <h3>{{$collection->name}}</h3>
                            <div class="avg-cost">
                                {{$collection->description}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@if($trs->count()>0) 
<section class="p-t-v-section py-5">
  <div class="container">
    <div class="section-header">
     <h2>Places To Visit</h2>
    </div>  
    <div class="p-t-v-carousel owl-carousel">
      @foreach($trs as $tr)
      <a href="{{route('public.get_tourism_area',['slug'=>$tr->slug])}}">
        <div class="p-t-v-item">
          <div class="p-t-v-img-wrapper">
            <img src="{{asset('uploads/tourismareas/'.$tr->featured_image)}}" class="img-fluid" alt="{{$tr->name}}" >
            <div class="p-t-v-detail-wrapper">
              <h3>{{$tr->name}}</h3>
              <div class="p-t-v-item-loc mb-1">
                <i class="ion-android-pin"></i>
                <span> {{$tr->location}}</span>
              </div>
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection