@extends('layouts.vendor.index')
@section('content')
<div class="row">
  <div class="col-md-12 mx-auto">
    <form method="post" action="{{route('vendor.post_update_booking',['id'=>$booking->id])}}">
      @csrf
      <div class="card">
        <div class="card-header"><h5>Booking Details</h5></div>
        <div class="card-body">
          @include('layouts.vendor.snippets.error')
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>User name</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->first_name." ".$booking->last_name}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Email Address</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->email}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Phone number</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->phone_number}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Check in time</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->check_in_time}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Check Out Time</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->check_out_time}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Room</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->room->name}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Adult</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->adult}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Children</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->children}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" readonly="" value="{{$booking->new_price}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Payment Status</label>
                <select class="form-control" name="payment_status">
                  <option value="paid" {{$booking->payment_status=='paid'?'selected':''}}>Paid</option>
                  <option value="unpaid" {{$booking->payment_status=='unpaid'?'selected':''}}>Unpaid</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Booking Status</label>
                <select class="form-control" name="booking_status">
                  <option value="confirmed" {{$booking->booking_status=='confirmed'?'selected':''}}>Confirmed</option>
                  <option value="completed" {{$booking->booking_status=='completed'?'selected':''}}>Completed</option>
                  <option value="rejected" {{$booking->booking_status=='rejected'?'selected':''}}>Rejected</option>
                  <option value="pending" {{$booking->booking_status=='pending'?'selected':''}}>Pending</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>No Of Rooms</label>
                <input type="text" class="form-control" placeholder="No Of Rooms" value="{{$booking->num_rooms}}">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          Total Room Cost(in Nrs.):{{$booking->new_price}}
        </div>
      </div>
      @php
      $meal_price=0;
      @endphp
      @if($booking->meals->count()>0)
      <div class="card">
        <div class="card-header">Meal Details</div>
        <div class="card-body">
          @foreach($booking->meals as $meal)
          @php
          $meal_price+=$meal->meal->price*$meal->meal_value;
          @endphp
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Meal</label>
                <input type="text" class="form-control" value="{{$meal->meal->name}}" readonly="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Quantity</label>
                <input type="text" class="form-control" value="{{$meal->meal_value}}" readonly="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" value="{{$meal->meal_price}}" readonly="">
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="card-footer">
          Total Meal Cost(in NRs.):{{$meal_price}}
        </div>
      </div>
      @endif
      <div class="card">
        <div class="card-header">Room Details</div>
        <div class="card-body">
            <div class="col-md-4 booking">
              @if($booking->crooms->count()==0)
                @for($i=0;$i<$booking->num_rooms;$i++)
                <select class="form-control" name="croom_id[]" style="margin-top:5px;">
                  <label>Room Id</label>
                  <option value="">Select Room</option>
                  @foreach($bcrooms as $croom)
                  <option value="{{$croom->id}}">{{$croom->room_number}}</option>
                  @endforeach
                </select>              
                @endfor
                @else
                @foreach($booking->crooms as $bc)
                <div style="padding: 5px;">
                  Room id:{{$bc->childroom->room_number}} 
                </div>
                @endforeach
                @endif
            </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4>Total Cost(in NRs.):{{$booking->new_price+$meal_price}}</h4>
        </div>
        <div class="card-body">
          @if($booking->booking_status!='rejected' && $booking->booking_status!='completed')
            @if($booking->crooms->count()==0)
            <button type="submit" class="btn btn-success">Assign Room</button>
            @endif
            @if($booking->booking_status!='confirmed')
            <a href="{{route('vendor.confirm_booking',['id'=>$booking->id])}}" class="btn btn-success">Confirm Booking</a>
            @endif
            @if($booking->payment_status!='paid')
            <a href="{{route('vendor.complete_payment',['id'=>$booking->id])}}" class="btn btn-warning">Make Payment Paid</a>
            @endif
            <a href="{{route('vendor.reject_booking',['id'=>$booking->id])}}" class="btn btn-danger">Cancel Booking</a>
            @if($booking->booking_status=='confirmed')
            <a href="{{route('vendor.complete_booking',['id'=>$booking->id])}}" class="btn btn-info">Make Booking Completed</a>
            @endif
          @else
          <p class="text-danger"><b>Booking is {{$booking->booking_status}}</b></p>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(function(){
      $('select').change(function(){
          if($(this).attr('id') == 'box_g1' && $(this).val() == 'Default'){
              $('.booking select').not(this).prop('readonly', true).val('readonly');
          } else {
              $('.booking select').not(this).removeProp('readonly');
             
              $('.booking select option').removeProp('readonly');
              $('.booking select').each(function(){
                  var val = $(this).val();
                  if(val != 'Default' || val != 'readonly'){
                      $('select option[value="'+val+'"]').not(this).prop('readonly', true);
                  }
              });
          }
      });
  });
</script>
@endsection
