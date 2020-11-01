@extends('layouts.public.index')
@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="card">
	        <div class="header">
	            <h4 class="title"></h4>              
	        </div>
	        <div class="content">
	        	<div class="content table-responsive table-full-width"> 
                    <div class="panel panel-default">
                    	<div class="panel-heading">
                    		{{$data->data['title']}}
                    	</div>
                    	<div class="panel-body">
                    		{{$data->data['detail']?$data->data['detail']:''}}
                    	</div>
                    	<div class="panel-footer">
                    		<a class="btn btb-info btn-sm" href="{{$data->data['link']?$data->data['link']:''}}">View</a>
                    	</div>
                    </div>     
            	</div>
	        </div>
	    </div>
	</div>
</div>
@endsection