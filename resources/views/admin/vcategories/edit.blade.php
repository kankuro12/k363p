@extends('layouts.admin.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Edit Vendor Category</h5>
      </div>
      <div class="card-body">
        @include('layouts.admin.snippets.error')
        <form method="post" action="{{route('admin.post_edit_categories',['slug'=>$category->slug])}}" id="editCategory">
            @csrf
            <div class="card-body">
                
                <div class="form-group">
                    <label for="fname">Category Name</label>                        
                    <input type="text" class="form-control" id="name" placeholder="Category Name" name="name" value="{{$category->name}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>                        
                    <textarea class="form-control" name="description" placeholder="Category Description ...">{{$category->description}}</textarea>                        
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required="">
                        <option>Select Status</option>
                        <option value="active" {{$category->status=="active"?'selected':''}}>Active</option>
                        <option value="inactive" {{$category->status=="inactive"?'selected':''}}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </div>
            </div>
        </form>   
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $("#editCategory").validate({
            rules: {
                name: "required",                
                status: "required"
            },
            messages: {
                name: "Please enter category name",
                status: "Please select a status"
            }
});
</script>
@endsection