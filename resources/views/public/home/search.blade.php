<div class="hero-search d-none d-xl-block">
    <div class="container">
        <div class="header" id="search-header">
            <h1 class="text-center text-white">
                something to write
            </h1>
        </div>
        <div id="search-bar">
            <form action="{{route('n.search')}}">
                <div class="">

                    <div class="search-bar">
                        <span class="location">
                            <div class="d-flex" style="position:relative">
                                <span class="input ">
                                    <input type="text" autocomplete="off"
                                        placeholder="Search By City or Neighbourhood" id="location" name="location"
                                        required class="search-location" data-url="{{route('n.location.search')}}" data-target="#target">

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
                                <div id="target">

                                </div>
                            </div>
                        </span>
                        <span class="services">
                            <select  id="select-service" name="service[]" >
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
                </div>
            </form>
        </div>
        <div class="extra-search">
            <span class="head">
                Quick Search Links
            </span>
            <span class="href search-link" data-target="#">Biratnagar : car</span>
            <span class="href search-link" data-target="#">Kathmandu : bike</span>
            <span class="href search-link" data-target="#">kakadvitta : tipper</span>
            <span class="href search-link" data-target="#">kakadvitta : tipperasdfasdf</span>


        </div>
    </div>
</div>
