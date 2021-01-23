<ul class="list-group">
    <li class="list-group-item {{ (Route::is('n.user.dashboard') ? ' active' : '') }}">
        <a href="{{route('n.user.dashboard')}}"><i class="ion-android-person"></i> Profile</a>
    </li>
    <li class="list-group-item {{ (Request::is('user/bookings*') ? ' active' : '') }}">
        <a href="{{route('n.user.booking')}}"><i class="ion-calendar"></i> Bookings</a>
    </li>
    <li class="list-group-item {{ (Request::is('user/notifications*') ? ' active' : '') }}">
        <a href="{{route('n.user.notifications')}}"><i class="ion-android-notifications"></i> Notifications <span class="badge badge-success">
            &nbsp;{{Auth::guard()->user()->unReadnotifications->count()}}
        </span></a>
    </li>
    <li class="list-group-item {{ (Request::is('user/reviews*') ? ' active' : '') }}">
        <a href="{{route('user.reviews')}}"><i class="ion-android-chat"></i> Reviews</a>
    </li>
    <li class="list-group-item {{ (Request::is('user/favourites*') ? ' active' : '') }}">
        <a href="{{route('user.favourites')}}"><i class="ion-heart"></i> Favourites</a>
    </li>
    <li class="list-group-item {{ (Request::is('user/settings/email-change') ? ' active' : '') }}">
        <a href="{{route('user.get_settings_change_email')}}"><i class="ion-android-mail"></i> Change Email Address</a>
    </li>
    <li class="list-group-item {{ (Request::is('user/settings/change-password') ? ' active' : '') }}">
        <a href="{{route('user.get_settings_change_password')}}"><i class="ion-key"></i> Change Password</a>
    </li>
</ul>
