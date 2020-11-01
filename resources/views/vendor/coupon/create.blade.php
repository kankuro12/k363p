@extends('layouts.vendor.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h5>Add New Coupan</h5>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    @include('layouts.vendor.snippets.msg')
                    <form action="{{ route('vendor.insert-coupon') }}" method="post">
                    	@csrf
                    	<div class="row">
                    	    <div class="col-md-6">
                    	        <div class="form-group label-floating">
                    	            <label class="control-label">Coupon Name</label>
                    	            <input type="text" class="form-control" name="coupon_name">
                    	        </div>
                    	    </div>
                    	    <div class="col-md-6">
                    	        <div class="form-group label-floating">
                    	            <label class="control-label">Coupon code</label>
                    	            <input type="text" class="form-control" name="coupon_code">
                    	        </div>
                    	    </div>
                    	</div>

                    	<div class="row">
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="label-control">Start From</label>
                    	        <input type="date" class="form-control datepicker" name="start_date" value="2019-01-01" />
                    	        </div>
                    	    </div>
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="label-control">End Date</label>
                    	        <input type="date" class="form-control datepicker" name="end_date" value="2019-01-01" />
                    	        </div>
                    	    </div>
                    	</div>
                    	<div class="row">
                    	    <div class="col-md-8 pr-md-1">
                    	        <div class="form-group">
                    	            <label for="exampleFormControlSelect1">Discount Type</label>
                    	            <select class="selectpicker"  id="discount_type" name="discount_type" title="Discount Type" data-size="2" required="">
                    	            	<option value="">Select Discount Type</option>
                    	                <option value="1">Money Value</option>
                    	                <option value="2">Percentage Value</option>
                    	            </select>
                    	        </div>
                    	    </div>
                    	</div>
                    	<div class="row">
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="control-label">Discount Value</label>
                    	        <input type="text" class="form-control" name="discount_value" value="" id="discount_value" disabled/>
                    	        </div>
                    	    </div>
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="control-label">Discount Percentage %</label>
                    	        <input type="text" class="form-control" name="discount_percent" value="" id="discount_percent"disabled/>
                    	        </div>
                    	    </div>  
                    	</div>
                    	<div class="row">
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="control-label">Minimum order value to apply</label>
                    	        <input type="text" class="form-control" name="minimum_order_value" id="min_order"  disabled />
                    	        </div>
                    	    </div>
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="control-label">Maximum Discount</label>
                    	        <input type="text" class="form-control" name="maximum_discount" id="max_dis" disabled/>
                    	        </div>
                    	    </div>
                    	</div>
                    	<div class="row">
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	        <label class="control-label">Number of coupon to be issued</label>
                    	        <input type="text" class="form-control" name="issued_number_coupon" id="issued_no" disabled />
                    	        </div>
                    	    </div>
                    	    <div class="col-md-6 pr-md-1">
                    	        <div class="form-group label-floating">
                    	            <button type="submit" class="btn btn-primary btn-rounded">Save</button>
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
@section('scripts')
<script>
    // $('.datepicker').datetimepicker({
    //     format: 'YYYY-MM-DD',
    //     icons: {
    //         time: "fa fa-clock-o",
    //         date: "fa fa-calendar",
    //         up: "fa fa-chevron-up",
    //         down: "fa fa-chevron-down",
    //         previous: 'fa fa-chevron-left',
    //         next: 'fa fa-chevron-right',
    //         today: 'fa fa-screenshot',
    //         clear: 'fa fa-trash',
    //         close: 'fa fa-remove'
    //     }
    // });

    $('#discount_type').on('change',function(){
        //console.log('ohdarlingofmine');
        var typeid = document.getElementById('discount_type').value;
        //console.log(typeid);
        if (typeid == 1){
            document.getElementById('discount_value').disabled = false;
            document.getElementById('min_order').disabled = false;
            document.getElementById('issued_no').disabled = false;
            document.getElementById('limit_cust').disabled = false;
            document.getElementById('discount_percent').disabled = true;
            document.getElementById('max_dis').disabled = true;
            //console.log('Value Selected');
        }else{
            document.getElementById('discount_value').disabled = true;
            document.getElementById('min_order').disabled = false;
            document.getElementById('issued_no').disabled = false;
            document.getElementById('limit_cust').disabled = false;
            document.getElementById('discount_percent').disabled = false;
            document.getElementById('max_dis').disabled = false;
            //console.log('percent selected');
        }
    });
    
    </script> 
@endsection
