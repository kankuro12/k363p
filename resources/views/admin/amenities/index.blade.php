@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Services
                  <a href="{{route('admin.get_create_amenities')}}" class="btn btn-success pull-right">Add Service</a>
                </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="amenities" class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>                                
                                <th>Service</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Created At</th>   
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($amenities as $index=>$amenity)
                            <tr>    
                                <td>{{$index+1}}</td>                            
                                <td>{{$amenity->name}}</td>
                                <td>                                    
                                    <img src="{{asset($amenity->icon)}}" class="img-responsive" width="50px">
                                </td>
                                <td>
                                    @if($amenity->status=="active")
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-info">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$amenity->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.get_edit_amenities',['slug'=>$amenity->slug])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                                    <a href="{{route('admin.get_delete_amenities',['slug'=>$amenity->slug])}}" class="btn btn-primary btn-sm"><i class="ion-ios-trash-outline"></i></a>
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
$('#amenities').DataTable();
</script>
@endsection