@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('subtitle',"Login")
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
           <div  style="padding-top:15vh;padding-bottom:15vh;" >
                <div class="container" >
                    <div class="card mx-0 mx-md-5 shadow " style="min-height:60vh; border:none;">
                        <div class="container">

                            <div class=" text-center bg-white py-3">
                                <img src="{{asset(custom_config('logo')->value)}}" style="max-width:100%;">
                                <br>
                                <h3 style="color:#c22319;font-weight:700">
                                    Login
                                </h3>
                            </div>
                            <div style="background:#f1f1f1;height:2px;"></div>
                            <form action="{{route('n.user.login')}}" method="POST">
                                @csrf
                                <div>
                                    @if($errors->any())
                                        <div class="errors text-center" style="color:red;font-size:0.9rem;font-weight:500;">{!!$errors->first()!!}</div>
                                    @endif
                                </div>
                                <div class="pt-3 pb-1 d-block d-md-flex ">
                                    <span style="flex-grow:1;" class="d-block d-md-inline">

                                        <input type="text" autocomplete="false" minlength="10" name="phone" id="phone" style="border-radius:0px;" class="form-control mb-2 mr-0 mr-md-2 " placeholder="Enter Phone Number" value="{{old('phone')}}" >
                                    </span>
                                    <span>
                                        <button class=" btn btn-success px-5">Next</button>
                                    </span>
                                </div>
                            </form>
                            <div class="d-flex">
                                <span style="flex-grow:1;padding-top: 12px;padding-right: 10px;">
                                    <div style="height: 2px;background:#f1f1f1"></div>
                                </span>
                                <span style="font-weight:bold;color:#28A745;">OR</span>
                                <span style="flex-grow:1;padding-top: 12px;padding-left: 10px;">
                                    <div style="height: 2px;background:#f1f1f1;"></div>
                                </span>
                            </div>
                            <div >
                                <div class="row">
                                    <div class="col-md-6 pt-2">
                                        <a href="{{route('n.user.social',['provider'=>'facebook'])}}" class="w-100" style="text-decoration:none;display:inline-block;line-height:1;">
                                            <div class="d-flex ">
                                                <span class="p-2 bg-white" style="color:#4C6EF5;border:1px solid #4C6EF5;">
                                                    <i class="fab fa-facebook"></i>
                                                </span>
                                                <span class="p-2 text-white font-weight-bold" style="background: #4C6EF5;border:1px solid #4C6EF5;flex-grow:1;">
                                                    Login Using Facebook
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <a href="{{route('n.user.social',['provider'=>'google'])}}" class="w-100" style="text-decoration:none;display:inline-block;line-height:1;">
                                            <div class="d-flex">
                                                <span class="p-2 bg-white" style="color:#F59901;border:1px solid #F59901;">
                                                    <i class="fab fa-google"></i>
                                                </span>
                                                <span class="p-2 text-white font-weight-bold" style="background: #F59901;border:1px solid #F59901;flex-grow:1;">
                                                    Login Using Google
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .md-text-right{
                                    text-align:right;
                                }
                                @media(max-width:768px){
                                    .md-text-right{
                                        text-align:center;
                                    }
                                }
                            </style>
                            <div style="height: 2px;background:#f1f1f1;margin:10px 0px;"></div>
                            <div class="md-text-right pb-3 ">
                                Need A Account? <a href="{{route('n.user.signup')}}" style="text-decoration:none;font-weight:500;">Signup</a>
                            </div>
                            <div class="md-text-right pb-3 ">
                                 <a href="{{route('vendor.getLogin')}}" style="text-decoration:none;font-weight:500;">Login as Driving Center</a>
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
    setTimeout(function(){
        $('.errors').remove();
    }, 10000);
@endsection
