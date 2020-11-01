@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Service</h5>
            </div>
            <div class="content">
               <form method="post" action="{{route('admin.post_create_amenities')}}" enctype="multipart/form-data" id="addAmenity">
                @csrf
                   <div class="card-body">
                       <div class="form-group">
                           <label for="fname">Service Name</label>                        
                           <input type="text" class="form-control" id="name" placeholder="Service Name" name="name" value="{{old('name')}}">
                       </div>
                       <div class="form-group">
                           <label for="icon">Service Icon</label>                        
                           <input type="file" class="form-control" id="icon" name="icon">
                       </div>
                       
                       <div class="form-group">
                        <label>Select Status</label>
                        <select class="form-control" name="status" required="">
                            <option value="">Select Status</option>
                            <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
                            <option value="inactive" {{old('status')=='inactive'?'selected':''}}>Inactive</option>
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
    $("#addAmenity").validate({
            rules: {
                name: "required", 
                icon:"required",               
                status: "required"
            },
            messages: {
                name: "Please enter service name",
                status: "Please select a status",
                icon:"Please upload an icon"
            }
});
</script>
@endsection