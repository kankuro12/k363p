@extends('layouts.vendor.index')
@section('content')
<div id="content"></div>
@endsection
@section('scripts')
<script type="text/javascript">
loadData();
function loadData(){
	$.ajax({
	    type: "get",
	    url: "{{route('vendor.get_amenities')}}",
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

$(document).on('change','.amenity',function(){
	var aid=$(this).attr('data-aid');
	$.ajax({
	    type: "post",
	    url: "{{route('vendor.change_amenity')}}",
	    data: {'aid':aid},
	    cache: false,
	    beforeSend: function() {
	        //$("body").addClass('loading');         
	    },
	    success: function (data){
	    	//$("body").removeClass('loading'); 
	    	//$("#content").html(data);
        },
        error:function(data){
        	console.log(data);
        }
    });

});
</script>
@endsection






