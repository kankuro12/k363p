@extends('layouts.vendor.index_auth')
@section('content')
<section class="signup-page-section">
    <div class="logo text-center pb-4">
        <img src="{{asset('assets/public/img/logo.png')}}" style="max-width:250px;">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="signup-form">
                    <form id="register-form" method="post" action="{{route('vendor.postRegister')}}">
                        {{ csrf_field() }}
                        <h3 class="text-center">Register as a vendor</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="category_id" class="form-control" id="category_id">
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        <strong id="category-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="vname" id="vname" class="form-control" placeholder="Vendor Name">
                                    <span class="text-danger">
                                        <strong id="vname-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                                    <span class="text-danger">
                                        <strong id="email-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Mobile Number">
                                    <span class="text-danger">
                                        <strong id="phone_number-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    <span class="text-danger">
                                        <strong id="password-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" id="cpassword" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>





                        <div class="form-group">
                            <input type="checkbox" name="agreetc" id="agreetc" value="1">
                        <label for="agreetc" class="color-secondary">I agree to the <a href="{{route('public.term_and_condition')}}" class="color-primary">Terms and conditions</a></label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn1" id="submitBtn" type="submit">Register</button>
                        </div>
                        <p class="color-secondary text-center font-weight-bold">Already a member? <a href="{{route('vendor.getLogin')}}" class="color1">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
       $("#register-form").validate({
           ignore: [],
            rules: {
               vname: {
                   required: true,
                   minlength: 2
               },
               password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
               email: {
                   required: true,
                   email: true
               },
               phone_number:{
                   required:true,
               },
               agreetc: "required"
            },

            messages: {
                email:{
                    required:"Please enter your email address",
                    email:"Please enter valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long",
                    equalTo: "Please enter the same password as above"
                },
                vname:{
                    required:"Enter Vendor Name"
                },
                phone_number:{
                    required:"Enter Mobile Number"
                },
                agreetc:"Please accept our policy"

            },
            errorPlacement: function(error, element){
                error.appendTo( element.parent("div") );
            },
            submitHandler: function(form) {
              $("#submitBtn").html("Loading <i class='ion-load-d'></i>").attr("disabled","disabled");
              $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   dataType:'json',
                   success: function(data) {
                   $('#submitBtn').html('Register').removeAttr("disabled");
                        if(data.errors){
                          $.each(data.errors, function(key,value) {
                               toastr.error(value);
                           });
                        }
                        if(data.success){
                            $('#register-form')[0].reset();
                            toastr.success(data.message);
                            window.location.replace("{{route('vendor.step1')}}");

                        }
                   },
                   error: function(jqXHR, exception) {
                        toastr.error("Some Error Occured Please Try Again");
                        console.log(jqXHR, exception);
                        $('#submitBtn').html('Register').removeAttr("disabled");

                   }
               });
           }
        });

    });
</script>
@endsection
