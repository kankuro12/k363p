@if(!Route::is('n.home') )

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
                            <input type="text" autocomplete="off" oninput="
                                $('#mob-search-input').val(this.value);
                                if(!inputcheck){
                                    ajaxSearch();
                                }
                            "

                                placeholder="Search By City or Neighbourhood or Driving Center" id="location1" name="location"
                                required class="search-location" data-url="{{route('n.location.search')}}" data-target="#target1" value="{{ Request::get("location") ??"" }}">

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

@if(!Route::is('n.search') )
    <style>
        .mobile-other-header{
            background:#c22319;
            color:white;
        }
        .btn-back{
            color:white;
            background:transparent;
        }
        .mobile-other-header-title{
            font-weight:600;
            display: inline-block;
            max-width:250px;
            text-overflow: ellipsis;
            overflow:hidden;
            white-space: nowrap;

        }
    </style>
    <div class="d-block d-lg-none mobile-other-header p-2" style="background:@yield('subtitle_color','#c22319') !important;">
        <div class="d-flex justify-content-between">
            <span>
                <button class="btn btn-back py-0 px-2" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <span class="mobile-other-header-title btn p-0">
                    @yield('subtitle')
                </span>
            </span>
            <span class="tooglebtn px-2" onclick="sidebar.toogle();">
                <i class="fas fa-bars"></i>
            </span>
        </div>
    </div>
@endif
@endif

@if(Route::is('n.search') )
<div class="mobile-search-header d-md-none sticky">
    <div class="search-top ">
        <div class="input-holder">
            <span class="back close-mobile-search href" data-target="{{url('/')}}">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="input-min-holder">
                <input oninput="$('#location1').val(this.value);" data-url="{{route('n.mobile.search')}}" type="text" id="mob-search-input" class="input" placeholder="Search Location Or Establishments"  value="{{ Request::get("location") ??"" }}">
                {{-- <span class="close d-none" id="clear-mobile-search">
                    <i class="fas fa-times"></i>
                </span> --}}
            </span>
            <span class="gosearch" onclick="ajaxSearch();">
                Search
            </span>
        </div>
    </div>
</div>

@endif
