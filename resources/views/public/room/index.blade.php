@extends('layouts.public.index')
@section('content')
<section class="hotel-banner-section">
    <img src="{{asset('uploads/vendor/cover_img/'.$vendor->cover_img)}}" class="img-fluid" />
    <div class="h-b-detail-wrapper">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-7 pb-4">
                    <div class="h-n-a">
                        <h1 class="mb-3">{{$vendor->name}}</h1>
                        <span class="h-loc"><i class="ion-android-pin mr-2"></i> {{$vendor->location?$vendor->location->name:'N/A'}}</span>
                    </div>
                </div>
                <div class="col-md-3 pb-4">
                    {{-- <div class="h-avg-cost">
                        <span class="avg-cost-txt">Price</span>
                        <div><span class="cost">Rs.{{$vendor->average_cost}}</span><span> {{$vendor->average_cost_type}}</span></div>
                    </div> --}}
                </div>
                <div class="col-md-2 pb-4">
                    <div class="h-rev text-center">
                        <span class="rating-circle mx-auto mb-2"><span>{{$vendor->average_review()['avg_rating']}}</span></span>
                        {{-- <div><a href="#" class="text-white">{{$vendor->reviews()->where('status','approved')->count()}} reviews</a></div> --}}
                        @php
                            $reviewscount=$vendor->reviews()->where('status','approved')->count();
                        @endphp
                        <div><a href="#" class="text-white">{{$reviewscount>0?$reviewscount :" No "}} reviews</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container mb-5">
   <section class="h-details-section mt-4">
       <div class="row">
         <div class="col-md-7">
           
             <div class="room-gallery-carousel owl-carousel" id="gallery">
              @foreach($room->roomphotos as $rp)
                 <div class="gallery-item item">
                     <img src="{{asset('uploads/vendor/roomphotos/'.$rp->image)}}" class="img-fluid">
                 </div>
              @endforeach
             </div>
             <div class="mt-4 room-details">
                 <div class="d-p-heading">
                     <h2>Package Details</h2>
                 </div>
                 <p>{!!$room->description!!}</p>
             </div>
              <div class="mt-3 room_amenities">
                  <div class="d-p-heading">  
                      <h2>Services Included</h2>
                  </div>
                  <div class="row">
                       @foreach($room->roomamenities as $ra)
                       <div class="col-md-4 mt-2">
                           <i class="ion-android-done-all mr-3"></i><span>{{$ra->amenity}}</span> 
                       </div>
                       @endforeach 
                  </div>
              </div>
              <div class="mt-3">
                  <div class="row">
                      @foreach ($room->roomphotos as $photos)
                          <div class="col-md-6 col-lg-4 col-sm-1">
                                <img src="{{asset('')}}" alt="" srcset="">
                          </div>
                      @endforeach
                  </div>
              </div>
         </div>
         <div class="col-md-5 yello-left-border">
             <div class="m-room-detail-wrapper">
                 <h4 class="color1 font-weight-bold mb-3">{{$room->vendor->name}}</h4>
                 <div class="row">
                   <div class="col-md-12">
                      <div class="room-type">
                          <span class="room-type-title">{{$room->name}}</span>
                          <hr>
                          <div class="b-total-price font-weight-bold">
                            <div class="total-price-title">Price</div>
                            <div class="total-price color1" data-org-price="{{$room->discount==0? $room->price:$room->getNewPrice() }}">Rs. <span
                                    class="t-price-amount">{{$room->discount==0? $room->price:$room->getNewPrice() }}</span></div>
                        </div>                 
                      </div>    
                   </div>
                  </div>
                  <form id="checkAvailabitlityForm" method="get" action="{{route('get_booking_process_start',['vslug'=>$vendor->slug,'rslug'=>$room->slug])}}">
                    @csrf
                   {{-- <div class="check-in-out">
                       <div class="row">
                           <div class="col-sm-8">
                               <div class="form-group">
                                   <label>Check-in / Check-out</label>
                                   <input type="text" name="ch-in-out" class="form-control" value="2018-12-01">
                                   <input type="hidden" name="check_in_time" id="ch-in" required="">
                                   <input type="hidden" name="check_out_time" id="ch-out" required="">
                               </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                  <label>Rooms</label>
                                  <select class="form-control" name="num_rooms" id="num_room" onchange="checkAvailability()">
                                      @for($i=1;$i<=$room->vacant_rooms;$i++)
                                      <option value="{{$i}}">{{$i}}</option>
                                      @endfor
                                  </select>
                              </div>                     
                           </div>
                       </div>
                   </div> --}}
                 {{-- <div id="availabitlityBoard" class="content-wrapper"></div> 
                 <div id="checkingRoom"></div> --}}
                 <div class="shadow mt-1 mb-1 p-2">
                     <label >Start From</label>
                     <input type="date" class="form-control" name="check_in_time" required value="{{date("Y-m-d")}}">
                 </div>
                    
                    <input type="submit" value="Start Booking" class="btn btn-success mt-2">
                  </form>
             </div>
         </div>
       </div>
   </section>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
//   $("input[name='ch-in-out']").daterangepicker({
//     locale: {
//       "format": "YYYY/MM/DD",
//       "seperator": "/"
//     },
//     minDate: moment().startOf('hour'),
//     maxDate: moment().startOf('day').add(6, 'month'),
//     startDate: moment().startOf('hour'),
//     endDate: moment().startOf('hour').add(24, 'hour'),
//   });
//   $("document").ready(function(){
//     var ch_in_out = $("input[name='ch-in-out']").val().split("-");
//     $("#ch-in").val(ch_in_out[0].trim(" "));
//     $("#ch-out").val(ch_in_out[1].trim(" "));
//     checkAvailability();
//     $("input[name='ch-in-out']").on("change",function(){
//       ch_in_out = $("input[name='ch-in-out']").val().split("-");
//       $("#ch-in").val(ch_in_out[0].trim(" "));
//       $("#ch-out").val(ch_in_out[1].trim(" "));
//       checkAvailability();
//     });
//   });
//   $(document).on('submit','#booking_process',function(e){
//     e.preventDefault();
//     var data=$(this).serialize();
//     var url=$(this).attr('action');
//       $.ajax({
//            url: url,
//            data: data,
//            type:'GET',
//            success: function(response) {
//              location.href = response.url;            
//            }            
//        });
//   });
//   // checkAvailability();
//   function checkAvailability(){
//     var num_rooms=$("#num_room").val();
//     var url="{{route('public.checkAvailabitlity',['vslug'=>$vendor->slug,'rslug'=>$room->slug])}}";
//     var check_in_time=$("#ch-in").val();
//     var check_out_time=$("#ch-out").val();
    
//     $.ajax({
//        url: url,
//        data: {'num_rooms':num_rooms,'check_in_time':check_in_time,'check_out_time':check_out_time},
//        type:'POST',
//        beforeSend:function(){
//          $(".content-wrapper").css("position","relative")
//          $(".content-wrapper").addClass('loading');    
//         },
//        success: function(response) {
//          $("#availabitlityBoard").html(response);
//          $(".content-wrapper").removeClass('loading'); 
        
//        }            
//     });        
//   }

$("document").ready(function(){
        $("#gallery").owlCarousel({ // Initialize slider
			items:1,
			slideBy:1,
			nav:true,
			loop:true,
			dots:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:true
                },
                1000:{
                    items:2,
                    nav:true,
                    loop:false
                },
                1600:{
                    items:3,
                    nav:true,
                    loop:false
                }
            }
		});
});


</script>
@endsection