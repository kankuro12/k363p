@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Package Type</h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_edit_room_type',['slug'=>$room_type->slug])}}" id="editType" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                        
                        <div class="form-group">
                            <label for="name">Package Type Name</label>                        
                            <input type="text" class="form-control" id="name" placeholder="Package Type Name" name="name" value="{{$room_type->name}}">
                        </div>   
                        <div class="form-group">
                            <label for="name">Icon</label>                        
                            <input type="file" class="form-control" id="file" name="icon" accept="image/*">
                            <div style="padding: 20px;">
                            	<img src="{{asset($room_type->icon)}}">
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required="">
                                <option value="">Select Status</option>
                                <option value="active" {{$room_type->status=='active'?'selected':''}}>Active</option>
                                <option value="inactive" {{$room_type->status=='inactive'?'selected':''}}>Inactive</option>
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
    $("#editType").validate({
            rules: {
                name: "required",
                status: "required"
            },
            messages: {
                name: "Please enter package type name",
                status: "Please select a status"                
            }
});
</script>
@endsection