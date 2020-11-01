@extends('layouts.public.index')
@section('content')

<section class="hero-section search-page-hero" style="padding: 100px 0;">
    <div class="hero-search-caption">
        <div class="container">            
            <form action="{{route('public.get_search')}}" id="main-search-form">
                <div class="hero-search">
                   
                    
                        <span class="search-location">
                            <input type="text" name="location" class="form-control" placeholder="Location" value="{{(!empty( $all['location']))?$all['location']:''}}" required></span>
                    
                    
                    <span class="services">
                        <input type="text" name="service" class="form-control" placeholder="Enter a Service" autocomplete="off" value="{{(!empty( $all['service']))?$all['service']:''}}" >
                     </span>
                    <span><button class="btn btn-success btn-block" type="submit">Search</button></span>
                </div>
            </form>
        </div>
    </div>
</section>


<section class="listing-and-filter-section py-4">
    <div class="container"> 
        <div class="row">
            <div class="col-md-3">
            <div class="side-filter-wrapper">
                <form id="side-filter-form">
                    <div class="side-filter">
                        <h4 class="color1">Rating</h4>
                        <hr>
                        <div class="custom-checkbox">
                            <input type="checkbox" value="1" name="star_rating1" id="st_ch_1" onchange="doSearch()">
                            <label for="st_ch_1">
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star-outline"></i>
                                <i class="ion-android-star-outline"></i>
                                <i class="ion-android-star-outline"></i>
                                <i class="ion-android-star-outline"></i>
                            </label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" value="2" name="star_rating2" id="st_ch_2" onchange="doSearch()">
                            <label for="st_ch_2">
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star-outline"></i>
                                <i class="ion-android-star-outline"></i>
                                <i class="ion-android-star-outline"></i>
                            </label>
                        </div>      
                        <div class="custom-checkbox">
                            <input type="checkbox" value="3" name="star_rating3" id="st_ch_3" onchange="doSearch()">
                            <label for="st_ch_3">
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star-outline"></i>
                                <i class="ion-android-star-outline"></i>
                            </label>
                        </div>  
                        <div class="custom-checkbox">
                            <input type="checkbox" value="4" name="star_rating4" id="st_ch_4" onchange="doSearch()">
                            <label for="st_ch_4">
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star-outline"></i>
                            </label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" value="5" name="star_rating5" id="st_ch_5" onchange="doSearch()">
                            <label for="st_ch_5">
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                            </label>
                        </div>
                    </div>
                    <div class="side-filter mt-4">
                        <h4 class="color1">Services</h4>
                        <hr>
                        @foreach($amenities as $index=>$amenity)
                        <div class="custom-checkbox">
                            <input type="checkbox" value="{{$amenity->id}}" name="samenities[]" id="ast_ch_{{$index}}" onchange="doSearch()">
                            <label for="ast_ch_{{$index}}">{{$amenity->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="side-filter mt-4">
                        <h4 class="color1">Package Services</h4>
                        <hr>
                        @foreach($roomamenities as $i=>$ramenity)
                        <div class="custom-checkbox">
                            <input type="checkbox" value="{{$ramenity->amenity}}" name="roomamenities[]" id="rast_ch_{{$i}}" onchange="doSearch()">
                            <label for="rast_ch_{{$i}}">{{$ramenity->amenity}}</label>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
             <div class="listing-wrapper">
                 <h3 class="color1 searh-result-title">Available Properties :</h3>
                  <form id="sortForm">
                 <div class="filter-sortby d-flex">
                     <div>sortby:</div>
                         <div>
                             <select class="form-control" name="price_sort" onchange="doSearch()">
                                 <option value="">Price</option>
                                 <option value="asc">low to high</option>
                                 <option value="desc">high to low</option>
                             </select>
                         </div>
                         <div>
                             <select class="form-control" name="start_rating_sort" onchange="doSearch()">
                                 <option value="">Star Rating</option>
                                 <option value="asc">low to high</option>
                                 <option value="desc">high to low</option>
                             </select>
                         </div>
                 </div>
                 </form>
                 <div class="content-wrapper">
                    <div  id="content">
                        @include('public.search.ajax')
                    </div>    
                 </div>        
             </div>  
        </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('submit','form#main-search-form',function(e){
        e.preventDefault();
        doSearch();
    });

    $("body .side-filter").on("mouseup",".slider-handle", function(){
      doSearch();
    });
    
    $(document).on('click', 'a.page-link', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
    function ajaxLoad(filename, content) {
        content = typeof content !== 'undefined' ? content : 'content';
        $('.loading').show();
        $.ajax({
            type: "GET",
            url: filename,
            contentType: false,
            beforeSend: function() {
              $(".content-wrapper").css("position","relative")
              $(".content-wrapper").addClass('loading');         
            },
            success: function (data) {
                $(".content-wrapper").removeClass('loading transparent');  
                $("#" + content).html(data);
                $('.loading').hide();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
    $(document).on('submit','form#main-search-form',function(e){
        e.preventDefault();
        doSearch();
    });

    $("body .side-filter").on("mouseup",".slider-handle", function(){
      doSearch();
    });
    function doSearch(){
      var data= $('#side-filter-form, #main-search-form,#sortForm').serialize();
      $.ajax({
        type:'GET',
        url:'{{route('public.get_search')}}',
        data:data,
        beforeSend: function() {
          $(".content-wrapper").css("position","relative")
          $(".content-wrapper").addClass('loading');        
        },
        success:function(data){
            $(".content-wrapper").removeClass('loading');    
            $("#content").html(data);
            
        }
      });
      
    }
</script>
@endsection