@extends('layouts.admin.index')
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
                                <th>V.Name</th>
                                <th>U.Name</th>
                                <th>R.Title</th>
                                <th>Status</th>
                                <th>Time</th>   
                                <th>Action</th> 
                                <th>View</th>                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $index=>$rv)
                        <tr>       
                            <td>{{$index+1}}</td>                 	
                        	<td>{{$rv->vendor->name}}</td>
                        	<td>{{$rv->vendor_user->fname." ".$rv->vendor_user->lname}}</td>
                        	<td>{{$rv->review_title}}</td>
                        	<td id="status{{$rv->id}}">
                             @if($rv->status=="approved")
                             <span class="label label-success">Approved</span>
                             @else
                             <span class="label label-info">UnApproved</span>
                             @endif   
                            </td>
                        	<td>{{$rv->created_at->toFormattedDateString()}}</td>
                        	<td>                                
                                <input type="checkbox" data-rvid="{{$rv->id}}" class="change_status" {{$rv->status=="approved"?'checked':''}}>  		
                        	</td>
                            <td><a href="{{route('admin.show_reviews',['id'=>$rv->id])}}" class="btn btn-sm btn-default">view</a></td>
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
$(document).on('change','.change_status',function(e){
    e.preventDefault();
    var rvid=$(this).attr('data-rvid');
        $.ajax({
            type: "post",
            url: "{{route('admin.change_review_status')}}",
            data: {'rvid':rvid},
            cache: false,
            beforeSend: function() {
                //$("body").addClass('loading');         
            },
            success: function (data){
                if(data.rs=="approved"){
                    $(this).prop('checked',true);
                    $("#status"+rvid).html('<span class="label label-success">Approved</span>');
                }else{
                    $(this).prop('checked',false);
                    $("#status"+rvid).html('<span class="label label-info">UnApproved</span>');
                }
                toastr.success(data.message);
            },
            error:function(data){
                console.log(data);
            }
        });
})
</script>
@endsection