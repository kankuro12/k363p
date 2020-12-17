<div class="d-block d-xl-none mobilemenu sticky " >
    <div class="menublock">
        <span class="menubtn">
            <a class="brand" href="/"><img src="{{asset('assets/public/img/logo.png')}}"></a>
        </span>
        <span>
            <span class="search " data-toggle="collapse" data-target="#min-search-bar" data-set="1"
            onclick="toogleSearch(this);">
                <i class="fas fa-search"></i>
            </span>
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
    <div class="mobile-search collapse pt-2 pb-2 pl-2 pr-2 bg-white " id="min-search-bar" style="position: relative;" >
        <form action="search" id="min-search-bar-form">
            <div style="position:relative;">

                <input type="text" autocomplete="off" class="form-control mb-1"
                                    placeholder="Search By City or Neighbourhood" id="location3" name="location"
                                    required>
                                    <div class="shadow" id="mobile-search-target" style="
                                    position:absolute;
                                    z-index:889;
                                    left: -10px;
                                    right: -10px;
                                    display:none;
                                    background: white;
                                    min-height: 100px;
                                    max-height:85vh;
                                    overflow-y:scroll;
                                    border-bottom-left-radius: 5px;
                                    border-bottom-right-radius: 5px;
                                    left:1px;right:1px;
                                    padding:8px;
                                    ">


                                    </div>
            </div>
            <div>
                <select  name="service" class="form-control" id="select-service2" name="service">
                    <option value=""></option>
                    @foreach (\App\Model\Vendor\RoomType::all() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>

            </div>
            <div>
                <input type="submit" value="Search" class="btn form-control text-white mt-1"  style="background:#128036;border-radius:5px;">

            </div>


        </form>


    </div>
</div>
