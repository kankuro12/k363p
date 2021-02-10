<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/public/css/vendorauth.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
        @yield('onload')
        //b.classList.remove("loading").classList.add("loaded");
        //b.classList.add("loaded");
      }

    </script>
    @yield('styles')
    <title>{{env('APP_NAME','laravel')}}</title>
  </head>
<body >


    <div class="row m-0">
        <div class="col-md-6 pr-0 min-h-100 d-none d-md-block sidebar" style="" >
            @if (!Route::is('vendor.getLogin') && !Route::is('vendor.getRegister') && !Route::is('vendor.request'))

                <div class="menu">
                    <ul>
                        <li class="{{Route::is('vendor.step1')?"active":""}}">
                            Verify User
                        </li>
                        <li class="{{Route::is('vendor.step2')?"active":""}}">
                            Add Cover Photo
                        </li>
                        <li class="{{Route::is('vendor.step3')?"active":""}}">
                            Add Profile Picture
                        </li>
                    </ul>
                </div>
            @endif

        </div>
        <div class="col-md-6 pl-0 min-h-100">
            @yield('content')
        </div>
    </div>
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
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 <script type="text/javascript" src="{{asset('assets/public/js/main.js')}}"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>

     axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
     axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
  </script>

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
