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
		    url: "{{route('vendor.get_privacy_policy')}}",
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
</script>
@endsection
