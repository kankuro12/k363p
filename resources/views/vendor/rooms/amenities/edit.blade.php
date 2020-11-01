@extends('layouts.vendor.index')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Amenities</h4>
                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addAm">Add More Amenities</button>
                        <br>
                        <br>
                    </div>
                    <div class="content" id="mycontent">                        
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="addAm">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Amenity</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{route('vendor.post_edit_amenities_rooms',['id'=>$room->id])}}" id="addAmenitiesForm" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">                  
                <input type="text" id="image-upload" name="amenities[]" class="form-control" placeholder="Amenity">
            </div>            
            <div class="col-md-3">                  
                <select class="form-control" name="nstatus[]">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-success addMore" type="button"><i class="ti-plus"></i></button>
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
@endsection
@section('scripts')
<script type="text/javascript">
  var maxGroup = 10;
  var i=1;        
  //add more fields group
  $(".addMore").click(function(){         
      if(i < maxGroup){
          var fieldHTML =

         '<div class="row" id="f-'+i+'">'+
              '<div class="col-md-6">'+               
                  '<input type="text" placeholder="Amenity"  name="amenities[]" class="form-control">'+
              '</div>'+              
              '<div class="col-md-3">'+               
                  '<select class="form-control" name="nstatus[]">'+
                      '<option value="active">Active</option>'+
                      '<option value="inactive">Inactive</option>'+
                  '</select>'+
              '</div>'+
              '<div class="col-md-2">'+
                  '<button class="btn btn-danger addMore" onclick="remove('+i+')" type="button"><i class="ti-minus"></i></button>'+
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
  $(document).on('submit','#addAmenitiesForm',function(e){
    e.preventDefault();
    var data=$(this).serialize();
    var url=$(this).attr('action'); 
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (data) {   
            $('#addAmenitiesForm')[0].reset();
            $("#addAm").modal('hide');
            $("body").removeClass('loading');                  
            toastr.success(data.message); 
            loadData();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
  });
  loadData();
  function loadData(){
    $.ajax({
        type: "get",
        url: "{{route('vendor.get_edit_amenities_rooms',['id'=>$room->id])}}",
        data: "",
        cache: false,
        beforeSend: function() {
            $("body").addClass('loading');         
        },
        success: function (data){
          $("body").removeClass('loading'); 
          $("#mycontent").html(data);
          },
          error:function(data){
            console.log(data);
          }
      });
  }
  $(document).on('click','.delete',function(e){
    e.preventDefault();
    var id=$(this).attr('data-id');
    $.ajax({
        type: "post",
        url: "{{route('vendor.delete_amenities_rooms',['id'=>$room->id])}}",
        data: {id:id},
        beforeSend: function() {
            $("body").addClass('loading');         
        },
        success: function (data){
          $("body").removeClass('loading'); 
          toastr.success(data.message);
          loadData();
          },
          error:function(data){
            console.log(data);
          }
      });
  });
  $(document).on('submit','#editAmenities',function(e){
    e.preventDefault();
    var data=$(this).serialize();
    $.ajax({
        type: "post",
        url: "{{route('vendor.update_amenities_rooms',['id'=>$room->id])}}",
        data: data,
        beforeSend: function() {
            $("body").addClass('loading');         
        },
        success: function (data){
          $("body").removeClass('loading'); 
          toastr.success(data.message);
          loadData();
          location.href=data.redirect_url;
          },
          error:function(data){
            console.log(data);
          }
      });
  });
</script>
@endsection