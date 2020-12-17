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
        <div class="search-input">
            <span class="logo"><i class="fas fa-search"></i></span>
            <span class="text">
                Search Using City Location and Service
            </span>
        </div>
    </div>
</div>
<div class="cities d-flex d-xl-none" >
    <span class="single ">
        <span class="icon  " style="padding-top:10px;">
            <i class="fas fa-street-view"></i>
        </span>
        <span class="text">
            Near Me
        </span>
    </span>
    @foreach (\App\Model\Vendor\City::take(5)->get() as $city)
        <span class="single">
            <span class="icon" >
                <img src="{{asset('uploads/vendor/room_type/icons/1606802342.jpg')}}" alt="">
            </span>

            <span class="text">
                {{$city->name}}
            </span>
        </span>
    @endforeach

</div>
