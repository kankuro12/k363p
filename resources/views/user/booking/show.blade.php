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
                    <h4 class="mb-3 color1 font-weight-bold">Booking Detail</h4>

                      <div id="accordion">
                            <div class="card">
                              <div class="card-header">
                                <a data-toggle="collapse" href="#booking-detail">
                                  Service Details
                                </a>
                              </div>
                              <div id="booking-detail" class="collapse show" data-parent="#accordion">
                                <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <td>Service Provider</td>
                                        <td>{{$booking->vendor->name}}</td>
                                      </tr>
                                      <tr>
                                        <td>Registrant Name</td>
                                        <td>{{$booking->first_name." ".$booking->last_name}}</td>
                                      </tr>
                                      <tr>
                                        <td>Email address</td>
                                        <td>{{$booking->email}}</td>
                                      </tr>
                                      <tr>
                                        <td>Phone number</td>
                                        <td>{{$booking->phone_number}}</td>
                                      </tr>
                                      <tr>
                                        <td>Start Date</td>
                                        <td>{{$booking->check_in_time}}</td>
                                      </tr>
                                      <tr>
                                        <td>End Date</td>
                                        <td>{{$booking->check_out_time??"--"}}</td>
                                      </tr>
                                      <tr>
                                        <td>Service</td>
                                        <td>{{$booking->room->name}}</td>
                                      </tr>
                                      {{-- <tr>
                                        <td>Adult</td>
                                        <td>{{$booking->adult}}</td>
                                      </tr>
                                      <tr>
                                        <td>Child</td>
                                        <td>{{$booking->children}}</td>
                                      </tr> --}}
                                      <tr>
                                        <td>Payment Method</td>
                                        <td>{{($booking->type==2?'Online Payment('.$booking->payment->provider.')':'Pay At Hotel')}}</td>
                                      </tr>
                                      <tr>
                                        <td>Payment Status</td>
                                        <td>{{$booking->payment_status}}</td>
                                      </tr>
                                      <tr>
                                        <td>Booking Time</td>
                                        <td>{{$booking->created_at}}</td>
                                      </tr>
                                      <tr>
                                        <td>Booking Status</td>
                                        <td>{{$booking->booking_status}}</td>
                                      </tr>
                                    </tbody>
                                  </table>                               
                              </div>
                            </div>
                            {{-- <div class="card">
                              <div class="card-header">
                                <a data-toggle="collapse" href="#meal-detail">
                                  Meal Details
                                </a>
                              </div>
                              <div id="meal-detail" class="collapse" data-parent="#accordion"> 
                                <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <th>S.N</th>
                                        <th>Meal Name</th>
                                        <th>Price per unit</th>
                                        <th>Quantity</th>
                                        <th>Total Price(in Nrs.)</th>
                                      </tr>
                                      @php
                                      $meal_price ?? ''=0;
                                      @endphp
                                      @foreach($booking->meals as $i=>$meal)
                                      @php
                                      $meal_price ?? ''+=$meal->meal->price*$meal->meal_value;
                                      @endphp
                                      <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$meal->meal->name}}</td>
                                        <td>{{$meal->meal->price}}</td>
                                        <td>{{$meal->meal_value}}</td>
                                        <td>{{$meal->meal_value*$meal->meal->price}}</td>
                                      </tr>
                                      @endforeach
                                      <tr>
                                        <th>Total Meal Price</th>
                                        <th>{{$meal_price ?? ''}}</th>
                                      </tr>
                                    </tbody>
                                  </table>                          
                              </div>
                            </div> --}}
                            <div class="card">
                              <div class="card-header">
                                <a data-toggle="collapse" href="#price-detail">
                                  Price Details
                                </a>
                              </div>
                              <div id="price-detail" class="collapse" data-parent="#accordion"> 
                                 <table class="table table-bordered">
                                   <tr>
                                     <th>Service Cost</th>
                                     <th>{{$booking->new_price}}</th>
                                   </tr>
                                   {{-- <tr>
                                     <th>Meal Cost</th>
                                     <th>{{$meal_price ?? ''}}</th>
                                   </tr> --}}
                                   <tr>
                                     <th>Total Cost(In Nrs.)</th>
                                     <th>{{$booking->new_price?? ''}}</th>
                                   </tr>
                                 </table>                      
                              </div>
                            </div>
                      </div>               
                </div>
            </div>
        </div>
    </div>
</section>
@endsection