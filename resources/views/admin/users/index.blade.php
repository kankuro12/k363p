@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Users</h5>              
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="users" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Profile Pic</th>                                
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>Created At</th>   
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index=>$user)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$user->fname." ".$user->lname}}</td>
                                <td>
                                    <img src="{{asset('uploads/user/profile_img/'.$user->profile_img)}}" style="max-width: 100px;" class="img-circle">
                                </td>
                                <td>
                                    {{$user->user->email}}                                   
                                </td>                                
                                <td>
                                    {{$user->mobile_number}}                                   
                                </td>
                                <td>
                                    @if($user->user->active=="1")
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-info">Inactive</span>
                                    @endif
                                </td> 
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.show_user',['id'=>$user->id])}}"  class="btn btn-success btn-sm"><i class="ion-ios-eye-outline"></i></a>                                    
                                </td>
                            </tr>
                            @endforeach
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
$('#users').DataTable();
</script>
@endsection


