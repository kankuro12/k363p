@php
    $authlink=route('n.user.login');
    $authimage='<i class="fas fa-user-circle"></i>';
    $authtext="Login/Signup";
    if(Auth::check()){

        if(Auth::guard()->user()->role->name=='user'){
            $authlink=route('n.user.dashboard');
            $authimage='<img style="max-width:50px;" class="icon-image" src="'.asset('uploads/user/profile_img/200x200/'.Auth::user()->vendoruser->profile_img).'" />';
            $authtext=Auth::user()->vendoruser->fname;
        }elseif(Auth::guard()->user()->role->name=='vendor'){
            $authlink=route('vendor.dashboard');
            $authimage='<i class="fas fa-user-circle"></i>';
            $authtext=Auth::user()->vendor->name;
        }
    }
@endphp

@if(Route::is('n.home') )
    @include('themes.needtech.snippets.mobileheader_v1')
@endif
    @include('themes.needtech.snippets.sidebar')
{{-- @include('themes.needtech.snippets.mobilesearch') --}}


    @include('themes.needtech.search.header')


@if(Route::is('n.home') )
  <div class="primary-header d-none d-xl-block">
      <div class="d-flex justify-content-between">
          <div class="h-left">
              <a class="brand" href="/"><img src="{{asset(custom_config('logo')->value??"")}}"></a>

          </div>
          <div class="h-right">
              {{-- <span class="language" data-toggle="modal" data-target="#exampleModal">
                  <span class="icon">
                      <i class="fas fa-globe"></i>
                  </span>
                  <span>
                      English
                  </span>
                  <span class="small-icon">
                      <i class="fas fa-caret-down"></i>
                  </span>
              </span> --}}
              <span class="signup href" data-target="{{$authlink}}">
                  <span class="icon">
                      {!! $authimage !!}
                  </span>
                  <span>
                      {{$authtext}}
                  </span>
              </span>
          </div>
      </div>
  </div>
  <div class="secondary-header sticky" style="display:none;" data-semi="1">
      <div class="menublock">
          <span class="menubtn">
              <a class="brand" href="/"><img src="{{asset(custom_config('logo')->value??"")}}"></a>
          </span>
          <span class="mini-search">
              <form action="{{route('n.search')}}">
                <div class="search-bar">
                    <span class="location">
                        <div class="d-flex" style="position:relative">
                            <span class="input ">
                                <input type="text" autocomplete="off"
                                    placeholder="Search By City or Neighbourhood or Driving Center" id="location1" name="location"
                                    required class="search-location" data-url="{{route('n.location.search')}}" data-target="#target1">

                            </span>
                            <span class="locsearch">
                                <div>
                                    <span class="href" data-target="/near-me">

                                        <i class="fas fa-street-view"></i>
                                        <span class="d-none d-md-inline">

                                            Near Me
                                        </span>
                                    </span>
                                </div>
                            </span>
                            <div id="target1">

                            </div>
                        </div>
                    </span>
                    <span class="services">
                        <select name="service" id="select-service1" >
                            <option value=""></option>
                            @foreach (\App\Model\Vendor\RoomType::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="button">
                        <button>Search</button>

                    </span>
                </div>
              </form>
          </span>
          <span class="icons">

              {{-- <span class="language" data-toggle="modal" data-target="#exampleModal">
                  <span class="icon">
                      <i class="fas fa-globe"></i>
                  </span>
                  <span class="sup">
                      EN
                  </span>
              </span> --}}
              <span class="signup href" data-target="{{$authlink}}">
                  <span class="icon">
                      {!! $authimage !!}
                  </span>
              </span>
          </span>
      </div>
  </div>
  {{-- @elseif(Route::)
  <div class="secondary-header sticky" data-semi="0">
    <div class="menublock">
        <span class="menubtn">
            <a class="brand" href="/"><img src="{{asset(custom_config('logo')->value??"")}}"></a>
        </span>
        <span class="mini-search">
            <form action="{{route('n.search')}}">
            <div class="search-bar">
                <span class="location">
                    <div class="d-flex" style="position:relative">
                        <span class="input ">
                            <input type="text" autocomplete="off"
                                placeholder="Search By City or Neighbourhood or Driving Center" id="location1" name="location"
                                required class="search-location" data-url="{{route('n.location.search')}}" data-target="#target1" value="{{ Request::get("location") ??"" }} ">

                        </span>
                        <span class="locsearch">
                            <div>
                                <span class="href" data-target="/near-me">

                                    <i class="fas fa-street-view"></i>
                                    <span class="d-none d-md-inline">

                                        Near Me
                                    </span>
                                </span>
                            </div>
                        </span>
                        <div id="target1">

                        </div>
                    </div>
                </span>
                <span class="services">
                    <select name="service" id="select-service1" >
                        <option value=""></option>
                        @foreach (\App\Model\Vendor\RoomType::all() as $item)
                            <option value="{{$item->id}}" {{Request::has('service')?(Request::get('service')==$item->id?"selected":""):""}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </span>
                <span class="button">
                    <button>Search</button>

                </span>
            </div>
            </form>
        </span>
        <span class="icons">

            <span class="language" data-toggle="modal" data-target="#exampleModal">
                <span class="icon">
                    <i class="fas fa-globe"></i>
                </span>
                <span class="sup">
                    EN
                </span>
            </span>
            <span class="signup href" data-target="{{$authlink}}">
                <span class="icon">
                    {!! $authimage !!}
                </span>
            </span>
        </span>
    </div>
</div> --}}
@endif
