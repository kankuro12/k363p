@extends('layouts.vendor.index')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Photos</h4>
                        <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addPhoto">Add New Photos</button>
                    </div>
                    <div class="content">
                        <ul class="nav nav-pills">
                         
                        </ul>
                        <hr>
                        <div id="mycontent"></div>
                        
                    <button class="btn btn-primary" style="margin:10px 0;">Save</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('modal')
<!-- Modal -->
<div id="addPhoto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Photo</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('vendor.post_photos_rooms',['id'=>$room->id])}}" class="dropzone">
          @csrf
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection
<style type="text/css">
	.d-flex{
		display: flex;
		flex-wrap: wrap;

	}
	.edt-img-wrapper{
		width: 18%;
		border:2px solid #ccc;
		height: 120px;
		position: relative;
		overflow: hidden;
		margin-bottom:10px;
		margin-right: 15px;
	}
	.edt-img-wrapper img{
		width:100%;
		object-fit: cover;
		position: absolute;
		top:50%;
		left:50%;
		transform: translate(-50%,-50%);
	}
	.del-img{
		position: absolute;
		top:8px;
		right: 8px;
		height: 20px;
		width: 20px;
		line-height: 14px !important;
		padding: 0 !important;
		border-radius: 50% !important;
		background-color: #fff;

	}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/assets/css/dropzone.css')}}">
@section('scripts')
<script type="text/javascript">
	loadData();
	function loadData(){
	  $.ajax({
	      type: "get",
	      url: "{{route('vendor.get_edit_photos_rooms',['id'=>$room->id])}}",
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
	$(document).on('click','.del-img',function(e){
		e.preventDefault();
		var id=$(this).attr('data-img-id');
		$.ajax({
	      type: "post",
	      url: "{{route('vendor.get_delete_photos_rooms',['id'=>$room->id])}}",
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
	$('#addPhoto').on('hidden.bs.modal', function () {
	    loadData();
	});

</script>
<script src="{{asset('assets/vendor/assets/js/dropzone.js')}}"></script>
@endsection


