@extends('layouts.vendor.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h5>Manage Coupan</h5>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    @include('layouts.vendor.snippets.msg')
                    <form action="{{ route('vendor.post_assign_coupon',['id'=>$coupon->id]) }}" method="post">
                    	@csrf
                    	<div class="row">
                    	    <div class="col-md-6">
                    	        <div class="form-group label-floating">
                    	            <label class="control-label">Coupon Name</label>
                    	            <input type="text" class="form-control" name="coupon_name" value="{{$coupon->coupon_name}}" disabled="disabled">
                    	        </div>
                    	    </div>
                    	    <div class="col-md-6">
                    	        <div class="form-group label-floating">
                    	            <label class="control-label">Coupon code</label>
                    	            <input type="text" class="form-control" name="coupon_code" value="{{$coupon->coupon_code}}" disabled="disabled">
                    	        </div>
                    	    </div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-12">
                    			<table class="table table-bordered">
                    			    <thead>
                    			      <tr>
                    			      	<th>S.N.</th>
                    			        <th>Room</th>
                    			        <th>Coupon Status</th>                    			        
                    			      </tr>
                    			    </thead>
                    			    <tbody>
                    			    @foreach($rooms as $index=>$room)
                    			      <tr>  
                    			        <td>{{$index+1}}</td>                			        
                    			        <td>{{$room->name}}</td>
                    			        <td>
                    			        	<select name="coupon_status[]">
                    			        		<option value="{{$coupon->id}}" {{$room->coupon_enabled==$coupon->id?'selected':''}}>Enabled</option>
                    			        		<option value="0"
                    			        		@if(!$room->coupon_enabled)
                    			        		selected
                    			        		@else
                    			        		{{$room->coupon_enabled==$coupon->id?'':'selected'}}
                    			        		@endif
                    			        		>Disabled</option>
                    			        	</select>
                    			        	<input type="hidden" name="room_id[]" value="{{$room->id}}">
                    			        </td>
                    			      </tr>
                    			    @endforeach                    			      
                    			    </tbody>
                    			  </table>
                    		</div>
                    		
                    	</div>
                    	<div class="row">
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	            <button type="submit" class="btn btn-primary btn-rounded">Save</button>
                    	            <button type="reset" class="btn btn-danger btn-rounded">Reset</button>
                    	        </div>
                    	    </div>
                    	</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection