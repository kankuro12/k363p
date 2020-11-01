@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
            <h5>Members
                <a href="{{route('admin.get_create_members')}}" class="btn btn-success pull-right">Add Member</a>
            </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="members" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email address</th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Created At</th>   
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($members as $index=>$member)
                        	<tr>
                        		<td>{{$index+1}}</td>
                        		<td>{{$member->name}}</td>
                        		<td>{{$member->email}}</td>
                        		<td><img src="{{asset('uploads/admin/avatars/200x200/'.$member->avatar)}}" height="100px;"></td>
                        		<td>{{$member->active==1?'Active':'Inactive'}}</td>
                        		<td>{{$member->created_at}}</td>
                        		<td>
	                        		<a href="{{route('admin.get_edit_members',['id'=>$member->id])}}" class="btn btn-info btn-sm"><i class="ion-ios-compose"></i></a>
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
$('#members').DataTable();
</script>
@endsection


