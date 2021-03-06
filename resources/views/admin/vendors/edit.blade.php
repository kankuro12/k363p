@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                 <h5>Edit Vendor({{$vendor->name}})</h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_edit_vendor',['slug'=>$vendor->slug])}}" id="addVendor" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Vendor Type</label>                        
                                    <select name="category_id" class="form-control">
                                        @foreach($vcategories as $vcategory)
                                        <option value="{{$vcategory->id}}" {{$vcategory->id==$vendor->category_id?'selected':''}}>{{$vcategory->name}}</option>
                                        @endforeach                            
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Vendor Name</label>                        
                                    <input type="text" class="form-control" id="name" placeholder="Vendor Name" name="name" value="{{$vendor->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>                        
                                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{$vendor->user->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Secondary Email Address</label>
                                    <input type="email" name="secondary_email" class="form-control" placeholder="Enter secondary email" value="{{$vendor->secondary_email
                                    }}">
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>                        
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{$vendor->password}}">
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpassword">Confirm Password</label>                        
                                    <input type="password" class="form-control" id="cpassword" placeholder="Password" name="password_confirmation" value="{{$vendor->password_confirmation}}">
                                </div>                            
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" value="{{$vendor->phone_number}}">
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Website(url)</label>
                                    <input type="text" name="website" class="form-control" placeholder="Enter website address" value="{{$vendor->website}}">
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Facebook Url</label>
                                    <input type="text" name="facebook_url" class="form-control" placeholder="Enter facebook url" value="{{$vendor->facebook_url}}">
                                </div>                            
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Twitter Url</label>
                                    <input type="text" name="twitter_url" class="form-control" placeholder="Enter twitter url" value="{{$vendor->twitter_url}}">
                                </div>                           
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Instagram Url</label>
                                    <input type="text" name="instagram_url" class="form-control" placeholder="Enter instagram url" value="{{$vendor->instagram_url}}">
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tripadvisor Url</label>
                                    <input type="text" name="trpiadvisor_url" class="form-control" placeholder="Enter trip advisor url" value="{{$vendor->tripadvisor_url}}">
                                </div>                             
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Featured</label>
                                    <select class="form-control" name="featured">
                                        <option value="">Select One</option>
                                        <option value="1" {{$vendor->featured=='1'?'selected':''}}>Yes</option>
                                        <option value="0" {{$vendor->featured=='0'?'selected':''}}>No</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Select Status</option>
                                        <option value="1" {{$vendor->user->active=='1'?'selected':''}}>Active</option>
                                        <option value="0" {{$vendor->user->active=='0'?'selected':''}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>           
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control" value="{{old('logo')}}">
                            <div class="mt-2">
                                <img src="{{asset($vendor->logo)}}" height="70" class="img-responsive">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cover Image</label>
                            <input type="file" name="cover_img" class="form-control" value="{{old('cover_img')}}">
                            <div class="mt-2">
                                <img src="{{asset($vendor->cover_img)}}" height="70" class="img-responsive">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="description">Description</label>                        
                            <textarea class="form-control" name="description" placeholder="Vendor Description ..." rows="10">{{$vendor->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Average Cost(In Rs.)</label>
                            <input type="text" name="average_cost" class="form-control" placeholder="Enter average cost" value="{{$vendor->average_cost}}">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select name="country_id" class="form-control" id="country">
                                        <option value="" selected="" disabled="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state_id" id="state" class="form-control">
                                        <option value="">Select State</option>
                                        @if($vendor->location->city_id!='')
                                        @foreach($vendor->location->city->state->country->states as $state)
                                        <option value="{{$state->id}}"
                                        
                                         {{$vendor->location->city->state_id==$state->id?'selected':''}}
                                        >{{$state->name}}</option>
                                        @endforeach
                                        @endif                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" id="city" class="form-control">
                                       <option value="">Select City</option>
                                       @if($vendor->location->city_id!='')
                                       @foreach($vendor->location->city->state->cities as $city)
                                       <option value="{{$city->id}}" {{$vendor->location->city_id==$city->id?'selected':''}} >{{$city->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>
                            </div>

                        </div>    
                   
                        <div class="form-group">
                            <label for="pwd">Street Address:</label>
                            <input type="text" id="searchMap" value="{{$vendor->location->name}}" class="form-control">
                            <br>
                            <div id="map-canvas"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Lat:</label>
                                    <input type="text" class="form-control" id="lat" name="lat" value="{{$vendor->location->lat}}">
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Long:</label>
                                    <input type="text" class="form-control" id="lng" name="lng" value="{{$vendor->location->lng}}">
                                </div>
                            </div>
                        </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </form>
                 
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
      var map;
      var lat={{$vendor->location->lat?$vendor->location->lat:26.4524746}};
      var lng={{$vendor->location->lng?$vendor->location->lng:87.271781}};
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
        var searchBox=new google.maps.places.SearchBox(document.getElementById('searchMap'));

        google.maps.event.addListener(searchBox,'places_changed', function() {
            var places=searchBox.getPlaces();
            var bounds=new google.maps.LatLngBounds();
            var i,place;
            for(i=0;place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            var addressType = place.address_components[i].types[0];            
            }            
            map.fitBounds(bounds);
            map.setZoom(15);
        });


        google.maps.event.addListener(marker,'position_changed', function() {
            var lat=marker.getPosition().lat().toFixed(5);
            var lng=marker.getPosition().lng().toFixed(5);
            $("#lat").val(lat);
            $("#lng").val(lng);

        });

      }
</script>    
<script src="https://maps.googleapis.com/maps/api/js?key={{env('api','')}}&libraries=places&callback=initMap"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#addVendor").validate({
            rules: {
                name: "required",
                status: "required",
                email:{
                    required: true,
                    email: true
                },
                secondary_email:{
                    email:true
                },                
                phone_number:{
                    required:true,
                },
                average_cost:{
                    required:true,
                },
                lat:"required",
                lng:"required"             

            },
            messages: {
                name: "Please enter vendor name",
                status: "Please select a status",
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },                
                phone_number:{
                    required:"Please enter phone number"
                },
                average_cost:{
                    required:"Please enter average cost"
                },

            
            }
});
</script>
<script type="text/javascript">
    $(document).on('change','#country',function(){
        var country_id=$(this).val();
        $("#state").empty();
        $("#city").empty();
        generateState(country_id);
    });
    $(document).on('change','#state',function(){
        var state_id=$(this).val();
        generateCity(state_id);
    });
    function generateState(cid){
        $.ajax({
            type: "get",
            url: "/admin/country/"+cid+"/states",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                // $("body").addClass('loading');    
            },
            success: function (data){
                // $("body").removeClass('loading'); 
                $("#state").empty();
                $('#state').append($('<option>',{value:' ', text:'Select State'}));

                $.each(data, function(index, state) {                                 
                    $('#state').append($('<option>',{value:state.id, text:state.name}));
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    function generateCity(cid){
        $.ajax({
            type: "get",
            url: "/admin/state/"+cid+"/cities",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                //$("body").addClass('loading');    
            },
            success: function (data){
                //$("body").removeClass('loading'); 
                $("#city").empty();
                $('#city').append($('<option>',{value:' ', text:'Select City'}));

                $.each(data, function(index, state) {                                 
                    $('#city').append($('<option>',{value:state.id, text:state.name}));
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }
</script>
@endsection

@section('styles')
<style type="text/css">
    #map-canvas{
        /*width: 350px;*/
        height: 400px;
    }
</style>
@endsection

