@extends('layouts.vendor.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Reviews</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="reviews" class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>U.Name</th>
                                <th>R.Title</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Time</th>  
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $index=>$rv)
                        <tr>       
                            <td>{{$index+1}}</td> 
                        	<td style="text-align: center;">
                                
                                <img src="{{asset('uploads/user/profile_img/200x200/'.$rv->vendor_user->profile_img)}}" class="img-circle" width="50px"><br>
                                {{$rv->vendor_user->fname." ".$rv->vendor_user->lname}}

                            </td>
                        	<td>{{$rv->review_title}}</td>
                            <td>
                                {{$rv->all_rating()}}
                            </td>
                        	<td>
                             @if($rv->status=="approved")
                             <span class="label label-success">Approved</span>
                             @else
                             <span class="label label-info">UnApproved</span>
                             @endif   
                            </td>
                        	<td>{{$rv->created_at->toFormattedDateString()}}</td>
                            <td>
                                <a href="{{route('vendor.review',['id'=>$rv->id])}}" class="btn btn-info btn-sm">View</a>
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
@section('scripts')
<script>
$('#reviews').DataTable();
</script>
@endsection