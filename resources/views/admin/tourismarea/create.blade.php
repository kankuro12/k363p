@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Create New Tourism Area</h5>
            </div>
            <div class="card-body">
               @include('layouts.admin.snippets.error')
               <form method="post" action="{{route('admin.post_tourisam_areas_create')}}" enctype="multipart/form-data" id="addAmenity">
                @csrf
                   <div class="card-body">
                       <div class="form-group">
                           <label for="fname">Name</label>                        
                           <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name')}}">
                       </div>
                       <div class="form-group">
                           <label>Featured Image</label>                        
                           <input type="file" class="form-control"  name="featured_image" value="{{old('featured_image')}}">
                       </div>
                       <div class="form-group">
                           <label>Description</label>                        
                           <textarea class="form-control" id="editor" name="description" rows="10">{{old('description')}}</textarea>
                       </div>
                       <div class="form-group">
                           <label>Location</label>                        
                           <input type="text" class="form-control" id="searchMap" placeholder="Location" name="location" value="{{old('location')}}">
                       </div>
                       <div class="form-group">
                          <div class="card">
                            <div class="card-body">
                         	    <label for="pwd">Map:</label>
                         	    <div id="map-canvas"></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                         	    <label for="title">Lat:</label>
                         	    <input type="text" class="form-control" id="lat" name="lat" readonly="">
                        </div>
                        <div class="form-group">
                         	    <label for="title">Long:</label>
                         	    <input type="text" class="form-control" id="lng" name="lng" readonly="">
                        </div>
                       <div class="form-group">
                       	<label>Status</label>
                        <select class="form-control" name="status" required="">
                            <option value="">Select Status</option>
                            <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
                            <option value="inactive" {{old('status')=='inactive'?'selected':''}}>Inactive</option>
                        </select>
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
@section('styles')
<style type="text/css">
 	#map-canvas{
 		width: 100%;
 		height: 250px;
 	}
 </style>
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
            console.log(addressType);
        	}
        	
        	map.fitBounds(bounds);
        	map.setZoom(15);
        });


        google.maps.event.addListener(marker,'position_changed', function() {
        	var lat=marker.getPosition().lat().toFixed(5);;
        	var lng=marker.getPosition().lng().toFixed(5);;
        	$("#lat").val(lat);
        	$("#lng").val(lng);

        });

      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBahYsHxb42lOZjgo5bN04hX7hXCAJCUl8&libraries=places&callback=initMap"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script> 
    <script type="text/javascript">  
         CKEDITOR.replace( 'editor' );  
      </script>  

@endsection