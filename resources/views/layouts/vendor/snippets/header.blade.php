<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <a class="navbar-brand" href="{{route('vendor.dashboard')}}">Dashboard</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="now-ui-icons  ui-1_bell-53"></i>
            <p>
              <span class="d-lg-none d-md-block">Notifications</span>
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            @if(Auth::guard()->user()->unReadnotifications->count()>0)
            @foreach(Auth::guard()->user()->unReadnotifications()->take(3)->get() as $nt)
            <a class="dropdown-item" href="{{route('vendor.get_notification',['id'=>$nt->id])}}">{!!$nt->data['title']!!}</a>
            @endforeach
            @if(Auth::guard()->user()->unReadnotifications->count()>3)
            <a class="dropdown-item" href="{{route('vendor.get_notifications')}}" class="dropdown-item">All notifications</a>
            @endif
            @else
            <a class="dropdown-item" href="#" class="dropdown-item">No notifications</a>
            @endif
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="now-ui-icons  users_single-02"></i>
            <p>
              <span class="d-lg-none d-md-block">Profile</span>
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{route('vendor.dashboard')}}">{{Auth::user()->vendor->name}}</a>
            <a class="dropdown-item" href="{{route('vendor.get_settings_change_email')}}">Change Email Address</a>
            <a class="dropdown-item" href="{{route('vendor.get_settings_change_password')}}">Change Password</a>
            <a class="dropdown-item" href="{{route('vendor.getLogout')}}">Log Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>