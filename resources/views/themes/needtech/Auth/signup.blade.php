@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('subtitle',"Sign Up")
@section('styles')
    <style>
        body{

            width:100%;
        }
    </style>
@endsection
@section('content')

<div style="min-height:calc(100vh - 100px);background:#F7F7F7;">

    <div class="row m-0 h-100" >
        <div class="col-lg-6 d-none d-md-block"></div>
        <div class="col-lg-6 h-100" style="position:relative;">
           <div  style="padding-top:4vh;padding-bottom:4vh;" >
                <div class="container" >
                    <div class="card mx-0 mx-md-5 shadow " style="min-height:60vh; border:none;">
                        <div class="container">

                            <div class=" text-center bg-white py-3">
                                <img src="{{asset('assets/public/img/logo.png')}}" style="max-width:100%;">
                                <br>
                                <h3 style="color:#c22319;font-weight:700">
                                    Signup
                                </h3>
                            </div>
                            <div style="background:#f1f1f1;height:2px;"></div>
                            <form action="{{route('n.user.signup')}}" method="post">
                                @csrf
                                <div class="pt-3 pb-1  ">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" autocomplete="false" minlength="10" name="phone" id="phone"  class="form-control " placeholder="Enter Phone Number"  required>
                                    </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">First Name</label>
                                                    <input type="text" autocomplete="false" minlength="10" name="fname" id="fname"  class="form-control " placeholder="Enter First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lname">Last Name</label>
                                                    <input type="text" autocomplete="false" minlength="10" name="lname" id="lname"  class="form-control " placeholder="Enter Last Name" required >
                                                </div>

                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" autocomplete="false" minlength="10" name="email" id="email"  class="form-control " placeholder="Enter Email Address" >
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox"  id="t$c" name="tc" required> T$C link
                                    </div>
                                    <div class="form-group">

                                        <button class=" btn btn-success px-5">Sign up</button>
                                        <span class="float-right" style="padding: 0.5rem;">
                                            Already Have A Account? <a href="{{route('n.user.login')}}" style="text-decoration:none;font-weight:500;">Login</a>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection
@section('onload')
   run();

@endsection
@section('scripts')
    <script>
         var i = 0;
        var txt = '{{$number}}'; /* The text */
        var speed = 250; /* The speed/duration of the effect in milliseconds */
        function run(){
            if (i < txt.length) {
                document.getElementById("phone").value += txt.charAt(i);
                i++;
                speed-=30;
                if(speed<=0){
                    speed=30;
                }
                setTimeout(run, speed);

            }
        }
    </script>
@endsection
