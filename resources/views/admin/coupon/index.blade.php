@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h5>All Coupons({{$coupons->count()}})
                	<!-- <a href="{{route('admin.add-coupon')}}" class="btn btn-warning pull-right">Add New Coupon</a> -->
              <br>
                </h5>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="coupons" class="table table-bordered">
                        <thead>
                            <tr>
                            	<th>S.N.</th>
                                <th>Coupon Code</th>
                                <th>Coupon Name</th>
                                <th>Started From</th>
                                <th>End To</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($coupons as $index=>$coupon)
                                <tr>
                                	<td>{{$index+1}}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->start_time }}</td>
                                    <td>{{ $coupon->end_time }}</td>
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
$('#coupons').DataTable();
</script>
@endsection


