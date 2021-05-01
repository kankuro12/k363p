@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Collections</h5>
              <a href="{{route('admin.get_create_collections')}}" class="btn btn-success pull-right">Add New Collection</a>
              <br>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="collections" class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Collection Name</th>
                                <th>Collection Image</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>   
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collections as $index=>$collection)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$collection->name}}&nbsp;<span class="badge badge-info">{{$collection->collectionvendors->count()}}</span></td>
                                <td><img src="{{asset($collection->image)}}" width="120px"></td>
                                <td>{{$collection->slug}}</td>
                                <td>
                                    @if($collection->status=="1")
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-info">Inactive</span>
                                    @endif
                                </td> 
                                <td>{{$collection->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.get_manage_product',['id'=>$collection->id])}}" class="btn btn-success btn-sm"><i class="ion-android-settings"></i></a>
                                    <a href="{{route('admin.get_edit_collections',['id'=>$collection->id])}}" class="btn btn-info btn-sm"><i class="ion-ios-compose-outline"></i></a>
                                    <a href="{{route('admin.get_destroy_collections',['id'=>$collection->id])}}" class="btn btn-danger btn-sm"><i class="ion-ios-trash-outline"></i></a>
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
$('#collections').DataTable();
</script>
@endsection


