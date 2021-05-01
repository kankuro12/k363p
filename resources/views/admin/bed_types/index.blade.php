@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Bed Types
                <a href="{{route('admin.get_create_bed_type')}}" class="pull-right btn btn-success">Add Bed Type</a>
                </h5>
            </div>
            <div class="card-body">
            @include('layouts.admin.snippets.msg')
            <table id="bed_types" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Bed Type Name</th>
                        <th>Slug</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Created At</th>   
                        <th>Action</th>                             
                    </tr>  
                    </thead>
                    <tbody>                  
                    @foreach($bed_types as $index=>$type)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$type->name}}</td>
                        <td>{{$type->slug}}</td>  
                        <td>                                    
                            <img src="{{asset($type->icon)}}">
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
                           <a href="{{route('admin.get_edit_bed_type',['slug'=>$type->slug])}}" class="btn btn-sm btn-success"><i class="ion-ios-compose-outline"></i></a> 
                           <a href="{{route('admin.get_delete_bed_type',['slug'=>$type->slug])}}" class="btn btn-sm btn-primary"><i class="ion-ios-trash-outline"></i></a>                         
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
$('#bed_types').DataTable();
</script>
@endsection