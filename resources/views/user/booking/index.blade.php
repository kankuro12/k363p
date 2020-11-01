@extends('layouts.public.index')
@section('content')
@include('user.nav')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-sidebar sticky-top">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Bookings</h4>
                    <table class="table table-bordered" id="bookings">
                        <thead>
                          <tr>
                          	<th>Provider</th>
                            <th>Service</th>
                            <th>Payment Status</th>  
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{$booking->room->vendor->name}}</td>
                            <td>{{$booking->room->name}}</td>
                            <td>{{$booking->payment_status}}</td>
                            <td>{{$booking->booking_status}}</td>
                            <td>
                                <a href="{{route('user.show_bookings',['id'=>$booking->booking_id])}}" class="btn btn-success my-2 my-sm-0 text-white">View Detail</a>
                            </td>
                        </tr> 
                        @endforeach                      
                        </tbody>
                      </table>                                       
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('assets/public/datatable/datatables.min.js')}}"></script>
<script type="text/javascript">
	$('#bookings').DataTable();
</script>
@endsection
@section('styles')
<link href="{{asset('assets/public/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection


