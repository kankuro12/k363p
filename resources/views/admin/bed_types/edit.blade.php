@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Bed Type</h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_edit_bed_type',['slug'=>$bed_type->slug])}}" id="editType" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                        
                        <div class="form-group">
                            <label for="name">Room Type Name</label>                        
                            <input type="text" class="form-control" id="name" placeholder="Bed Type Name" name="name" value="{{$bed_type->name}}">
                        </div>   
                        <div class="form-group">
                            <label for="name">Icon</label>                        
                            <input type="file" class="form-control" id="file" name="icon">
                            <div style="padding: 20px;">
                            	<img src="{{asset('uploads/vendor/bed_type/icons/'.$bed_type->icon)}}">
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required="">
                                <option value="">Select Status</option>
                                <option value="active" {{$bed_type->status=='active'?'selected':''}}>Active</option>
                                <option value="inactive" {{$bed_type->status=='inactive'?'selected':''}}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primaray">Reset</button>
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
                name: "Please enter room type name",
                status: "Please select a status"                
            }
});
</script>
@endsection