@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('subtitle',"OTP")
@section('styles')
    <style>
        body{

            width:100%;
        }

        .no-pointer{
            pointer-events: none;
        }
    </style>
@endsection
@section('content')

<div style="min-height:calc(100vh - 100px);background:#F7F7F7;">

    <div class="row m-0 h-100" >
        <div class="col-lg-6 d-none d-md-block"></div>
        <div class="col-lg-6 h-100" style="position:relative;">
           <div  style="padding-top:15vh;padding-bottom:15vh;" >
                <div class="container" >
                    <div class="card mx-0 mx-md-5 shadow " style="min-height:60vh; border:none;">
                        <div class="container">

                            <div class=" text-center bg-white py-3">
                                <img src="{{asset(custom_config('logo')->value??"")}}" style="max-width:100%;">
                                <br>
                                <h3 style="color:#c22319;font-weight:700">
                                    Verify Otp
                                </h3>
                            </div>
                            <div style="background:#f1f1f1;height:2px;"></div>
                            <form action="{{route('n.user.otp')}}" method="POST">
                                @csrf
                                <div>
                                    @if($errors->any())
                                        <div class="errors text-center" style="color:red;font-size:0.9rem;font-weight:500;">{!!$errors->first()!!}</div>
                                    @endif
                                </div>
                                <div class="pt-3 pb-1 d-block d-md-flex ">
                                    <input type="hidden" name="number" id="number" value="{{$number}}">
                                    <span style="flex-grow:1;" class="d-block d-md-inline">
                                        <input type="text" autocomplete="false" minlength="6" name="otp" id="otp" style="border-radius:0px;" class="form-control mb-2 mr-0 mr-md-2 " placeholder="Enter OTP"  >
                                    </span>
                                    <span>
                                        <button class=" btn btn-success px-5">Verify Otp</button>
                                    </span>
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
        </div>
    </div>
</div>
@endsection
@section('onload')
    startTimer(10);
@endsection
@section('scripts')
   <script>
       otplock=false;
        display=document.getElementById('timer');
       function resendOTP(){
           if(!otplock){
                otplock=true;
                number={{$number}};
                axios.post("{{route('n.user.resendotp')}}",{number:number})
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
   </script>
@endsection
