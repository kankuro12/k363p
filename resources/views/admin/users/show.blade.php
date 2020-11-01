@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    <div class="panel panel-default">
                        <div class="panel-heading">Basic Details</div>
                        <div class="panel-body">
                            <ul>
                                <li>Name:{{$user->fname. " ".$user->lname}}</li>
                                <li>Email Address:{{$user->user->email}}</li>
                                <li>Mobile number:{{$user->mobile_number?$user->mobile_number:'N/A'}}</li>                       
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Booking Details</div>
                        <div class="panel-body">
                            <table id="bookings" class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Hotel</th>
                                        <th>Room</th>                                
                                        <th>Payment Status</th>
                                        <th>Booking Status</th>                               
                                        <th>Created At</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->bookings as $i=>$b)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$b->vendor->name}}</td>
                                        <td>{{$b->room->name}}</td>
                                        <td>{{$b->payment_status}}</td>
                                        <td>{{$b->booking_status}}</td>
                                        <td>{{$b->created_at}}</td>
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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


