@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                 <h5>Create New Vendor</h5>
            </div>
            <div class="content">
                @include('layouts.admin.snippets.error') 
                <form method="post" action="{{route('admin.post_create_vendor')}}" id="addVendor" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Vendor Type *</label>                        
                                    <select name="category_id" class="form-control" required>
                                        @foreach($vcategories as $vcategory)
                                        <option value="{{$vcategory->id}}">{{$vcategory->name}}</option>
                                        @endforeach                            
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Vendor Name *</label>                        
                                    <input type="text" class="form-control" id="name" placeholder="Vendor Name" name="name" value="{{old('name')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address *</label>                        
                                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{old('email')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Secondary Email Address</label>
                                    <input type="email" name="secondary_email" class="form-control" placeholder="Enter secondary email" value="{{old('secondary_email
                                    ')}}">
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password *</label>                        
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{old('password')}}" required>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpassword">Confirm Password *</label>                        
                                    <input type="password" class="form-control" id="cpassword" placeholder="Password" name="password_confirmation" value="{{old('password_confirmation')}}" required>
                                </div>                            
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone number *</label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" value="{{old('phone_number')}}" required>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Website(url)</label>
                                    <input type="text" name="website" class="form-control" placeholder="Enter website address" value="{{old('website')}}">
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Facebook Url</label>
                                    <input type="text" name="facebook_url" class="form-control" placeholder="Enter facebook url" value="{{old('facebook_url')}}">
                                </div>                            
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Twitter Url</label>
                                    <input type="text" name="twitter_url" class="form-control" placeholder="Enter twitter url" value="{{old('twitter_url')}}">
                                </div>                           
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Instagram Url</label>
                                    <input type="text" name="instagram_url" class="form-control" placeholder="Enter instagram url" value="{{old('instagram_url')}}">
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tripadvisor Url</label>
                                    <input type="text" name="trpiadvisor_url" class="form-control" placeholder="Enter trip advisor url" value="{{old('trpiadvisor_url')}}">
                                </div>                             
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Featured</label>
                                    <select class="form-control" name="featured" required>
                                        <option value="">Select One</option>
                                        <option value="1" {{old('featured')=='1'?'selected':''}}>Yes</option>
                                        <option value="0" {{old('featured')=='0'?'selected':''}}>No</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status *</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
                                        <option value="inactive" {{old('status')=='inactive'?'selected':''}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>           
                        <div class="form-group">
                            <label>Logo *</label>
                            <input type="file" name="logo" class="form-control" value="{{old('logo')}}" required>
                        </div>
                        <div class="form-group">
                            <label>Cover Image *</label>
                            <input type="file" name="cover_img" class="form-control" value="{{old('cover_img')}}" required>
                        </div> 
                        <div class="form-group">
                            <label for="description">Description *</label>                        
                            <textarea class="form-control" name="description" placeholder="Vendor Description ..." rows="10" required>{{old('description')}}</textarea>
                        </div>
                        {{-- <div class="form-group">
                            <label>Average Cost(In Rs.)</label>
                        </div>  --}}
                        <input type="hidden" name="average_cost" class="form-control" placeholder="Enter average cost" value="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <select name="country_id" class="form-control" id="country" required>
                                        <option value="" selected="" disabled="" >Select Country</option>
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
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" id="city" class="form-control">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                        </div>                  
                        <div class="form-group">
                            <label for="pwd">Street Address:</label>
                            <input type="text" id="searchMap" name="location_name" class="form-control mb-2" placeholder="Street Address">
                            <div id="map-canvas"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Lat:</label>
                                    <input type="text" class="form-control" id="lat" name="lat">
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Long:</label>
                                    <input type="text" class="form-control" id="lng" name="lng">
                                </div>
                            </div>
                        </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
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
      function initMap() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {
            lat: 26.4524746,
            lng: 87.271781              
          },
          zoom: 15
        });

        var marker=new google.maps.Marker(
            {
                position: {
                    lat: 26.4524746,
                    lng: 87.271781              
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
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initMap"></script>
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
                password: {
                    required: true,
                    minlength: 5
                },
                password_confirmation: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                phone_number:{
                    required:true,
                },
                average_cost:{
                    required:true,
                },
               

            },
            messages: {
                name: "Please enter vendor name",
                status: "Please select a status",
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                }, 
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                password_confirmation: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
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
        console.log(cid,"cid");
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

