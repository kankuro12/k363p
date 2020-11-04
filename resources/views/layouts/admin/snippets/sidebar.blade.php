<div class="sidebar" data-color="blue">
  <div class="logo">
    <a href="{{route('admin.dashboard')}}" class="simple-text logo-mini">
      HT
    </a>
    <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
      {{env('APP_NAME','laravel')}}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="{{ (Request::is('admin/dashboard') ? ' active' : '') }}">
        <a href="{{route('admin.dashboard')}}">
          <i class="ion-android-apps"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li>                        
          <a data-toggle="collapse" href="#vendorMenu" class="collapsed" aria-expanded="false">            
              <i class="ion-android-desktop"></i>            
              <p>
                Vendor Menu <b class="caret"></b>
              </p>
          </a>
          <div class="collapse" id="vendorMenu" style="">
            <ul class="nav">               
              <li class="">
                  <a href="{{route('admin.categories')}}">                        
                      <span class="sidebar-normal">Categories</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('admin.amenities')}}">
                      <span class="sidebar-normal">Services </span>
                  </a>
              </li>
              <li>
                  <a href="{{route('admin.vendors')}}">
                      <span class="sidebar-normal"> Vendors </span>
                  </a>
              </li>
              <li>
                  <a href="{{route('admin.get_room_type')}}">
                      <span class="sidebar-normal"> Package Type </span>
                  </a>
              </li>
              {{-- <li>
                  <a href="{{route('admin.get_bed_type')}}">
                      <span class="sidebar-normal"> Service Types </span>
                  </a>
              </li> --}}
              <li>
                  <a href="{{route('admin.get_reviews')}}">
                      <span class="sidebar-normal"> Reviews </span>
                  </a>
              </li>   
              <li>
                  <a href="{{route('admin.collections')}}">
                      <span class="sidebar-normal"> Collections </span>
                  </a>
              </li>                           
            </ul>
          </div>       
      </li>
      <li>                        
          <a data-toggle="collapse" href="#userMenu" class="collapsed" aria-expanded="false">            
              <i class="ion-android-person"></i>            
              <p>
                User Menu <b class="caret"></b>
              </p>
          </a>
          <div class="collapse" id="userMenu" style="">
            <ul class="nav">               
              <li class="">
                  <a href="{{route('admin.get_users')}}">                        
                        <span class="sidebar-normal">Users</span>
                  </a>
              </li>               
            </ul>
          </div>       
      </li>
      <li>                        
          <a data-toggle="collapse" href="#locationMenu" class="collapsed" aria-expanded="false">            
              <i class="ion-ios-location-outline"></i>            
              <p>
                Location Menu <b class="caret"></b>
              </p>
          </a>
          <div class="collapse" id="locationMenu" style="">
            <ul class="nav">               
              <li class="">
                  <a href="{{route('admin.countries')}}">                        
                      <span class="sidebar-normal">Country</span>
                  </a>
              </li>
              <li class="">
                  <a href="{{route('admin.states')}}">                        
                      <span class="sidebar-normal">State</span>
                  </a>
              </li>
              <li class="">
                  <a href="{{route('admin.city')}}">                        
                      <span class="sidebar-normal">City</span>
                  </a>
              </li>             
            </ul>
          </div>       
      </li>
      <li class="{{ (Request::is('admin/bookings') ? ' active' : '') }}">
          <a href="{{route('admin.bookings')}}">
              <i class="ion-android-bookmark"></i> 
              <p>Booking Menu</p>
          </a>
      </li>
          {{-- <li class="{{ (Request::is('admin/tourism-areas') ? ' active' : '') }}">
        <a href="{{route('admin.get_tourisam_areas')}}">
            <i class="ion-earth"></i>
            <p>Tourism Areas</p>
        </a>
    </li> --}}
    <li class="{{ (Request::is('admin/members') ? ' active' : '') }}">
        <a href="{{route('admin.members')}}">
            <i class="ion-android-people"></i>
            <p>Admin Members</p>
        </a>
    </li>
    <li class="{{ (Request::is('admin/payment-modes') ? ' active' : '') }}">
        <a href="{{route('admin.get_payment_mode')}}">
            <i class="ion-cash"></i>
            <p>Payment Methods</p>
        </a>
    </li>
    <li class="{{ (Request::is('admin/accounts') ? ' active' : '') }}">
        <a href="{{route('admin.get_accounts')}}">
            <i class="ion-android-lock"></i>
            <p>Accounts</p>
        </a>
    </li>
    <li class="{{ (Request::is('admin/enquiries') ? ' active' : '') }}">
        <a href="{{route('admin.get_enquiries')}}">
            <i class="ion-ios-help-outline"></i>
            <p>Enquiries</p>
        </a>
    </li>

    </ul>
  </div>
</div>