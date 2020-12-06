<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <a class="navbar-brand" href="{{route('public.home')}}">
      <img src="{{asset('assets/public/img/logo.png')}}" height="50px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

      
        @if(!Auth::check())
          <ul class="ml-auto navbar-nav">
             <a class="btn btn-outline-white custom-min-menu my-2 my-sm-0 mr-3" href="{{route('user.getLogin')}}">LOGIN</a>
             <a class="btn btn-success my-2 my-sm-0 text-white" href="{{route('user.getRegister')}}">REGISTER</a>
          </ul>
        @else
        @if(Auth::guard()->user()->role->name=='user')
        <ul class="ml-auto navbar-nav">
           <a class="btn btn-outline-white custom-min-menu my-2 my-sm-0 mr-3" href="{{route('user.profile')}}">{{Auth::user()->vendoruser->fname}}</a>
           <a class="btn btn-success my-2 my-sm-0 text-white" href="{{route('user.getLogout')}}">LOGOUT</a>
        </ul>
        @elseif(Auth::guard()->user()->role->name=='vendor')
        <ul class="ml-auto navbar-nav">
           <a class="btn btn-outline-white custom-min-menu my-2 my-sm-0 mr-3" href="{{route('vendor.dashboard')}}">{{Auth::user()->vendor->name}}</a>
           <a class="btn btn-success my-2 my-sm-0 text-white" href="{{route('vendor.getLogout')}}">LOGOUT</a>
        </ul>
        @endif     

        @endif
    </div>
</nav>
