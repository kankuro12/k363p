@extends('layouts.admin.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Categories
        <a href="{{route('admin.get_create_categories')}}" class="btn btn-success pull-right">Add New Category</a>
        </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            @include('layouts.admin.snippets.msg')
            <table id="categories" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Created At</th>   
                        <th>Action</th>                             
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            @if($category->status=="active")
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-info">Inactive</span>
                            @endif
                        </td> 
                        <td>{{$category->created_at}}</td>
                        <td>
                            <a href="{{route('admin.get_edit_categories',['slug'=>$category->slug])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                            <a href="{{route('admin.delete_categories',['slug'=>$category->slug])}}" class="btn btn-primary btn-sm"><i class="ion-ios-trash-outline"></i></a>
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
@section('scripts')
$('#categories').DataTable();
</script>
@endsection