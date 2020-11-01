@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Collection</h5>
            </div>
            <div class="card-body">
            	@include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_edit_collections',['id'=>$collection->id])}}" id="editCollection" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                                
                        <div class="form-group">
                            <label for="cname">Collection Name</label>                        
                            <input type="text" class="form-control" id="cname" placeholder="Collection Name" name="name" value="{{$collection->name}}">
                        </div>
                        <div class="form-group">
                            <label for="image">Collection Image</label>                        
                            <input type="file" class="form-control" id="image" name="image">
                            <div style="padding: 20px">
                                <img src="{{asset('uploads/vendor/collections/263x160/'.$collection->image)}}" width="120px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>                        
                            <textarea class="form-control" name="description" placeholder="Collection Description ...">{{$collection->description}}</textarea>                        
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status" required="">
                                <option value="">Select Status</option>
                                <option value="1" {{$collection->status=1?'selected':''}}>Active</option>
                                <option value="0" {{$collection->status=0?'selected':''}}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
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
$("#editCollection").validate({
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