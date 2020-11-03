<style type="text/css">
  .card-user .image,.pro-wrapper{
    position:relative;
  }
  .pro-wrapper{
    background-color: white;
  }
  .card-user .image .btn-edit{
    position: absolute;
    top:10px;
    right:10px;
  }
  .pro-wrapper .btn-edit{
    position: absolute;
    bottom:-15px;
    right:-15px;
  }
  .card-user .image {
    height: 250px;
}
.card-user .avatar {
    object-fit: cover;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card card-user">
       <div class="image">
              <img src="{{asset('uploads/vendor/cover_img/'.$vendor->cover_img)}}" id="cover" alt="...">
               <button class="btn btn-sm btn-primary btn-edit" onclick="changeCover()"><i class="ion-ios-compose-outline"></i></button>
        </div>
        <div class="content">
          <div class="author">
              <span class="pro-wrapper">
                 <img class="avatar border-white" id="logo" src="{{asset('uploads/vendor/logo/263x160/'.$vendor->logo)}}" alt="...">
                 <button class="btn btn-sm btn-primary btn-edit" onclick="changeProfile()"><i class="ion-ios-compose-outline"></i></button>
              </span>
              <input type="file" id="pf-pic" style="display: none"/>
              <input type="file" id="cover_img" style="display: none"/>
              <input type="hidden" id="file_name"/>
          </div>
      </div>
      <!-- <div class="card-header">
        <h5>Edit Profile</h5>
      </div> -->
      <div class="card-body">
        
        <form id="basic-details-form" method="post" action="{{route('vendor.post_basic_details')}}">
          <input type="hidden" name="category_id" required="" value="{{$vendor->category_id}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control border-input" placeholder="Vendor Name" value="{{$vendor->name}}" name="vname">
                    </div>
                </div>
                @if(Auth::user()->role->name=="vendor" && Auth::user()->vendor->category->name=="Hotel")
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Star</label>
                        <select class="form-control" name="star">
                          <option value="">Select Star</option>
                          <option value="0" {{$vendor->star==0?'selected':''}}>No Star</option>
                          <option value="1" {{$vendor->star==1?'selected':''}}>1 Star</option>
                          <option value="2" {{$vendor->star==2?'selected':''}}>2 Star</option>
                          <option value="3" {{$vendor->star==3?'selected':''}}>3 Star</option>
                          <option value="4" {{$vendor->star==4?'selected':''}}>4 Star</option>
                          <option value="5" {{$vendor->star==5?'selected':''}}>5 Star</option>
                        </select>
                    </div>
                </div>   
                @endif                   
            </div>
            <div class="row">                     
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control border-input" placeholder="Phone Number" value="{{$vendor->phone_number}}" name="phone_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Secondary Phone Number</label>
                        <input type="text" class="form-control border-input" placeholder="Secondary Phone Number" value="{{$vendor->secondary_phone_number}}" name="secondary_phone_number">
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control border-input" placeholder="Email Address" value="{{$vendor->user->email}}" name="email">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Secondary Email Address</label>
                      <input type="text" class="form-control border-input" placeholder="Secondary Email Address" name="secondary_email" value="{{$vendor->secondary_email}}">
                  </div>
              </div>                      
            </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Facebook address</label>
                        <input type="tect" class="form-control border-input" placeholder="Facebook Address" value="{{$vendor->facebook_url}}" name="facebook_url">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Twitter Address</label>
                        <input type="text" class="form-control border-input" placeholder="Twitter  Address" name="twitter_url" value="{{$vendor->twitter_url}}">
                    </div>
                </div>                      
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Instagram address</label>
                        <input type="text" class="form-control border-input" placeholder="Instagram Address" value="{{$vendor->instagram_url}}" name="instagram_url">
                    </div>
                </div>
               
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Average Cost(in Rs.)</label>
                          <input type="text" class="form-control border-input" placeholder="Average Cost" name="average_cost" value="{{$vendor->average_cost}}">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Country</label>
                          <select name="country_id" class="form-control" id="country">
                            <option value="" selected="" disabled="">Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}" 
                              @if($vendor->location->city_id!='')
                              {{$vendor->location->city->state->country_id==$country->id?'selected':''}}
                              @endif
                              >{{$country->name}}</option>
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
                  <label for="pwd">Map:</label>
                  <input type="text" id="searchMap" class="form-control" name="location_name" value="{{$vendor->location->name}}">
                  <div class="card">
                    <div class="card-body">
                      <div id="map-canvas"></div>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="title">Lat:</label>
                          <input type="text" class="form-control" id="lat" name="lat" value="{{$vendor->location->lat}}" readonly="">
                      </div>                            
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="title">Long:</label>
                          <input type="text" class="form-control" id="lng" name="lng" value="{{$vendor->location->lng}}" readonly="">
                      </div>
                  </div>
              </div>              

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>About Vendor</label>
                        <textarea rows="12" cols="30" id="description" placeholder="Here can be your vendor description" name="description">{{$vendor->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <input  type="submit" id="submitBtn" class="btn btn-info btn-fill btn-wd btn-block" value='Update Vendor Details' >
            </div>
            <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
  <!-- <div class="col-md-4">
      <div class="card card-user">
          <div class="image">
              <img src="{{asset('uploads/vendor/cover_img/545x300/'.$vendor->cover_img)}}" id="cover" alt="...">
               <button class="btn btn-sm btn-primary btn-edit" onclick="changeCover()"><i class="ion-ios-compose-outline"></i></button>
          </div>
          <div class="content">
              <div class="author">
                <span class="pro-wrapper">
                   <img class="avatar border-white" id="logo" src="{{asset('uploads/vendor/logo/263x160/'.$vendor->logo)}}" alt="...">
                   <button class="btn btn-sm btn-primary btn-edit" onclick="changeProfile()"><i class="ion-ios-compose-outline"></i></button>
                </span>

                <h4 class="title">{{$vendor->name}}<br>
                   <a href="#"><small>{{$vendor->user->email}}</small></a>
                </h4>
                <input type="file" id="pf-pic" style="display: none"/>
                <input type="file" id="cover_img" style="display: none"/>
                <input type="hidden" id="file_name"/>

              </div>
          </div>         
      </div>
  </div> -->
</div>
<script type="text/javascript">
  $(document).ready(function(){
     $("#basic-details-form").validate({
         ignore: [],
          rules: {
             vname: {
                 required: true,
                 minlength: 4
             },
             email: {
                 required: true,
                 email: true
             },
             secondary_email: {
                 email: true
             },
             subject:{
                 required:true,
             },
             phone_number: {
                  required: true,
                  // number: true,
                  // minlength: 10,
                  // maxlength: 10
             },
             secondary_phone_number:{
                  //number: true,
                  // minlength: 10,
                  // maxlength: 10              
             },            
             average_cost:{
              required:true
             },
             facebook_url: {
                url: true
             },
             twitter_url: {
                 url:true
             },
             instagram_url:{
              url:true
             },
           
             description:{
                required:true
            ,}
             },         
             
          messages: {
              vname: {
                  required: "Please enter vendor name",
                  minlength: "Your vendor name must consist of at least 4 characters"
              },
              phone_number: {
                required: "Please provide contact number",
                minlength: "Contact must be 10 digits",
                maxlength: "Contact must not be more than 10 digits"
              },
              subject:{
                  required:"Please enter subject",
              },
              email:{
                  required:"Please enter email address",
                  email:"Please enter valid email address"
              },
              secondary_email:{                 
                  email:"Please enter valid email address"
              },
              average_cost:{
                required:"Please enter average cost"
              },
              description: {
                  required: "Please enter description ",        
              },
              star:{
                required:"Please select star"
              },
              facebook_url: "Please provide your facebook url",
              twitter_url: "Please provide your twitter url",
              instagram_url: "Please provide your instagram url",
              tripadvisor_url: "Please provide your tripadvisor url",

          },
          errorPlacement: function(error, element){              
              error.appendTo( element.parent("div") ); 
          },
          submitHandler: function(form) {
              alert('data');
            $("#submitBtn").attr('disabled','disabled');
            $.ajax({
                 url: form.action,
                 type: form.method,
                 data: $(form).serialize(),
                 dataType:'json',
                 success: function(response) {
                  $("#submitBtn").attr('disabled',false);
                     $('#basic-details-form')[0].reset();
                      if(response.errors){                        
                        for (var error in response.errors) {
                           toastr.warning(response.errors[error]);                       
                    }
                      } 
                      if(response.success){
                        toastr.success(response.message);   
                        loadData();
                      }else{
                        console.log("Sorry");
                      }
                 }            
             });
         }
      });

  });
</script>
<style type="text/css">
    #map-canvas{
        /*width: 350px;*/
        height: 400px;
    }
</style>
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
            var lat=marker.getPosition().lat();
            var lng=marker.getPosition().lng();
            $("#lat").val(lat);
            $("#lng").val(lng);

        });

      }
</script>    
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initMap"></script>
<script type="text/javascript">
  function changeProfile() {
      $('#pf-pic').click();
  }
    $('#pf-pic').change(function () {
        if ($(this).val() != '') {
            upload(this);

        }
    });
    function upload(img) {
      var form_data = new FormData();
      form_data.append('file', img.files[0]);
      form_data.append('_token', '{{csrf_token()}}');
      $.ajax({
          url: "{{route('vendor.change_profile_pic')}}",
          data: form_data,
          type: 'POST',
          contentType: false,
          processData: false,
          success: function (data) {   
              $("body").removeClass('loading');
                if(data.errors){                        
                  for (var error in data.errors) {
                     toastr.warning(data.errors[error]);                       
                }
                } 
                if(data.success){
                  $('#logo').attr('src', '{{asset('uploads/vendor/logo/263x160/')}}/' + data.logo);                   
                toastr.success(data.message); 
                }             
          },
          error: function (xhr, status, error) {
              console.log(xhr.responseText);
          }
      });
  }
  function changeCover() {
      $('#cover_img').click();
  }
    $('#cover_img').change(function () {
        if ($(this).val() != '') {
            uploadCover(this);
        }
    });
    function uploadCover(img) {
        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');                
        $.ajax({
            url: "{{route('vendor.change_cover_pic')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {   
                $("body").removeClass('loading');
                if(data.errors){                        
                  for (var error in data.errors) {
                     toastr.warning(data.errors[error]);                       
                }
                } 
                if(data.success){
                  $('#cover').attr('src', '{{asset('uploads/vendor/cover_img')}}/' + data.cover_img);
                  toastr.success(data.message);
                }
                
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
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
            url: "/country/"+cid+"/states",
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
            url: "/state/"+cid+"/cities",
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
<script type="text/javascript">  
    CKEDITOR.replace('description' );  
    CKEDITOR.config.toolbar = [
       ['Styles','Format','Font','FontSize','Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ];
</script>  