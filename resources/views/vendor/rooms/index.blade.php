@extends('layouts.vendor.index')

@section('content')
<div id="content" class="loading_wrapper"></div>
@endsection
@section('scripts')
<script type="text/javascript">
	loadData();
	function loadData(){
		$.ajax({
		    type: "get",
		    url: "{{route('vendor.get_rooms')}}",
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
	$(document).on('click','.delete_room',function(e){
		e.preventDefault();
		var room_id=$(this).attr('data-room-id');
		$.ajax({
		    type: "post",
		    url: "{{route('vendor.delete_room')}}",
		    data: {"room_id":room_id},
		    cache: false,
		    beforeSend: function() {
		        $(".loading_wrapper").addClass('loading');         
		    },
		    success: function (data){
		    	$(".loading_wrapper").removeClass('loading'); 
		    	toastr.success(data.msg);
		    	loadData();
	        },
	        error:function(data){
	        	console.log(data);
	        }
	    });

	});
</script>
@endsection
