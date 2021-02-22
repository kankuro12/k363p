<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin/img/favicon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/admin/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/admin/css/now-ui-dashboard.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/admin/demo/demo.css')}}" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  @yield('styles')
</head>

<body class="">
  <div class="wrapper ">
    @include('layouts.admin.snippets.sidebar')
    <div class="main-panel" id="main-panel">
      @include('layouts.admin.snippets.header')
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        @yield('content')
      </div>
      @include('layouts.admin.snippets.footer')
    </div>
  </div>
  @yield('modal')
  <script src="{{asset('assets/admin/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBahYsHxb42lOZjgo5bN04hX7hXCAJCUl8&libraries=places"></script> --}}
  <script src="{{asset('assets/admin/js/plugins/bootstrap-notify.js')}}"></script>
  <script src="{{asset('assets/admin/js/now-ui-dashboard.min.js')}}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="{{asset('assets/admin/demo/demo.js')}}"></script>
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