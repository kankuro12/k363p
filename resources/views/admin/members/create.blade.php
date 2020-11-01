@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Member</h5>
            </div>
            <div class="card-body">
               <form method="post" action="{{route('admin.post_create_members')}}" enctype="multipart/form-data" id="addMember">
                @csrf
                   <div class="card-body">
                       <div class="form-group">
                           <label for="fname">Name</label>                        
                           <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name')}}">
                       </div>
                       <div class="form-group">
                           <label for="email">Email address</label>                        
                           <input type="email" class="form-control" id="icon" name="email">
                       </div>
                       
                       <div class="form-group">
                           <label for="fname">Password</label>                        
                           <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                       </div>
                       <div class="form-group">
                           <label for="fname">Confirm Password</label>                        
                           <input type="password" class="form-control" id="password_confirmation" placeholder="Password" name="password_confirmation">
                       </div>
                       <div class="form-group">
                           <label for="avatar">Avatar</label>                        
                           <input type="file" class="form-control" id="avatar" name="avatar">
                       </div>
                       
                       <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="active" required="">
                            <option value="">Select Status</option>
                            <option value="1" {{old('status')=='1'?'selected':''}}>Active</option>
                            <option value="0" {{old('status')=='0'?'selected':''}}>Inactive</option>
                        </select>
                       </div>
                       <div class="form-group">
                           <label for="text">Designation</label>                        
                           <input type="text" class="form-control" id="designation" name="designation">
                       </div>
                       <div class="form-group">
                           <label for="about">About</label>                        
                           <textarea name="about" class="form-control"></textarea>
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
    $("#addMember").validate({
            rules: {
                name: "required", 
                avatar:"required",   
                email:"required",
                password:"required",            
                status: "required"
            },
            messages: {
                name: "Please enter member name",
                status: "Please select a status",
                avatar:"Please upload an avatar"
            }
});
</script>
@endsection