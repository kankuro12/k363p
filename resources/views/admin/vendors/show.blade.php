@extends('layouts.admin.index')
@section('content')
<div class="row">
  <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 15px;">
                    <div class="card-header">
                        <h5>{{$vendor->name}}</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body ">
                            <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#basic-details" role="tablist">
                                        <i class="ion-android-options"></i>
                                        Basic Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#location" role="tablist">
                                        <i class="ion-android-pin"></i>
                                        Location In Map
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#galleries-m" role="tablist">
                                        <i class="ion-images"></i>
                                        Galleries
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#amenities" role="tablist">
                                        <i class="ion-android-restaurant"></i>
                                        Services
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#reviews" role="tablist">
                                        <i class="ion-android-star-half"></i>
                                        Reviews
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#rooms" role="tablist">
                                        <i class="ion-ios-browsers-outline"></i>
                                        Packages
                                    </a>
                                </li>
                            </ul>
                            <br>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active show" id="basic-details" role="tabpanel">
                                    <div class="p-20">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Vendor Name</td>
                                                <td>{{$vendor->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Logo</td>
                                                <td>
                                                    <img src="{{asset('uploads/vendor/logo/263x160/'.$vendor->logo)}}" height="40px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email Address</td>
                                                <td>{{$vendor->user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone Number</td>
                                                <td>{{$vendor->phone_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>{{$vendor->location?$vendor->location->name:'N/A'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td>{{$vendor->category->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Average Cost</td>
                                                <td>{{$vendor->average_cost?$vendor->average_cost:'N/A'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Website</td>
                                                <td>{{$vendor->website?$vendor->website:'N/A'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Secondary Email Address</td>
                                                <td>{{$vendor->secondary_email?$vendor->secondary_email:'N/A'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Facebook Address</td>
                                                <td>{{$vendor->facebook_url?$vendor->facebook_url:'N/A'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Twitter Address</td>
                                                <td>{{$vendor->twitter_url?$vendor->twitter_url:'N/A'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Instagram Address</td>
                                                <td>{{$vendor->instagram_url?$vendor->instagram_url:'N/A'}}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>Tripadvisor Address</td>
                                                <td>{{$vendor->tripadvisor_url?$vendor->tripadvisor_url:'N/A'}}</td>
                                            </tr> --}}
                                            <tr>
                                                <td>Verified</td>
                                                <td>{{$vendor->verified==1?'Yes':'No'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Featured</td>
                                                <td>{{$vendor->featured==1?'Yes':'No'}}</td>
                                            </tr>
                                            <!-- <tr colspan="4">

                                                <td>
                                                    Map Location
                                                    <div id="map-canvas"></div>
                                                </td>
                                            </tr> -->
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane p-20" id="location" role="tabpanel">
                                    <div class="p-20">
                                        <div id="map-canvas"></div>
                                    </div>
                                </div>
                                <div class="tab-pane p-20" id="galleries-m" role="tabpanel">
                                    <div class="p-20">
                                        <div id="galleries"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="amenities">
                                                        <table class="table table-bordered" id="amenities">
                                                            <thead>
                                                              <tr>
                                                                <th>Service</th>
                                                                <th>Icon</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                             @foreach($vendor->amenities as $amenity)
                                                              <tr>
                                                                <td>{{$amenity->name}}</td>
                                                                <td>
                                                                  <img src="{{asset('uploads/vendor/amenities/icons/'.$amenity->icon)}}" class="img-responsive" width="50px;">
                                                                </td>
                                                              </tr>
                                                              @endforeach
                                                            </tbody>
                                                          </table>
                                                    </div>
                                                    <div class="tab-pane" id="reviews" style="padding-bottom: 20px;">
                                                        <table id="reviewstbl" class="table table-bordered">
                                                            <thead>
                                                                <tr>

                                                                    <th>Review</th>

                                                                    <th>rating</th>
                                                                    <th>Status</th>
                                                                    <th>Time</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($vendor->reviews as $rv)
                                                            <tr>


                                                                <td>{{$rv->review_description}}</td>
                                                                <td>{{$rv->avg_rating}}</td>
                                                                {{-- <td>{{$rv->facility}}</td> --}}
                                                                <td>
                                                                    @if($rv->status=="approved")
                                                                    <span class="label label-success">Approved</span>
                                                                    @else
                                                                    <span class="label label-info">Unpproved</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$rv->created_at->toFormattedDateString()}}</td>
                                                            </tr>

                                                            @endforeach
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="rooms">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover" id="rooms">
                                                                <thead>
                                                                    <tr>
                                                                        <th>S.N.</th>
                                                                        <th>Name</th>
                                                                        <th>Type</th>
                                                                        <th>Price</th>
                                                                        <th>Discount</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($vendor->rooms as $index=>$room)
                                                                  <tr>
                                                                    <td>{{$index+1}}</td>
                                                                    <td>{{$room->name}}</td>
                                                                    <td>{{$room->roomtype->name}}</td>
                                                                    <td>{{$room->price}}</td>
                                                                    <td>{{$room->discount?$room->discount:'0'}}</td>
                                                                    <td>{{$room->status}}</td>
                                                                    <th>
                                                                      <a href="{{route('admin.edit_package',['slug'=>$room->slug])}}" class="btn btn-success btn-sm" target="_blank"><i class="ion-ios-compose-outline"></i></a>
                                                                      <button class="btn btn-primary btn-sm delete_room" data-room-id="{{$room->id}}"><i class="ion-ios-trash-outline"></i></button>
                                                                    </th>
                                                                  </tr>

                                                                  @endforeach
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
      var map;
      var lat={{$vendor->location->lat!=null?$vendor->location->lat:0}};
      var lng={{$vendor->location->lng!=null?$vendor->location->lng:0}};
      function initMap() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {
            lat: lat,
            lng: lng
          },
          zoom: 15
        });

        var marker=new google.maps.Marker(
            {
                position: {
                    lat: lat,
                    lng: lng
                },
                map: map,
                draggable:true
            }
        );
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBahYsHxb42lOZjgo5bN04hX7hXCAJCUl8&libraries=places&callback=initMap"></script>
@endsection
@section('styles')
<style type="text/css">
    #map-canvas{
        /*width: 350px;*/
        height: 400px;
    }
</style>
@endsection
