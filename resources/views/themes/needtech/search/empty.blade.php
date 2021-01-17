@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#ED2A24" />
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets\public\css\search\location.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\nouislider.css')}}">
@endsection
@section('content')
    <div id="main_search">

    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets\public\js\nouislider.js')}}"></script>
    <script>

        var pricerange;
        var services=[];
        function ajaxSearch(){
            var loc=document.getElementById('location1').value;
            // console.log(loc.length);
            document.getElementById('main_search').innerHTML="";
            if(loc.length>2){
                let params = new URLSearchParams('');
                params.append('location',loc);
                // alert(params.toString());
                axios.get('{{route("n.ajaxsearch")}}?'+params.toString())
                .then(function(response){
                    // console.log(response.data);
                    // console.log(document.getElementById('main_search'));
                    document.getElementById('main_search').innerHTML= response.data;
                    manageData();
                })
                .catch(function(err){

                });
            }
        }

        function checkSearch(){
            mob_searchstr=$('#mob-search-input').val().toLowerCase();
            console.log('Search mobile','parameter:',mob_searchstr);
            if(mob_searchstr.length>0){
                $('#clear-mobile-search').removeClass('d-none');

            }else{
                $('#clear-mobile-search').addClass('d-none');

            }
        }

        function openFilterPage(){
            console.log('hello');
            $('.mobile-filter-page').addClass('mobile-filter-page-show');
            $('.apply-filter').addClass('apply-filter-show');
        }
        function closeFilterPage(){
            console.log('hello');
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
            console.log(params,params.toString());
        }
        checkSearch();



        function filter(){
            console.log('filter started',services,pricerange);
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
                        console.log(i,k);

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
            console.log(services);
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
            filter();
        }

        function manageData(){
            $('.owl-services').each(function(){
                var inwidth=50;

                var count=$(this).children().length;
                id=$(this).attr('id');
                console.log("#id",id);
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