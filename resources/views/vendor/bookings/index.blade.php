@extends('layouts.vendor.index')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Booking Details</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="bookings" class="table table-hover">
            <thead class="">
              <th>S.N.</th>
              <th>Customer</th>
              <th>Package</th>
              <th>Price</th>
              <th>Booking Status</th>
              <th>Action</th>
            </thead>
            <tbody>
             @foreach($bookings as $booking)
             <tr>
               <td>{{$booking->id}}</td>
               <td>{{$booking->first_name." ".$booking->last_name}}</td>
               <td>{{$booking->room->name}}</td>
               <td>{{$booking->new_price}}</td>
               <td>{{$booking->booking_status}}</td>
               <td>
                 <a href="{{route('vendor.show_booking',['id'=>$booking->id])}}" class="btn btn-success">View</a>
               </td>
             </tr>
             @endforeach                                   
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
$('#bookings').DataTable();
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection