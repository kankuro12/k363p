<div class="mobile-filters d-md-none">
    <div class="row">
        {{-- <div class="col-3 ">
            <div class="mobile-price-range shadow p-1 ">
                <div class="py-1">
                    <i class="fas fa-sort"></i><br>Sort
                </div>
            </div>
        </div> --}}
        <div class="col-12 ">
            <div class="shadow other-filers " >
                <div class="row text-center m-0 py-1">
                    <div class="col-3 p-1" onclick="openFilterPage();"><i class="fab fa-servicestack"></i><br>Services</div>
                    <div class="col-2 p-1" onclick="openFilterPage();"><i class="fas fa-dollar-sign"></i><br>Price</div>
                    <div class="col-4 p-1" onclick="openFilterPage();" style="border-right:1px solid rgb(236, 236, 236);"><i class="fas fa-car-side"></i><br>Category</div>
                    <div class="col-3 p-1" onclick="openFilterPage();" ><i class="fas fa-filter"></i><br>Filter</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-filter-page ">
    <div class="px-3 py-1 d-flex justify-content-between">
        <span class="clear">
            Clear All
        </span>

        <span class="close" onclick="closeFilterPage();">
            &times;
        </span>
    </div>
    <div class="divider m-1 "></div>
    <div class="mx-3 my-2">

        @if ($min!=null && $max!=null)
            <div class="d-flex justify-content-between price-filter-view">
                <span>

                    Min:
                    <span id="minval-mobile">

                        {{$valmax}}
                    </span>
                </span>
                <span>

                    Max:
                    <span id="maxval-mobile">
                        {{$valmax}}
                    </span>
                    <input type="hidden" name="pricerange" id="in-minval-mobile" value="{{$valmin}}">
                    <input type="hidden" name="pricerange" id="in-maxval-mobile" value="{{$valmax}}">
                </span>
            </div>
            <div class="price-filter" id="price-filter-mobile" data-valmax="{{$valmax}}" data-valmin="{{$valmin}}" data-min="{{$min}}" data-max="{{$max}}">

            </div>
            <br>
            @endif
        </div>
    <div class="divider m-1"></div>
    <div class="mx-3 my-2">
        <div class="services">
            <div class="title">
                Categories
            </div>
            @foreach (\App\Model\Vendor\RoomType::all() as $service)
                <span class="service-item">

                    <input type="checkbox" value="{{$service->id}}" {{Request::has('service')?(Request::get('service')==$service->id?"checked":""):""}} class="service serviceType_mobile" onchange="roomType_mobile()">
                    <span class="service-name">
                        {{$service->name}}
                    </span>
                </span>
                <br>
            @endforeach
        </div>
    </div>
    <div class="mx-3 my-2">
        <div class="services">
            <div class="title">
                Collection
            </div>
            @foreach (\App\Model\Vendor\Collection::all() as $collection)
                <span class="service-item">

                    <input type="checkbox" value="{{$collection->id}}"  class="collection">
                    <span class="service-name">
                        {{$collection->name}}
                    </span>
                </span>
                <br>
            @endforeach
        </div>
    </div>
    <div style="height:100px;"></div>

    <button class="btn apply-filter" onclick="filter();closeFilterPage();">
        Apply Filter
    </button>
</div>
