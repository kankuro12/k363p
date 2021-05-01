<div class="sidebar" data-color="blue">
  <div class="logo text-center" style="position: relative; padding: 0rem; z-index: 4;">
    <a href="{{route('vendor.dashboard')}}" class="simple-text logo-normal" style="padding-top: 0px;">
      <div class="avatar-wrapper" style="padding:5px 50px">
       <img class="avatar rounded"  src="{{asset(auth()->user()->vendor->logo)}}" alt="...">
     </div>
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper" style="overflow-y:auto ">
    <ul class="nav">
      <li class="{{ (Request::is('vendor/dashboard') ? ' active' : '') }}">
        <a href="{{route('vendor.dashboard')}}">
          <i class="ion-android-apps"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="{{ (Request::is('vendor/basic-info') ? ' active' : '') }}">
        <a href="{{route('vendor.get_basic_details')}}">
          <i class="ion-android-desktop"></i>
          <p>Basic Details</p>
        </a>
      </li>
      <li class="{{ (Request::is('vendor/gallery') ? ' active' : '') }}">
        <a href="{{route('vendor.get_gallery')}}">
          <i class="ion-images"></i>
          <p>Gallery</p>
        </a>
      </li>
      <li class="{{ (Request::is('vendor/amenities') ? ' active' : '') }}">
        <a href="{{route('vendor.get_amenities')}}">
          <i class="ion-android-restaurant"></i>
          <p>Services</p>
        </a>
      </li>
      <li class="{{ (Request::is('vendor/rooms') ? ' active' : '') }}">
        <a href="{{route('vendor.get_rooms')}}">
          <i class="ion-ios-browsers-outline"></i>
          <p>Packages</p>
        </a>
      </li>
      <li class="{{ (Request::is('vendor/bookings') ? ' active' : '') }}">
        <a href="{{route('vendor.bookings')}}">
          <i class="ion-bookmark"></i>
          <p>Bookings</p>
        </a>
      </li>
      {{-- <li class="{{ (Request::is('vendor/meals') ? ' active' : '') }}">
        <a href="{{route('vendor.get_meals')}}">
          <i class="ion-coffee"></i>
          <p>Meals</p>
        </a>
      </li> --}}
      <li class="{{ (Request::is('vendor/reviews') ? ' active' : '') }}">
        <a href="{{route('vendor.reviews')}}">
          <i class="ion-android-star-outline"></i>
          <p>Reviews</p>
        </a>
      </li>
      <li class="{{ (Request::is('vendor/privacy-policy') ? ' active' : '') }}">
        <a href="{{route('vendor.get_privacy_policy')}}">
          <i class="ion-clipboard"></i>
          <p>Privacy Policy</p>
        </a>
      </li>
    </ul>
  </div>
</div>