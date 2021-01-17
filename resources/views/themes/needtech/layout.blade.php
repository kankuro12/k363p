<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    @yield('meta')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    {{-- <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/main1.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/mobilemenu_V1.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\sidemenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\collection.css')}}">
    <link rel="stylesheet" href="{{asset('assets\public\css\mobile.search.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://kit.fontawesome.com/4ea06e897a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" />
    <style>
        .loading{
            position:fixed;
            height:100%;
            width:100%;
            margin:0;
            padding:0;
            overflow:hidden;
        }
        .loading:before{
            content:"";
            position:absolute;
            height:100%;
            width:100%;
            background-color:white;
            z-index:1999;
            left:0;
            right:0;
            top:0;
            bottom:0;
        }
       .loading:after{
            content:"";
            position: absolute;
            z-index:2000;
            top:calc(50% - 40px);
            left:calc(50% - 40px);
            margin:auto;
            width: 80px;
            height: 80px;
            border: 2px solid #ccc;
            border-top:3px solid #18275a;
            border-radius: 100%;
            animation: spin 0.7s infinite linear;
        }
        .loaded{
            opacity:1;
            animation: fadein 1s ease-in;
        }
        @keyframes spin {
            from{
              transform: rotate(0deg);
            }to{
              transform: rotate(360deg);
            }
        }
        @keyframes fadein {
            from{
              opacity:0;
            }to{
              opacity:1;
            }
        }
        .formwrap{
            margin-top: 50px;
            text-align: center;
            font-weight: bold;
        }
        #load:disabled{
            opacity:0.7;
            cursor: not-allowed;
        }
    </style>
      {{-- @include('public.css') --}}
    <script>
      function preloader(){
        document.querySelector("body").classList.add("loaded");
        document.querySelector("body").classList.remove("loading");

        //b.classList.remove("loading").classList.add("loaded");
        //b.classList.add("loaded");

            @yield('onload')
      }

    </script>
    @yield('styles')
    <title>{{env('APP_NAME','laravel')}}</title>
  </head>
<body data-spy="scroll" data-target=".h-d-nav-wrapper" data-offset="120"  onload="preloader()" class="loading">


@include(_snippets('header'))
 @yield('content')
@include(_snippets('footer'))


<div class="modal fade p-0" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius:0px;background:#D81E46;">
          <div class="modal-header p-1" style="border-bottom:0px solid #D81E46;">
              <h2 class="text-white">
                Select A language
              </h2>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body text-white p-1 pl-3" style="font-weight: 600;min-height:300px;">
            <span class="pl-3 pr-3 pt-1 pb-1 mr-2 mb-2 d-inline-block" style="border-radius:5px;border:1px white solid;">
                English
            </span>
            <span class="pl-3 pr-3 pt-1 pb-1 mr-2 mb-2 d-inline-block" style="border-radius:5px;border:1px white solid;">
                Nepali
            </span>
          </div>

      </div>
  </div>
</div>
 <!-- Optional JavaScript -->
 <script>
    window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    function goBack () {
        if (document.referrer.indexOf("{{url('')}}") === 0) {
            history.back();
        } else {
            window.location.href = "{{url('')}}";

        }
    }
 </script>
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
 integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
 crossorigin="anonymous"></script>
 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

 <script>

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
 </script>

 <script type="text/javascript" src="{{asset('assets/public/js/scroll.js')}}"></script>

 <script type="text/javascript" src="{{asset('assets/public/js/main1.js')}}"></script>
 <script type="text/javascript" src="{{asset('assets/public/js/sidebar.js')}}"></script>
 {{-- <script type="text/javascript" src="{{asset('assets/public/js/search.js')}}"></script> --}}

{{-- <script type="text/javascript" src="js/main1.js"></script> --}}
<!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
 <script type="text/javascript">
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });



</script>

 @yield('scripts')
</body>
</html>
