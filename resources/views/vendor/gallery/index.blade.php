@extends('layouts.vendor.index')
@section('content')
<div id="content" class="loading_wrapper"></div>
@endsection
@section('modal')
<div class="modal fade" id="addPhoto">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5>Add Photo</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{route('vendor.post_gallery')}}" id="addPhotoForm" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-4">                  
                <input type="file" id="image-upload" name="photo[]" class="form-control" accept="image/*">
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
                <button class="btn btn-sm btn-success addMore" type="button"><i class="ion-ios-plus-outline"></i></button>
            </div>
          </div>  
          <div class="newField"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
        <h5>Edit Photo</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="editPhotoBody">
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	loadData();
	function loadData(){
		$.ajax({
		    type: "get",
		    url: "{{route('vendor.get_gallery')}}",
		    data: "",
		    cache: false,
		    beforeSend: function() {
		        $(".loading_wrapper").addClass('loading');         
		    },
		    success: function (data){
		    	$(".loading_wrapper").removeClass('loading'); 
		    	$("#content").html(data);
	        },
	        error:function(data){
	        	console.log(data);
	        }
	    });
	}
	function deletePhoto(i){
	   $.ajax({
	       type:'POST',
	       url: "{{route('vendor.delete_gallery')}}",
	       data:{"id":i}, 
	       dataType:'json',         
	       success:function(data){
	           toastr.success(data.message);
	           loadData();
	       },
	       error: function(data){
	           console.log("error");
	           console.log(data);
	       }
	   });    
	}
	var maxGroup = 10;
	var i=1;        
	//add more fields group
	$(".addMore").click(function(){         
	    if(i < maxGroup){
	        var fieldHTML =

	       '<div class="row" id="f-'+i+'">'+
	            '<div class="col-md-4">'+               
	                '<input type="file" id="image-upload" name="photo[]" class="form-control" accept="image/*">'+
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
	                '<button class="btn btn-sm btn-danger" onclick="remove('+i+')" type="button"><i class="ion-ios-trash-outline"></i></button>'+
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
	//Add Photos
	$('#addPhotoForm').on('submit',(function(e) {
		$("#submitBtn").attr('disabled','disabled');
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
	        beforeSend: function() {
	            $(".loading_wrapper").addClass('loading');         
	        },         
	        success:function(data){
	        	$(".loading_wrapper").removeClass('loading'); 
	        	$("#submitBtn").attr('disabled',false); 
	        	$('#addPhotoForm')[0].reset();
	            $("#addPhoto").modal('hide');
	            toastr.success(data.message);
	            loadData();
	        },
	        error: function(data){
	            console.log("error");
	            console.log(data);
	        }
	    });
	}));
	$(document).on('click','.edit-btn',function(){
	    $("#editPhoto").modal('show');
	    var id=$(this).attr('data-p-id');
	    $.ajax({
	        type:'GET',
	        url: "{{route('vendor.get_edit_gallery')}}", 
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
	$(document).on('submit','#editPhotoForm',function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var file_data = $('#image').prop('files')[0];                       
		formData.append('file', file_data);
		$.ajax({
		    type:'POST',
		    url: $(this).attr('action'),
		    data:formData,  
		    cache:false,
		    contentType: false,
		    processData: false, 
		    dataType:'json',          
		    success:function(data){
		    	$('#editPhotoForm')[0].reset();
		        $("#editPhoto").modal('hide');
		        toastr.success(data.message);
		        loadData();
		    },
		    error: function(data){
		        console.log("error");
		        console.log(data);
		    }
		});
	});
</script>
@endsection






