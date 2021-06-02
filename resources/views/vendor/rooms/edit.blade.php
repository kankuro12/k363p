@extends('layouts.vendor.index')
@section('content')
<style type="text/css">
    .d-flex{
        display: flex;
        flex-wrap: wrap;
        padding: 10px;

    }
    .edt-img-wrapper{
        width: 18%;
        border:1px solid #fff;
        height: 120px;
        position: relative;
        overflow: hidden;
        margin-bottom:10px;
        margin-right: 15px;
    }
    .edt-img-wrapper img{
        object-fit: cover;
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        height: 100%;width: 100%;object-fit: cover;
    }
    .del-img{
        position: absolute;
        top:9px;
        right: 8px;
        height: 20px;
        width: 20px;
        padding: 0 !important;
        border-radius: 50% !important;
    }
</style>
<div class="row">
  <div class="col-md-12 mx-auto">
      @include('layouts.vendor.snippets.error')
      <form id="basic-details-form" method="post" action="{{route('vendor.post_edit_rooms',['id'=>$room->id])}}" enctype="multipart/form-data">
          @csrf
          <div class="card card-success">
              <div class="card-header">Basic Details</div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Package Name</label>
                              <input type="text" class="form-control border-input" placeholder="Enter Package name" value="{{$room->name}}" name="name">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Price(In Rs.)</label>
                              <input type="number" class="form-control border-input" placeholder="Price" name="price" value="{{$room->price}}">
                          </div>
                      </div>                                          
                  </div> 
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Discount Percentage</label>
                            <input type="number" class="form-control border-input" placeholder="Discount" name="discount" value="{{$room->discount}}">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Service Type</label>
                            <select class="form-control" name="roomtype_id">
                                <option value="">Select Service Type</option>
                                @foreach($room_types as $room_type)
                                <option value="{{$room_type->id}}" {{$room_type->id==$room->roomtype_id?'selected':''}}>{{$room_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Package Status</option>
                                <option value="Available" {{$room->status=='Available'?'selected':''}}>Available</option>
                                <option value="UnAvailable" {{$room->status=='UnAvailable'?'selected':''}}>UnAvailable</option>
                            </select>
                        </div>
                    </div>  
                  </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header">Photo Galleries</div>
              <div class="card-body">
                <div class="d-flex">
                @foreach($room->roomphotos as $photo)
                    <div class="edt-img-wrapper" id="img-{{$photo->id}}">
                        <img src="{{asset($photo->image)}}" class="img-responsive">
                        <a href="#" class="del-img btn btn-primary btn-fill" data-img-id="{{$photo->id}}">x</a>
                    </div>                           
                @endforeach
                </div> 
                <div class="row">                                    
                    <div class="col-md-8">                                        
                        <input type='file' id="image-upload" name="photos[]" class="form-control" accept="image/*"/>
                    </div>
                    <div class="col-md-4">
                       <button class="btn btn-success btn-sm addPhoto" type="button"><i class="ion-ios-plus-outline"></i></button>
                    </div>
                </div>
                <div class="newPhoto"></div>  
                <br>
                <small>Press <span class="ion-ios-plus-outline"></span> to add another form field :)</small>               
              </div>
          </div>
          <div class="card">
              <div class="card-header">Services Details</div>
              <div class="card-body">
                  @foreach($room->roomamenities as $ra)
                  <input type="hidden" name="amenity_id[]" required="" value="{{$ra->id}}">
                  <div class="row" id="amenity-{{$ra->id}}">                                   
                     <div class="col-md-6">                  
                         <input type="text" name="amenity[]" class="form-control" placeholder="Amenities" required="required" value="{{$ra->amenity}}">
                     </div>                              
                     <div class="col-md-2">
                         <button class="btn btn-primary btn-sm delete_amenity" data-aid="{{$ra->id}}" type="button"><i class="ion-ios-trash-outline"></i></button>
                     </div>
                  </div> 
                  @endforeach
                  <div class="newField"></div>
                  <br>
                  <small>Press <span class="ion-ios-plus-outline"></span> to add another form field :)</small>  
                  <button type="button" class="addMore btn btn-success btn-sm"><i class="ion-ios-plus-outline"></i></button>        
              </div>
          </div>
          {{-- <div class="card">
              <div class="card-header">Bed Details</div>
              <div class="card-body">
                  @foreach($room->beds as $bed)
                      <input type="hidden" name="bed_id[]" value="{{$bed->id}}" required="">
                      <div class="row" id="bed-{{$bed->id}}">  
                          <div class="col-md-3">
                            <label>Select Bed Type</label>
                            <select class="form-control" name="bed_type_id[]">
                              <option value="">Select Bed Type</option>
                              @foreach($bed_types as $bed_type)
                              <option value="{{$bed_type->id}}" {{$bed->bed_type_id==$bed_type->id?'selected':''}}>{{$bed_type->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-3">  
                              <label>Number of beds</label>                                      
                              <input type='number' name="bed_number[]" placeholder="Enter number of bed" class="form-control" required="required" value="{{$bed->bed_number}}" />
                          </div>                                
                          
                          <div class="col-md-2">
                              <label>Number of Adults</label>                  
                              <input type="number" name="adult[]" class="form-control" placeholder="Adult" value="{{$bed->adult}}">
                          </div>
                          <div class="col-md-2">   
                              <label>Number of Childs</label>               
                              <input type="number" name="child[]" class="form-control" placeholder="Children" value="{{$bed->child}}" required>
                          </div>
                      </div>                            
                  @endforeach 
                  <div class="newBed"></div>
                  <br>
                  <small>Press <span class="ion-ios-plus-outline"></span> to add another form field :)</small>
                  <button type="button" class="btn btn-success btn-sm addBed">
                    <i class="ion-ios-plus-outline"></i>                      
                  </button> 
              </div>
          </div>
          <div class="card">
              <div class="card-header">Room Number Details</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Number of Room</label>
                        <input type="text" class="form-control border-input" placeholder="Enter number of room" value="{{$room->no_of_rooms}}" name="no_of_rooms">
                    </div>
                  </div>
                </div>
                @foreach($room->childrooms as $cr)
                <input type="hidden" name="croom_id[]" required="" value="{{$cr->id}}">
                <div class="row" id="croom-{{$cr->id}}">                                   
                   <div class="col-md-6"> 
                        <label>Room Number</label>                 
                       <input type="text" name="room_number[]" class="form-control" placeholder="Room Number" required="required" value="{{$cr->room_number}}">
                   </div>                              
                </div> 
                @endforeach                  
              </div>
          </div> --}}

          <div class="card">
            <div class="card-header">Package Description</div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <textarea rows="10" name="description" class="form-control">{{$room->description}}</textarea>
                    </div>
                  </div>
              </div>
          </div>

          <div>
              <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
              <button type="reset" class="btn btn-primary btn-wd btn-fill">Reset</button>
          </div>
          <div class="clearfix"></div>
      </form>      
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('click','.del-img',function(e){
        e.preventDefault();
        var img_id=$(this).attr('data-img-id');
        $.ajax({
          type: "post",
          url: "{{route('vendor.get_delete_photos_rooms',['id'=>$room->id])}}",
          data: {"img_id":img_id},
          cache: false,
          beforeSend: function() {
             // $("body").addClass('loading');         
          },
          success: function (data){
            $("body").removeClass('loading'); 
            $("#img-"+img_id).remove();
            },
            error:function(data){
              console.log(data);
            }
        });
    });
    $(document).on('click','.delete_amenity',function(e){
        e.preventDefault();
        var aid=$(this).attr('data-aid');
        $.ajax({
          type: "post",
          url: "{{route('vendor.delete_amenities_rooms',['id'=>$room->id])}}",
          data: {"aid":aid},
          cache: false,
          beforeSend: function() {
              //$("body").addClass('loading');         
          },
          success: function (data){
            $("body").removeClass('loading'); 
            $("#amenity-"+aid).remove();
            },
            error:function(data){
              console.log(data);
            }
        });
    });

    $(document).on('click','.deleteBed',function(e){
        e.preventDefault();
        var bed_id=$(this).attr('data-bed-id');
        $.ajax({
          type: "post",
          url: "{{route('vendor.get_delete_bed_rooms',['id'=>$room->id])}}",
          data: {"bed_id":bed_id},
          cache: false,
          beforeSend: function() {
              //$("body").addClass('loading');         
          },
          success: function (data){
            $("body").removeClass('loading'); 
            $("#bed-"+bed_id).remove();
            },
            error:function(data){
              console.log(data);
            }
        });
    });



    var maxGroup =20;
    var i=1;        
    //add more fields group
    $(".addMore").click(function(){         
        if(i < maxGroup){
            var fieldHTML =

           '<div class="row" id="f-'+i+'">'+
                '<div class="col-md-6">'+               
                    '<input type="text" name="new_amenity[]" placeholder="Amenities" class="form-control" required>'+
                '</div>'+                
                '<div class="col-md-2">'+
                    '<button class="btn btn-primary btn-sm addMore" onclick="remove('+i+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
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
    var maxGroupPhoto =20;
    var i_photo=1;        
    //add more fields group
    $(".addPhoto").click(function(){         
        if(i_photo < maxGroupPhoto){
            var fieldHTML =

           '<div class="row" id="photo-'+i_photo+'">'+
                '<div class="col-md-8">'+               
                    '<input type="file" id="image-upload" name="photos[]" class="form-control" required accept="image/*">'+
                '</div>'+                
                '<div class="col-md-2">'+
                    '<button class="btn btn-primary btn-sm addMore" onclick="removePhoto('+i_photo+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
                '</div>'+
            '</div>'; 
            
            $(".newPhoto").append(fieldHTML);
            i_photo++;
        }else{
            alert('Maximum '+maxGroupPhoto+' groups are allowed.');
        }
    });     
    
    function removePhoto(a){
        $("#photo-"+a).remove();
        i_photo--;
    }
    var maxBed =3;
    var i_bed=1;        
    //add more fields group
    $(".addBed").click(function(){         
        if(i_bed < maxBed){
            var fieldHTML =
           '<div class="row" id="bed-'+i_bed+'">'+
                 '<div class="col-md-3">'+
                   '<select class="form-control" name="new_bed_type_id[]">'+
                     '<option>Select Bed Type</option>'+
                     @foreach($bed_types as $bed_type)
                     '<option value="{{$bed_type->id}}">{{$bed_type->name}}</option>'+
                     @endforeach
                   '</select>'+
                 '</div>'+   
                '<div class="col-md-3">'+               
                    '<input type="text" name="new_bed_number[]" class="form-control" placeholder="number of bed" required>'+
                '</div>'+    
                '<div class="col-md-2">'+               
                    '<input type="number" name="new_adult[]" class="form-control" placeholder="Adult" required>'+
                '</div>'+ 
                '<div class="col-md-2">'+               
                    '<input type="number" name="new_child[]" class="form-control" placeholder="Child" required>'+
                '</div>'+                            
                '<div class="col-md-1">'+
                    '<button class="btn btn-primary btn-sm addMore" onclick="removeBed('+i_bed+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
                '</div>'+
            '</div>'; 
            
            $(".newBed").append(fieldHTML);
            i_bed++;
        }else{
            alert('Maximum '+maxBed+' groups are allowed.');
        }
    });     
    
    function removeBed(a){
        $("#bed-"+a).remove();
        i_bed--;
    }

    
</script>
<script type="text/javascript">  
    CKEDITOR.replace('description' );  
    CKEDITOR.config.toolbar = [
       ['Styles','Format','Font','FontSize','Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ];
</script> 
@endsection
