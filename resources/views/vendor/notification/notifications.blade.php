@extends('layouts.vendor.index')
@section('content')
@if($data->count()>0)
<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="card">
	        <div class="card-header">
	            <h4 class="title">Notifications</h4>              
	        </div>
	        <div class="card-body">
	        	<div class="content table-responsive table-full-width"> 
	        		@foreach($data as $d)
                    <div class="panel {{$d['read_at']?'panel-default':'panel-primary'}}">
                    	<div class="panel-heading">
                    		{{$d->data['title']}}
                    	</div>
                    	<div class="panel-body">
                    		{{$d->data['detail']?$d->data['detail']:''}}
                    	</div>
                    	<div class="panel-footer">
                    		<a class="btn btb-info btn-sm" href="{{$d->data['link']?$d->data['link']:''}}">View</a>
                    	</div>
                    </div> 
                    @endforeach 
                    {{$data->links()}}     
            	</div>
	        </div>
	    </div>
	</div>
</div>
@endif

@endsection