@extends('layouts.vendor.index_auth')
@section('content')
<div class="v-center w-100">
    <div class="logo text-center pb-1">
        <a href="/"><img src="{{asset(custom_config('logo')->value)}}" style="max-width:250px;" ></a>
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form">
                    <form id="login-form" class="log-form" method="post" action="{{route('vendor.postLogin')}}">
                        @csrf
                        <div id="statusBox"></div>
                        <h3 class="mb-4 text-center">Login</h3>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <span>
                                    <input type="checkbox" name="remember" id="keeplogged">
                                    <label for="keeplogged" class="color1">Keep me signed in</label>
                                </span>
                                <span>
                                    <a href="{{route('fpass')}}" class="">Forgot Password</a>
                                </span>
                            </div>
                        </div>
                         <div class="form-group">
                            <button class="btn btn-block btn-primary" id="submitBtn">Sign in</button>
                        </div>
                         <p class="color1 text-center font-weight-bold mt-3">
                             <div class="text-center font-weight-bold">
                                 Not a member yet?
                             </div>
                             <div class="text-center font-weight-bold">
                                 <a href="{{route('vendor.request')}}" class="color-primary">Request From Membership</a>
                             </div>
                        </p>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
       $("#login-form").validate({
           ignore: [],
            rules: {
               email: {
                   required: true,
                   email: true
               },
               password:{
                required:true
               }
            },

            messages: {
                email:{
                    required:"Please enter your email address",
                    email:"Please enter valid email address"
                },
                password:{
                    required:"Enter your password"
                }

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
                    $('#submitBtn').html('Sign in').removeAttr("disabled");
                        if(data.errors){
                          for (var error in data.errors) {
                             toastr.error(data.errors[error]);
                          }
                        }else{
                          if(data.success==1){
                              $('#login-form')[0].reset();
                              location.href = data.redirect_url;
                          }else{
                            toastr.error(data.message);
                          }
                        }

                   }
               });
           }
        });

    });
</script>
@endsection
