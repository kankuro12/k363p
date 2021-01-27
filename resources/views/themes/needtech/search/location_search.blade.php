

    <div class="search-main ">
        <div class="row m-0">
            <div class="col-md-3">

                <div class="filter h-100">
                    <div class="d-flex justify-content-between">


                        <span class="filter-title ">
                            Filters
                        </span>
                        <span class="filter-clear">
                            Clear All
                        </span>
                    </div>
                    <div class="divider mt-2"></div>

                        <div class="d-flex justify-content-between price-filter-view">
                            <span>

                                Min:
                                <span id="minval">

                                    {{$valmax}}
                                </span>
                            </span>
                            <span>

                                Max:
                                <span id="maxval">
                                    {{$valmax}}
                                </span>
                                <input type="hidden" class="p" name="pricerange" id="in-minval" value="{{$valmin}}">
                                <input type="hidden"  class="p" name="pricerange" id="in-maxval" value="{{$valmax}}">
                            </span>
                        </div>
                        <div class="price-filter" data-valmax="{{$valmax}}" data-valmin="{{$valmin}}" data-min="{{$min}}" data-max="{{$max}}" id="price-filter">

                        </div>
                        <div class="divider mt-2"></div>



                    <div class="services">
                        <div class="title">
                            Services
                        </div>
                        @foreach (\App\Model\Vendor\RoomType::all() as $service)
                            <span class="service-item">

                                <input  type="checkbox" onchange="inputcheck=true;ajaxSearch(0);" class="serviceType" value="{{$service->id}}" {{$hasservice?(in_array($service->id,$services)?"checked":""):""}}>
                                <span class="service-name">
                                    {{$service->name}}
                                </span>
                            </span>
                        @endforeach
                    </div>
                    {{-- <div class="divider mt-2"></div> --}}

                    {{-- <div class="services">
                        <div class="title">
                            Options
                        </div>
                        @foreach (\App\Model\Vendor\Amenity::all() as $amenity)
                            <span class="service-item">
                                <input type="checkbox" value="{{$amenity->id}}" {{Request::has('amenity')?(Request::get('amenity')==$amenity->id?"checked":""):""}}>
                                <span class="service-name">
                                    {{$amenity->name}}
                                </span>
                            </span>
                        @endforeach
                    </div> --}}
                </div>
            </div>
            <div class="col-md-9 p-0">


                    <div class="results {{count($all)>0?"":"d-none"}}">
                        {{-- <div class="mini-filters d-none d-md-flex">
                            <span class="sort-by-text">
                                Sort By :
                            </span>
                            <select  id="sort-by">
                                <option value="name">name</option>
                                <option value="name">rating</option>
                                <option value="name">price</option>
                            </select>
                        </div> --}}
                        {{-- <div class="divider d-none d-md-block"></div> --}}


                            @include('themes.needtech.search.vendor')
                            @include('themes.needtech.search.mobile_footer')

                    </div>
                    <div class="text-center mt-5 pt-5 {{count($all)>0?"d-none":"d-block"}}">
                        <div class="text-center">
                            <img src="https://ouch-cdn.icons8.com/preview/52/3fc4ea7b-1a78-4215-be4d-e613c321ae15.png" alt="" style="max-width:300px;">
                        </div>
                        <h2>
                            Sorry! No result found :(
                        </h2>
                        <p>
                            we are sorry we cannot find what you are looking for. Please try another way.
                        </p>
                    </div>


            </div>
        </div>
    </div>



