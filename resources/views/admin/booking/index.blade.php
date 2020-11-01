@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Bookings</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form >
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select class="form-control">
                                                <option value="">Select vendor</option>
                                                @foreach($vendors as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Booking Status</label>
                                            <select class="form-control">
                                                <option value="">Select Booking Status</option>
                                                <option>Pending</option>
                                                <option>Confirmed</option>
                                                <option>Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Status</label>
                                            <select class="form-control">
                                                <option value="">Select Payment Status</option>
                                                <option>Paid</option>
                                                <option>Unpaid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" name="check_in_time" class="form-control">
                                    </div>
                                </div>
                                    <div class="col-md-4"><div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" name="check_out_time" class="form-control">
                                    </div></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <br>
                                            <button class="btn btn-default">Search</button>
                                            <a href="" class="btn btn-danger">Clear</a>
                                        </div>
                                    </div>
                                </div>
                               
                                
                               
                            </form>
                        </div>
                    </div>

                    <hr>
                    <table id="bookings" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Vendor</th>
                                <th>Package</th>
                                <th>Booking Status</th>
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($bookings as $index=>$booking)
                        	<tr>
                        		<td>{{$index+1}}</td>
                        		<td>{{$booking->first_name." ".$booking->last_name}}</td>
                        		<td>{{$booking->email}}</td>
                        		<th>{{$booking->room->vendor->name}}</th>
                        		<th>{{$booking->room->name}}</th>
                                <td>{{$booking->booking_status}}</td>
                        		<td>
                        		   <a href="{{route('admin.invoice',['id'=>$booking->id])}}" class="btn btn-info">View Invoice</a>	                        		
                        		</td>
                        	</tr>
                        	@endforeach
                        </tbody>                           
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('styles')
<link href="{{asset('assets/admin/assets/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('scripts')
<script src="{{asset('assets/admin/assets/datatable/datatables.min.js')}}"></script>
<script>
$('#bookings').DataTable();
</script>
@endsection


