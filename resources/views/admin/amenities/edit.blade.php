@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Edit Service</h5>
            </div>
            <div class="content">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.edit_post_amenities',['slug'=>$amenity->slug])}}" enctype="multipart/form-data" id="editAmenity">
                    @csrf
                    <div class="card-body">                        
                        <div class="form-group">
                            <label for="fname">Service Name</label>                        
                            <input type="text" class="form-control" id="name" placeholder="Service Name" name="name" value="{{$amenity->name}}">
                        </div>
                        <div class="form-group">
                            <label for="icon">Service Icon</label>                        
                            <input type="file" class="form-control" id="icon" name="icon">
                            <div style="padding:10px;">
                               <img src="{{asset($amenity->icon)}}" height="50px;">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Select Status</label>
                            <select class="form-control" name="status" required="">
                                <option>Select Status</option>
                                <option value="active" {{$amenity->status=="active"?'selected':''}}>Active</option>
                                <option value="inactive" {{$amenity->status=="inactive"?'selected':''}}>Inactive</option>
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
    $("#editAmenity").validate({
            rules: {
                name: "required",
                status: "required"
            },
            messages: {
                name: "Please enter amenity name",
                status: "Please select a status"                
            }
});
</script>
@endsection