@php
    $user_text="Hello, Guest";
    $user_image=asset('assets/public/img/profile-img.png');
    if(Auth::check()){

        if(Auth::guard()->user()->role->name=='user'){

            $user_image=asset('uploads/user/profile_img/200x200/'.Auth::user()->vendoruser->profile_img);
            $user_text=Auth::user()->vendoruser->fname;
        }elseif(Auth::guard()->user()->role->name=='vendor'){


            $user_text=Auth::user()->vendoruser->name;

        }
    }
@endphp
<div class="sidebar" data-state="1" id="sidebar">
    <div class="menu">
        <div class="user " >
            <div class="row">
                <div class="col-9">
                    <span class="profile href" data-target="{{$authlink}}">
                        <span class="profile-img">
                            <img src="{{$user_image}}" alt="">
                        </span>
                        <span class="profile-name">
                            {{$user_text}}
                        </span>
                    </span>
                </div>
                <div class="col-3 text-right">
                    <span class="goicon " onclick="sidebar.toogle()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>



        </div>

        <div class="ad">

            <div class="ad-text">
                Some Exiting new is waiting for you
            </div>
            <div class="ad-img">
                <img src="{{asset('assets/public/img/adpic.png')}}" alt="">
            </div>
        </div>

        <div class="menuitem">
            <div class="header">Account</div>
            @if(Auth::check())
                <div class="text">
                    <a href="{{route('n.user.dashboard')}}">Profile</a>
                </div>
                <div class="text">
                    <a href="{{route('n.user.logout')}}">Logout</a>
                </div>
            @else
                <div class="text">
                    <a href="{{route('n.user.login')}}">Login</a>
                    <a href="{{route('n.user.signup')}}">signup</a>
                </div>
            @endif
        </div>
    </div>
</div>
