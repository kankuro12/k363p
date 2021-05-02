@if (Route::is('n.home'))


<div class="d-block d-xl-none mobilemenu_v1 sticky" >
    <div class="menu">
        <span class="tooglebtn" onclick="sidebar.toogle();">
            <i class="fas fa-bars"></i>
        </span>
        <span class="logo">
           <img src="{{asset('assets/public/img/logo.png')}}">
        </span>
        <span class="notification">
            <i class="fas fa-bell"></i>
        </span>
    </div>
    <div class="search" id="mob_search">
        <div class="search-input" onclick="location.href='{{route('n.search')}}'">
            <span class="logo"><i class="fas fa-search"></i></span>
            <span class="text open-mobile-search" >
                Search Using City Location and Service
            </span>
        </div>
    </div>
</div>
<div class="cities d-flex d-xl-none" >
    <span class="single href" data-target="{{route('n.nearme')}}">
        <span class="icon  " style="padding-top:10px;">
            <i class="fas fa-street-view"></i>
        </span>
        <span class="text">
            Near Me
        </span>
    </span>
    @foreach (\App\Model\Vendor\City::take(5)->get() as $city)
        <span class="single href" data-target="{{route('n.search')}}?location={{$city->name}}" >
            <span class="icon" >
                <img src="{{asset($city->icon)}}" alt="">
            </span>

            <span class="text">
                {{$city->name}}
            </span>
        </span>
    @endforeach

</div>
@endif
