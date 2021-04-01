@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets\public\css\search\location.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\nouislider.css')}}">
@endsection
@section('content')
    <div id="search" class="text-center pt-5 mt-5 d-none">
        <img src="https://bestanimations.com/media/loading-gears/2074796765loading-gears-animation-3.gif" alt="">
    </div>
    <div id="meta-search" class="text-center mt-5 pt-5">
        <div class="text-center">
            <img src="https://ouch-cdn.icons8.com/preview/52/3fc4ea7b-1a78-4215-be4d-e613c321ae15.png" alt="" style="max-width:300px;">
        </div>
        <h2>
            Sorry! No result :(
        </h2>
        <p>
           Please Enter 1 or more letters to search.
        </p>
    </div>
    <div id="main_search">

    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets\public\js\nouislider.js')}}"></script>
    <script>

        var first=true;
        var inputcheck=false;
        var historyloc='';
        var services=[];
        @if(isset($all['service']))
            // @php
            //     dd($all['service']);
            // @endphp
            @if($all['service'][0]!=null)
                var services={!! json_encode($all['service']) !!};
            @endif
        @endif

        var pricerange;


        window.addEventListener('popstate', function (event) {
            state=event.state;
            console.log('state');
            historyloc=state.location;
            services=state.s;
            inputcheck=true;
            $('#location1').val(historyloc);
            $('#mob-search-input').val(historyloc);
            ajaxSearch(3,2);
        });
        function ajaxSearch(minl=1,type=1){
            var loc=document.getElementById('location1').value;
            // console.log(loc.length);


            if(loc.length>=minl){

                let params = new URLSearchParams('');
                if(type==1){

                    params.append('location',loc);
                    if(first==true){
                        services.forEach(element => {
                            params.append('service[]',element);
                        });
                        first=false;
                    }else{
                        services=[];
                        $('.serviceType').each(function(){
                            if(this.checked){
                                services.push(this.value);
                                params.append('service[]',this.value);
                            }
                        })
                    }
                }else{
                    params.append('location',historyloc);
                    services.forEach(element => {
                            params.append('service[]',element);
                    });
                }

                // alert(params.toString());
                $('#search').removeClass('d-none');
                $('#meta-search').addClass('d-none');
                $('#main_search').addClass('d-none');
                if(!inputcheck && !first){
                    // history.pushState({location:loc,s:services}, 'Title of the page', '{{route("n.search")}}?'+params.toString());
                }

                // document.getElementById('main_search').innerHTML="";
                axios.get('{{route("n.ajaxsearch")}}?'+params.toString())
                .then(function(response){
                    // console.log(response.data);
                    // console.log(document.getElementById('main_search'));
                    document.getElementById('main_search').innerHTML= "";
                    $('#main_search').removeClass('d-none');
                        if(document.getElementById('location1').value.length>2){
                            document.getElementById('main_search').innerHTML= response.data;
                        }
                    manageData();
                    $('#search').addClass('d-none');
                    if(inputcheck==true){
                        inputcheck=false;
                    }
                })
                .catch(function(err){
                    $('#search').addClass('d-none');
                    if(inputcheck==true){
                        inputcheck=false;
                    }

                });
            }else{
                $('#meta-search').removeClass('d-none');
                document.getElementById('main_search').innerHTML= ""
            }
        }

        function checkSearch(){
            mob_searchstr=$('#mob-search-input').val().toLowerCase();
            // console.log('Search mobile','parameter:',mob_searchstr);
            if(mob_searchstr.length>0){
                $('#clear-mobile-search').removeClass('d-none');

            }else{
                $('#clear-mobile-search').addClass('d-none');

            }
        }

        function openFilterPage(){
            // console.log('hello');
            $('.mobile-filter-page').addClass('mobile-filter-page-show');
            $('.apply-filter').addClass('apply-filter-show');
        }
        function closeFilterPage(){
            // console.log('hello');
            $('.mobile-filter-page').removeClass('mobile-filter-page-show');
            $('.apply-filter').removeClass('apply-filter-show');

        }
        $('#mob-search-input').keyup(function(){
            checkSearch();

        });


        $('#clear-mobile-search').click(function(){
            $('#mob-search-input').val('');
            $(this).addClass('d-none');
            // $('#mob-search-result').html("");
            $('#mob-search-input').focus();
            // $('.open-mobile-search').text('Search Using City Location and Service');
        });

        function makeParamMobile(){

            let params = new URLSearchParams('');

            $('.collection').each(function () {
                if(this.checked ){
                    params.append('collection[]',this.value);
                }
            });
            $('.service').each(function () {
                if(this.checked ){
                    params.append('service[]',this.value);
                }
            });
            // console.log(params,params.toString());
        }
        checkSearch();



        function filter(){
            // console.log('filter started',services,pricerange);
            if(pricerange!=undefined ){
                // console.log(v);

                $('.service-container').each(function(){
                        // console.log(this);
                        i=0;k=0;
                        var datas=this.querySelectorAll('.service');
                        datas.forEach(element => {
                            i+=1;
                            var price=parseFloat(element.dataset.price);
                            if((price>=parseFloat( pricerange[0]) && price <= parseFloat( pricerange[1])) ){
                                if(services.length>0){
                                    if(services.includes(element.dataset.type)){
                                        $(element.parentNode).removeClass('d-none');

                                    }else{
                                        $(element.parentNode).addClass('d-none');
                                        k+=1;
                                    }
                                }else{
                                    $(element.parentNode).removeClass('d-none');

                                }


                            }else{
                                $(element.parentNode).addClass('d-none');

                                k+=1;
                            }
                        });
                        if(i==k){
                            $(this.parentNode).addClass('d-none');
                        }else{
                            $(this.parentNode).removeClass('d-none');

                        }
                        // console.log(i,k);

                    });
            }
        }

        function roomType(){
            services=[];

            $('.serviceType').each(function(){
                if(this.checked){
                    services.push($(this).val());
                }
            });
            // console.log(services);
            filter();
        }

        function roomType_mobile(){
            services=[];

            $('.serviceType_mobile').each(function(){
                if(this.checked){
                    services.push($(this).val());
                }
            });

            console.log(services);
            // filter();
        }

        function manageData(){
            $('.owl-services').each(function(){
                var inwidth=50;

                var count=$(this).children().length;
                id=$(this).attr('id');
                // console.log("#id",id);
                c=$('#'+id).owlCarousel({
                    items:1,
                    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                    autoHeight:false,
                    responsiveClass:true,
                    responsiveRefreshRate:10,
                    mouseDrag: true,
                    stagePadding: inwidth,
                    responsive:{
                        0:{
                            items:1,
                            nav:false,
                            loop:false,
                            margin:2

                        },
                        400:{
                            items:2,
                            nav:true,
                            loop:false,
                            margin:2,

                        },
                        768:{

                            items:3,
                            nav:false,
                            loop:false,
                            margin:2


                        },
                        1024:{
                            items:4,
                            nav:false,
                            loop:false,
                            margin:2,

                        },
                        1366:{
                            items:4,
                            nav:false,
                            loop:false,
                            margin:2,
                        }
                    }
                });

                });
            var slider = document.getElementById('price-filter');
            var slider_mobile = document.getElementById('price-filter-mobile');

            // // console.log(slider.dataset.valmin,slider.dataset.valmax,slider.dataset.min,slider.dataset.max);
            // var min=slider.dataset.min;
            // var max=slider.dataset.max;
            noUiSlider.create(slider, {
                start: [0,parseFloat( slider.dataset.valmax)],
                connect: true,
                range: {
                    'min':0,
                    'max': parseFloat( slider.dataset.max)
                },
                format: {
                    to: (v) => parseFloat(v).toFixed(0),
                    from: (v) => parseFloat(v).toFixed(0)
                }
            });

            $('.p').change(function(){
                filter();
            });

            slider.noUiSlider.on('update', function( values, handle ) {
                $('#minval').html(values[0]);
                $('#maxval').html(values[1]);
                $('#in-minval').val(values[0]).trigger("change");
                $('#in-maxval').val(values[1]).trigger("change");
                pricerange=values;
                filter();

            });



            noUiSlider.create(slider_mobile, {
                start: [parseFloat( slider_mobile.dataset.valmin),parseFloat( slider_mobile.dataset.valmax)],
                connect: true,
                range: {
                    'min': parseFloat( slider_mobile.dataset.min),
                    'max': parseFloat( slider_mobile.dataset.max)
                },
                format: {
                    to: (v) => parseFloat(v).toFixed(0),
                    from: (v) => parseFloat(v).toFixed(0)
                }
            });


            slider_mobile.noUiSlider.on('update', function( values, handle ) {
                $('#minval-mobile').html(values[0]);
                $('#maxval-mobile').html(values[1]);
                $('#in-minval-mobile').val(values[0]);
                $('#in-maxval-mobile').val(values[1]);
                pricerange=values;


            });



        }
    </script>
@endsection
@section('onload')

    {{-- alert('please'); --}}
    ajaxSearch();
@endsection
