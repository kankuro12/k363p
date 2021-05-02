@extends('layouts.vendor.index_auth')
@section('content')
<section class="v-center w-100">
    <div class="logo text-center pb-1">
        <img src="{{asset(custom_config('logo')->value)}}" style="max-width:250px;">
    </div>
    <div class="container">
        <div class="">
            <div class=" mx-auto">
                <div class="signup-form">
                    <form id="register-form" method="post" action="{{route('vendor.step1')}}">
                        {{ csrf_field() }}
                        <h3 class="text-center">Enter Verification Code</h3>
                        <div class="form-group text-center">
                            <input type="text" name="code" id="code" class="form-control text-center" placeholder="Verification Code">
                            <span class="text-danger">
                                <strong id="code-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" id="submitBtn" type="submit">Next </button>
                        </div>

                    </form>
                    <div class="otp text-right no-pointer">
                        <span class="btn btn-link  " onclick="resendOTP();" >
                            Resend Otp
                            <span id="timer" class="font-weight-bold">

                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('onload')
    startTimer(10);
@endsection
@section('scripts')
<script type="text/javascript">
        otplock=false;
        display=document.getElementById('timer');
       function resendOTP(){
           if(!otplock){
                otplock=true;

                axios.post("{{route('vendor.resendotp')}}",{})
                .then(function(response){
                    startTimer(10);
                    alert('otp send sucessfully');
                    otplock=false;

                })
                .catch(function(err){
                    otplock=false;
                });
           }
       }

       function remove(){
            $('.otp').removeClass('no-pointer');
            $('#timer').hide();
            otplock=false;
       }

       function startTimer(duration) {
            $('#timer').show();
            $('.otp').addClass('no-pointer');
            var timer = duration, minutes, seconds;
            setTimeout(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = "after " + minutes + ":" + seconds;
                timer-=1;
                if (timer > 0) {
                    startTimer(timer );
                }else{
                    remove();
                }
            }, 1000);
        }

    $(document).ready(function(){
       $("#register-form").validate({
           ignore: [],
            rules: {
               code: {
                   required: true,

               }
            },

            messages: {
                code: {
                    required: "Please provide a Verification Code",
                    minlength: "Your password must be at least 8 characters long"
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
                   $('#submitBtn').html('Register').removeAttr("disabled");
                        if(data.errors){
                          $.each(data.errors, function(key,value) {
                               toastr.error(value);
                           });
                        }
                        if(data.success){
                            $('#register-form')[0].reset();
                            toastr.success(data.message);
                            window.location.replace("{{route('vendor.step2')}}");

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

    startTimer(10);

</script>
@endsection
