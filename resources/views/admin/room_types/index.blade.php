@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Service Types
                <a href="{{route('admin.get_create_room_type')}}" class="pull-right btn  btn-success">Add Service Type</a>
                </h5>
                <br>
            </div>
            <div class="card-body">
            @include('layouts.admin.snippets.msg')
            <table id="room_types" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Created At</th>   
                        <th>Action</th>                             
                    </tr>  
                    </thead>
                    <tbody>                  
                    @foreach($room_types as $index=>$type)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$type->name}}</td>
                        <td>{{$type->slug}}</td>  
                        <td>                                    
                            <img src="{{asset($type->icon)}}" style="width:100px;">
                        </td>
                        <td>
                            @if($type->status=="active")
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-info">Inactive</span>
                            @endif
                        </td>
                        <td>{{$type->created_at}}</td>
                        <td>
                           <a href="{{route('admin.get_edit_room_type',['slug'=>$type->slug])}}" class="btn btn-sm btn-success"><i class="ion-ios-compose-outline"></i></a> 
                           <a href="{{route('admin.get_delete_room_type',['slug'=>$type->slug])}}" class="btn btn-sm btn-danger"><i class="ion-ios-trash-outline"></i></a>                         
                        </td>                           
                    </tr>
                    @endforeach
                
                </tbody>
                    
            </table>                      
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#room_types').DataTable();
</script>
@endsection