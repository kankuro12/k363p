@extends('layouts.vendor.index')

@section('content')
<div class="row">
  <div class="col-md-12">
    <form id="basic-details-form" method="post" action="{{route('vendor.post_create_rooms')}}" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header">Basic Details</div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Package Name</label>
                    <input type="text" class="form-control border-input" placeholder="Enter Package name" value="" name="name">
                </div>
            </div>   
            <div class="col-md-4">
                <div class="form-group">
                    <label>Price(In Rs.)</label>
                    <input type="number" class="form-control border-input" placeholder="Price" name="price">
                </div>
            </div>                                         
        </div> 
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>Discount Percentage</label>
                  <input type="number" class="form-control border-input" placeholder="Discount" name="discount">
              </div>
          </div> 
          <div class="col-md-4">
              <div class="form-group">
                  <label>Package Type</label>
                  <select class="form-control" name="roomtype_id">
                      <option value="">Select Package Type</option>
                      @foreach($room_types as $room_type)
                      <option value="{{$room_type->id}}">{{$room_type->name}}</option>
                      @endforeach
                  </select>
              </div>
          </div> 
          <div class="col-md-4">
              <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                      <option value="">Select Package Status</option>
                      <option value="Available">Available</option>
                      <option value="UnAvailable">UnAvailable</option>
                  </select>
              </div>
          </div>  
        </div>

      </div>
    </div>
    <div class="card">
      <div class="card-header">Photo Galleries</div>
      <div class="card-body">
        <div class="row">                                    
            <div class="col-md-8">                                        
                <input type='file' id="image-upload" name="photos[]" class="up form-control" required="required" multiple accept="image/*" />
            </div>
            <div class="col-md-4">
               <button class="btn btn-success btn-sm addPhoto" type="button"><i class="ion-ios-plus-outline"></i></button>
            </div>
        </div>
        <div class="newPhoto"></div>      
        <br><small>Press <i class="ion-ios-plus-outline"></i> to add another form field :)</small>      
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        Services Included in package
      </div>
      <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              
              <input type="text" name="amenity[]" class="form-control" placeholder="Services" required="required">
            </div>
            <div class="col-md-4">
              <button class="btn btn-sm btn-success addMore" type="button"><i class="ion-ios-plus-outline"></i></button>
            </div>
          </div> 
          <div class="newField"></div>
          <br><small>Press <i class="ion-ios-plus-outline"></i> to add another form field :)</small>       
      </div>
    </div>
    {{-- <div class="card">
      <div class="card-header">
        Bed Details
      </div>
      <div class="card-body">
          <div class="row">  
              <div class="col-md-3">
                <label>Select Bed Type</label>
                <select class="form-control" name="bed_type_id[]">
                  <option value="">Select Bed Type</option>
                  @foreach($bed_types as $bed_type)
                  <option value="{{$bed_type->id}}" data-id="{{$bed_type->id}}" data-name="{{$bed_type->name}}">{{$bed_type->name}}</option>
                  @endforeach
                </select>
              </div>                                
              <div class="col-md-3">
                  <label>Number of Bed</label>                                        
                  <input type='number' name="bed_number[]" placeholder="Enter number of bed" class="form-control" required="required" value="1" />
              </div>                                   
              <div class="col-md-2">  
                  <label>Number of Adults</label>             
                  <input type="number" name="adult[]" class="form-control" placeholder="Adult" required>
              </div>
              <div class="col-md-2">
                  <label>Number of Childs</label>               
                  <input type="number" name="child[]" class="form-control" placeholder="Children" value="0" required>
              </div>
              <div class="col-md-1">
                 <button class="btn btn-sm btn-success addBed" type="button"><i class="ion-ios-plus-outline"></i></button>
              </div>
          </div>
          <div class="newBed"></div>
          <br><small>Press <i class="ion-ios-plus-outline"></i> to add another form field :)</small>       
      </div>
    </div>
    <div class="card">
      <div class="card-header">
       Room Number Details
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
                <label>Number of Room</label>
                <input type="text" id="roomNumSelector" class="form-control border-input" placeholder="Enter number of room" name="no_of_rooms">
            </div>
          </div>
        </div>
        <div id="roomNum"></div>  
      </div>
    </div> --}}
    <div class="card">
      <div class="card-header">
        Package Description
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <textarea rows="10" name="description" class="form-control">{{old('description')}}</textarea>
          </div>
        </div>        
      </div>
    </div>
    <div>
        <button type="submit" id="submitBtn" class="btn btn-info btn-fill btn-wd">Save</button>
        <button type="reset" class="btn btn-primary btn-wd btn-fill">Reset</button>
    </div>
    </form>   
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    var maxGroup =20;
    var i=1;        
    //add more fields group
    $(".addMore").click(function(){         
        if(i < maxGroup){
            var fieldHTML =

           '<div class="row" id="f-'+i+'">'+
                '<div class="col-md-8">'+               
                    '<input type="text" name="amenity[]" placeholder="Amenities" class="form-control" required>'+
                '</div>'+                
                '<div class="col-md-3">'+
                    '<button class="btn btn-sm btn-primary addMore" onclick="remove('+i+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
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
    //ameenity
    $(document).on('submit','#addAmenities',function(e){
      e.preventDefault();
      var data=$(this).serialize();
      var url=$(this).attr('action');
      var method=$(this).attr('method');
      $.ajax({
           url: url,
           type: method,
           data: data,
           success: function(response) {                       
              $("#addAmenities")[0].reset();
              location.href=response.redirect_url;
           }            
       });
      
    });
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
          alert(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $(".myimage").change(function() {
      readURL(this);
    });
    var maxGroupPhoto =20;
    var i_photo=1;        
    //add more fields group
    $(".addPhoto").click(function(){         
        if(i_photo < maxGroupPhoto){
            var fieldHTML =

           '<div class="row" id="photo-'+i_photo+'">'+
                '<div class="col-md-8">'+               
                    '<input type="file" name="photos[]" id="image-upload" class="up form-control" multiple required accept="image/*">'+
                '</div>'+                
                '<div class="col-md-2">'+
                    '<button class="btn btn-sm btn-primary addMore" onclick="removePhoto('+i_photo+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
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
        i--;
    }
    var maxBed =3;
    var i_bed=1;        
    //add more fields group
    $(".addBed").click(function(){         
        if(i_bed < maxBed){
            var fieldHTML =
           '<div class="row" id="bed-'+i_bed+'">'+
                 '<div class="col-md-3">'+
                   '<select class="form-control" name="bed_type_id[]">'+
                     '<option>Select Bed Type</option>'+
                     @foreach($bed_types as $bed_type)
                     '<option value="{{$bed_type->id}}">{{$bed_type->name}}</option>'+
                     @endforeach
                   '</select>'+
                 '</div>'+   
                '<div class="col-md-3">'+               
                    '<input type="text" name="bed_number[]" class="form-control" placeholder="number of bed" required>'+
                '</div>'+
                '<div class="col-md-2">'+               
                    '<input type="number" name="adult[]" class="form-control" placeholder="Adult" required>'+
                '</div>'+ 
                '<div class="col-md-2">'+               
                    '<input type="number" name="child[]" class="form-control" placeholder="Child" required>'+
                '</div>'+                
                '<div class="col-md-1">'+
                    '<button class="btn btn-sm btn-primary" onclick="removeBed('+i_bed+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
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
  $("#roomNumSelector").change(function() {
    $("#roomNum").html("");
    var len = $(this).val();
    var htmlString="";
    for (var i = 0; i < len; i++) {
      
      htmlString+='<div class="row">'+
      '          <div class="col-md-5">'+
      '            <div class="form-group">'+
      '              <label>Room Number</label>'+
      '              <input type="text" name="room_number[]" class="form-control" placeholder="Eg.BG1200">'+
      '            </div>'+
      '          </div>'+
      '        </div>';
        

    }
    $("#roomNum").html(htmlString);
  });
</script>
<script type="text/javascript">  
    CKEDITOR.replace('description' );  
    CKEDITOR.config.toolbar = [
       ['Styles','Format','Font','FontSize','Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ];
</script>   
<script type="text/javascript">
    $(document).ready(function(){
       $("#basic-details-formb").validate({
           ignore: [],
            rules: {
               name: {
                   required: true,
                   minlength: 4
               },
              
               roomtype_id: {
                   required: true,
               },
               amenity: {
                   required: true,
               },
              
              
               price:{
                   required:true
               },
               description:{
                    required:true
               },
               status:"required"   
               }, 
                    
               
            messages: {
                name: {
                    required: "Please enter Package name",
                    minlength: "Your room name must consist of at least 4 characters"
                },
                
                roomtype_id: {
                    required: "Please select room type",                    
                },
                price:{
                    required: "Please enter price", 
                },
                description: {
                    required: "Please enter description ",        
                },
                status:"Select status"

            }
        });

    });
</script>
@endsection