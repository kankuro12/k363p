@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Create New Collection</h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_create_collections')}}" id="addCollection" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                                
                        <div class="form-group">
                            <label for="cname">Collection Name</label>                        
                            <input type="text" class="form-control" id="cname" placeholder="Collection Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="image">Collection Image</label>                        
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>                        
                            <textarea class="form-control" name="description" placeholder="Collection Description ..."></textarea>                        
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status" required="">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
<script type="text/javascript">
$("#addCollection").validate({
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