<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/vendor/img/favicon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/vendor/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="{{asset('assets/vendor/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/vendor/css/now-ui-dashboard.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/vendor/demo/demo.css')}}" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <style type="text/css">
    .btn{
      margin:4px 0;
    }
  </style>
  <style>

    .sidebar .logo:after, .off-canvas-sidebar .logo:after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 15px;
    height: 1px;
    width: calc(100% - 30px);
    background-color: unset;
    }
    .loading{
    position:absolute;
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
    }
    .loading.transparent:before{
    background-color:rgba(255,255,255,0.8); 
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
    border-top:3px solid #66615b;
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
    </style>
  @yield('styles')
</head>

<body class="">
  <div class="wrapper ">
    @include('layouts.vendor.snippets.sidebar')
    <div class="main-panel" id="main-panel">
      @include('layouts.vendor.snippets.header')
      @if(Request::is('vendor/dashboard'))
      <div class="panel-header">
        <canvas id="bigDashboardChart"></canvas>
      </div>
      @else
      <div class="panel-header panel-header-sm">
      </div>
      @endif
      <div class="content">
        @yield('content')
      </div>
      @include('layouts.vendor.snippets.footer')
    </div>
  </div>
  @yield('modal')
  <script src="{{asset('assets/vendor/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/vendor/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/vendor/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBahYsHxb42lOZjgo5bN04hX7hXCAJCUl8&libraries=places"></script>
  <script src="{{asset('assets/vendor/js/plugins/bootstrap-notify.js')}}"></script>
  <script src="{{asset('assets/vendor/js/now-ui-dashboard.min.js')}}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
  <script src="{{asset('assets/vendor/demo/demo.js')}}"></script>
  <script type="text/javascript">
      $(document).ready(function(){
           $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
          });
                  
      });
  </script>
  @yield('scripts')
</body>

</html>