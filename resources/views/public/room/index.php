<div class="row">
  <div class="col-md-7">
      <div class="room-gallery-carousel">
          <div class="gallery-item">
              <img src="{{asset('uploads/vendor/roomphotos/'.$room->roomphotos[0]->image)}}" class="img-fluid">
          </div>
      </div>
      <div class="mt-4 room-details">
          <div class="d-p-heading">
              <h2>Room Details</h2>
          </div>
          <p>{{$room->description}}</p>
      </div>
       <div class="mt-3 room_amenities">
           <div class="d-p-heading">  
               <h2>Room Amenities</h2>
           </div>
           <div class="row">
                @foreach($room->roomamenities as $ra)
                <div class="col-md-4 mt-2">
                    <i class="ion-android-done-all mr-3"></i><span>{{$ra->amenity}}</span> 
                </div>
                @endforeach 
           </div>
       </div>
  </div>
  <div class="col-md-5">
      <div class="m-room-detail-wrapper">
          <h3 class="color1 font-weight-bold mb-3">{{$room->vendor->name}}</h3>
          <div class="room-type">
              <span class="room-type-title">{{$room->name}}</span>
          </div> 
          <form action="{{route('get_booking_process_start',['hotel_slug'=>$room->vendor->slug,'room_id'=>$room->id])}}" method="get">
          <input type="hidden" name="room_id" value="{{$room->id}}">
          <input type="hidden" name="check_in" value="2019-01-20">
          <input type="hidden" name="check_out" value="2019-01-25">
            <div class="check-in-out">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Check-in / Check-out</label>
                            <input type="text" class="form-control" value="2018-12-01">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Rooms</label>

                            <select class="form-control" id="num-room" name="num_rooms">
                              @for($i=1;$i<=$room->no_of_rooms;$i++)
                              <option value="{{$i}}">{{$i}}</option>
                              @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="acb-main-wrapper">
                <div class="acb-wrapper">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Adults</label>
                                <select class="form-control a-select" name="adult_bed[]">                                
                                  @for($i=1;$i<=$room->get_adult_beds()['adult_bed'];$i++)
                                  <option value="{{$i}}">{{$i}}</option>
                                  @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Child</label>
                                <select class="form-control c-select" name="child_bed">
                                  @if($room->get_adult_beds()['child_bed']>0)
                                    @for($i=1;$i<=$room->get_adult_beds()['child_bed'];$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                  @else
                                  <option value="0">0</option>
                                  @endif
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-sm-4">
                            <div class="form-group">
                                <label>Bed</label>
                                <select class="form-control b-select" name="bed[]">
                                  @foreach($room->beds as $bed)
                                  <option value="{{$bed->id}}">{{$bed->bed_number}} {{$bed->bed_type->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="r-g-total">
                <div id="r-g-num"><span id="g-num">1 guest</span>, <span id="r-num">1 room</span></div>
                <div class="r-g-final-price" id="r-g-final-price">Rs. <span data-price="{{$room->getNewPrice()}}">{{$room->getNewPrice()}}</span></div>
            </div>
            <div class="mt-3">
                <button class="btn btn1 btn-block btn-lg" type="submit">Continue Booking
                  <i class="ion-chevron-right float-right"></i>      
                </button>
            </div>
          </form>
      </div>
  </div>
</div>
<script type="text/javascript">
  $(document).on('submit','#booking_process',function(e){
    e.preventDefault();
    var data=$(this).serialize();
    var url=$(this).attr('action');
      $.ajax({
           url: url,
           data: data,
           type:'GET',
           success: function(response) {
             location.href = response.url;            
           }            
       });
  });
  $(document).ready(function(){
  //daterangepicker
  $("input[name='ch-in-out']").daterangepicker();

  //add room
    $("#num-room").on('change',function(){

      var num_room_old = $(".acb-main-wrapper .acb-wrapper").length;
      var num_room_new = $(this).val();
      var rprice=parseFloat($("#r-g-final-price span").attr("data-price"));
      $("#r-g-final-price span").text(num_room_new*rprice);
       
      //checking to add or delete room
      if(num_room_new>num_room_old){
        for(i=0;i<num_room_new-num_room_old;i++){
        
          $(".acb-main-wrapper").append(
          '<div class="acb-wrapper">'+
          '                              <div class="row">'+
          '                                  <div class="col-sm-6">'+
          '                                      <div class="form-group">'+
          '                                          <label>Adults</label>'+
          '                                          <select class="form-control a-select" name="adult_bed[]">'+
                                                   @for($i=1;$i<=$room->get_adult_beds()['adult_bed'];$i++)
                                                   '<option value="{{$i}}">{{$i}}</option>'+
                                                   @endfor
          '                                          </select>'+
          '                                      </div>'+
          '                                  </div>'+
          '                                  <div class="col-sm-6">'+
          '                                      <div class="form-group">'+
          '                                          <label>Child</label>'+
          '                                          <select class="form-control c-select" name="child_bed[]">'+
                                                  @if($room->get_adult_beds()['child_bed']>0)
                                                    @for($i=1;$i<=$room->get_adult_beds()['child_bed'];$i++)
                                                    '<option value="{{$i}}">{{$i}}</option>'+
                                                    @endfor
                                                  @else
                                                  '<option value="0">0</option>'+
                                                  @endif
                                                   
          '                                          </select>'+
          '                                      </div>'+
          '                                  </div>'+
          // '                                  <div class="col-sm-4">'+
          // '                                      <div class="form-group">'+
          // '                                          <label>Bed</label>'+
          // '                                          <select class="form-control b-select" name="bed[]">'+
          //                                         @foreach($room->beds as $bed)
          //                                         '<option value="{{$bed->id}}">{{$bed->bed_number}} {{$bed->bed_type->name}}</option>'+
          //                                         @endforeach
          // '                                          </select>'+
          // '                                      </div>'+
          // '                                  </div>'+
          '                              </div>'+
          '                          </div>');
        }
      }
      if(num_room_new<num_room_old){
        for(j=0;j<num_room_old-num_room_new;j++){
          $(".acb-main-wrapper .acb-wrapper").last().remove();
        }
      }
      var n_adult = 0;
      var n_child = 0;
      function room_guest_val(){
        n_adult = 0;
        n_child = 0; 
        $(".a-select").each(function(){
            n_adult += parseInt($(this).val());  
        });
        $(".c-select").each(function(){
            n_child += parseInt($(this).val());
        });
      }
      room_guest_val();
      update_room_guest(num_room_new,n_adult,n_child);
      $(".a-select,.c-select").on('change',function(){
          room_guest_val();
          update_room_guest(num_room_new,n_adult,n_child);  
      });
    }); 
});
//function to update no. of rooms and guests
function update_room_guest(n_room,n_adult,n_child){
  
  var rooms = "room";
  var guests = "guest";

  if(n_room>1){
    rooms = "rooms";
  }
  if((n_adult+n_child)>1){
    guests = "guests";
  }
  $("#r-g-num #g-num").text(n_adult+n_child+" "+guests);
  $("#r-g-num #r-num").text(n_room+" "+rooms);

}



</script>