@extends('layouts.admin.index')
@section('content')
<div class="card">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#basic-details" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Basic Details</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#location" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Location In Map</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#galleries-m" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Galleries</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#privacy-policy" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Privacy & Policy</span></a> </li>
</ul>
<!-- Tab panes -->
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
                        <img src="{{asset('uploads/vendor/logo/200x200/'.$vendor->logo)}}" class="img-fluid">
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
                <tr>
                    <td>Tripadvisor Address</td>
                    <td>{{$vendor->tripadvisor_url?$vendor->tripadvisor_url:'N/A'}}</td>
                </tr>
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
            <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#addPhoto">
              Add New Photo
            </button>
            <div id="galleries"></div>
        </div>
    </div>
    <div class="tab-pane p-20" id="privacy-policy" role="tabpanel">
        <div class="p-20">
           <button class="btn btn-success btn-sm">Manage Privacy Policy</button>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="addPhoto">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Photo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{route('admin.post_add_vendor_photo',['slug'=>$vendor->slug])}}" id="addPhotoForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="vendor_id" value="{{$vendor->id}}" required="">
            @csrf
          <div class="row">
            <div class="col-md-4">                  
                <input type="file" id="image-upload" name="photo[]" class="form-control">
            </div>
            <div class="col-md-3">                  
                <input type="text" name="caption[]" class="form-control" placeholder="Caption ...">
            </div>
            <div class="col-md-3">                  
                <select class="form-control" name="status[]">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success addMore" type="button"><i class="mdi mdi-plus-circle-outline"></i></button>
            </div>
          </div>  
          <div class="newField"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editPhoto">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Photo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="editPhotoBody">
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="manage-privacy">
  <div class="modal-dialog">
    <div class="modal-content">


    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
      var map;
      var lat={{$vendor->lat}};
      var lng={{$vendor->lng}};
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
<script type="text/javascript">
            //group add limit
        var maxGroup = 10;
        var i=1;        
        //add more fields group
        $(".addMore").click(function(){         
            if(i < maxGroup){
                var fieldHTML =

               '<div class="row" id="f-'+i+'">'+
                    '<div class="col-md-4">'+               
                        '<input type="file" id="image-upload" name="photo[]" class="form-control">'+
                    '</div>'+
                    '<div class="col-md-3">'+               
                        '<input type="text" name="caption[]" class="form-control" placeholder="Caption ...">'+
                    '</div>'+
                    '<div class="col-md-3">'+               
                        '<select class="form-control" name="status[]">'+
                            '<option value="active">Active</option>'+
                            '<option value="inactive">Inactive</option>'+
                        '</select>'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<button class="btn btn-danger addMore" onclick="remove('+i+')" type="button"><i class="mdi mdi-delete-circle"></i></button>'+
                    '</div>'+
                '</div>'; 
                
                $(".newField").append(fieldHTML);
                i++;
            }else{
                alert('Maximum '+maxGroup+' groups are allowed.');
            }
        });     
        
        function remove(a){
            $("#f-"+a).remove();
            i--;
        }
        function deletePhoto(i){
           $.ajax({
               type:'POST',
               url: "{{route('admin.get_delete_vendor_photo',['slug'=>$vendor->slug])}}",
               data:{"id":i}, 
               dataType:'json',
               headers:{
                   'X-CSRF-TOKEN': "{{csrf_token()}}"
               },           
               success:function(data){
                   $("#addPhoto").modal('hide');
                   alert(data.msg);
                   loadPhotos();
               },
               error: function(data){
                   console.log("error");
                   console.log(data);
               }
           });    
        }
        
        $('#addPhotoForm').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var file_data = $('#image-upload').prop('files')[0];                       
            formData.append('file', file_data);
            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,  
                cache:false,
                contentType: false,
                processData: false, 
                dataType:'json',
                headers:{
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },           
                success:function(data){
                    $("#addPhoto").modal('hide');
                    alert(data.msg);
                    loadPhotos();
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));



        loadPhotos();



        function loadPhotos(){
            $.ajax({
                type:'GET',
                url: "{{route('admin.get_vendor_photo',['slug'=>$vendor->slug])}}",                 
                dataType:'html',                          
                success:function(data){
                    $("#addPhoto").modal('hide');
                    $("#galleries").html(data);
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });         
        }
        $(document).on('click','.edit-btn',function(){
            $("#editPhoto").modal('show');
            var id=$(this).attr('data-p-id');
            $.ajax({
                type:'GET',
                url: "{{route('admin.get_edit_vendor_photo',['slug'=>$vendor->slug])}}", 
                data:{"id":id},                
                dataType:'html',                          
                success:function(data){                    
                    $("#editPhotoBody").html(data);
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });         
        });
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