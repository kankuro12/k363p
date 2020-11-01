@extends('layouts.vendor.index')

@section('content')
<div class="row">
    <div class="col-md-12">
<!--         <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info text-center">
                                <h3 class="info-title">{{$vendor->meals->count()}}</h3>
                                <h6 class="stats-title">Total Meals</h6>
                                <a href="{{route('vendor.get_meals')}}">View All <i class="ion-ios-arrow-thin-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info text-center">
                                <h3 class="info-title">{{$rooms->count()}}</h3>
                                <h6 class="stats-title">Today Rooms</h6>
                                <a href="{{route('vendor.get_rooms')}}">View All <i class="ion-ios-arrow-thin-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info text-center">
                                <h3 class="info-title">{{$vendor->amenities->count()}}</h3>
                                <h6 class="stats-title">Total Amenities</h6>
                                <a href="{{route('vendor.get_amenities')}}">View All <i class="ion-ios-arrow-thin-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info text-center">
                                <h3 class="info-title">{{$vendor->reviews->count()}}</h3>
                                <h6 class="stats-title">Total Reviews</h6>
                                <a href="{{route('vendor.reviews')}}">View All <i class="ion-ios-arrow-thin-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> -->
        <div class="card">
          <div class="card-body">
            <div id="calender"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Recent Bookings</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            	<table class="table table-hover" id="recent_bookings">
                    <thead>
                      <tr>
                        <th>S.N.</th>
                        <th>User</th>
                        <th>Package</th>
                        <th>Status</th>
                        <th>Booked At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($recent_bookings as $index=>$rbooking)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$rbooking->first_name." ".$rbooking->last_name}}</td>
                        <td>{{$rbooking->room->name}}</td>
                        <td>{{$rbooking->booking_status}}</td>
                        <td>{{$rbooking->created_at}}</td>
                        <td>
                          <a href="{{route('vendor.show_booking',['id'=>$rbooking->id])}}" class="btn btn-success btn-sm"><i class="ion-eye"></i></a>
                        </td>
                      </tr>

                      @endforeach                      
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Recent Reviews</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            	<table class="table table-hover" id="recent_reviews">
                    <thead>
                      <tr>
                        <th>User</th>
                        <th>Rating</th>   
                        <th>Status</th>                     
                        <th>Reviewed At</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($recent_reviews as $index=>$r_review)
                      <tr>
                        <td>
                          <img src="{{asset('uploads/user/profile_img/200x200/'.$r_review->vendor_user->profile_img)}}" class="img-circle" width="60px;" data-toggle="tooltip" title="{{$r_review->vendor_user->fname." ".$r_review->vendor_user->lname}}">
                        </td>
                        <td>
                          {{$r_review->all_rating()}}
                        </td>
                        <td>{{$r_review->status}}</td>
                        <td>{{$r_review->created_at->diffForHumans()}}</td>
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
@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
@endsection
@section('scripts')
<script>
$('#recent_reviews').DataTable();
$('#recent_bookings').DataTable();
</script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
           
        })
    });
</script>
@endsection